<?php

namespace App\Http\Controllers;

use App\Models\CheckinManifest;
use App\Models\CheckinManifestPenumpang;
use App\Models\Profiling;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class GuestManifestController extends Controller
{
    public function create()
    {
        $kapals = Profiling::orderBy('nama_kapal')
            ->orderBy('waktu_keberangkatan')
            ->get();

        return view('checkin-manifest', compact('kapals'));
    }

    protected function validateManifest(Request $request): array
    {
        $validated = $request->validate([
            'profiling_id'                  => ['required', 'string', 'exists:profilings,id'],
            'jenis_layanan'                 => ['required', 'in:pelayaran,penyeberangan'],
            'asal'                          => ['required', 'string', 'max:255'],
            'tujuan'                        => ['required', 'string', 'max:255'],
            'tanggal_berangkat'             => ['required', 'date'],
            'jam_berangkat'                 => ['required'],
            'telepon'                       => ['required', 'string', 'max:20'],
            'bawa_kendaraan'                => ['nullable', 'in:Ya,Tidak'],
            'jenis_kendaraan'               => ['nullable', 'string', 'max:255'],
            'plat_nomor'                    => ['nullable', 'string', 'max:50'],
            'penumpangs'                    => ['required', 'array', 'min:1'],
            'penumpangs.*.nik'              => ['required', 'string', 'max:25'],
            'penumpangs.*.nama'             => ['required', 'string', 'max:255'],
            'penumpangs.*.tanggal_lahir'    => ['required', 'date'],
        ], [
            'profiling_id.required' => 'Jadwal keberangkatan wajib dipilih.',
            'profiling_id.exists' => 'Jadwal keberangkatan tidak valid.',
            'jenis_layanan.required' => 'Jenis layanan wajib dipilih.',
            'asal.required' => 'Asal wajib terisi.',
            'tujuan.required' => 'Tujuan wajib terisi.',
            'tanggal_berangkat.required' => 'Tanggal keberangkatan wajib terisi.',
            'jam_berangkat.required' => 'Jam keberangkatan wajib terisi.',
            'telepon.required' => 'Nomor WhatsApp wajib diisi.',
            'penumpangs.required' => 'Minimal ada 1 penumpang.',
            'penumpangs.min' => 'Minimal ada 1 penumpang.',
            'penumpangs.*.nik.required' => 'NIK penumpang wajib diisi.',
            'penumpangs.*.nama.required' => 'Nama penumpang wajib diisi.',
            'penumpangs.*.tanggal_lahir.required' => 'Tanggal lahir penumpang wajib diisi.',
        ]);

        $profiling = Profiling::find($validated['profiling_id']);

        if (!$profiling) {
            throw ValidationException::withMessages([
                'profiling_id' => 'Data jadwal kapal tidak ditemukan.',
            ]);
        }

        if ($validated['jenis_layanan'] === 'pelayaran') {
            $validated['bawa_kendaraan'] = 'Tidak';
            $validated['jenis_kendaraan'] = null;
            $validated['plat_nomor'] = null;
        }

        if (
            $validated['jenis_layanan'] === 'penyeberangan' &&
            ($validated['bawa_kendaraan'] ?? 'Tidak') === 'Ya'
        ) {
            if (empty($validated['jenis_kendaraan'])) {
                throw ValidationException::withMessages([
                    'jenis_kendaraan' => 'Jenis kendaraan wajib diisi jika membawa kendaraan.',
                ]);
            }

            if (empty($validated['plat_nomor'])) {
                throw ValidationException::withMessages([
                    'plat_nomor' => 'Plat nomor wajib diisi jika membawa kendaraan.',
                ]);
            }
        }

        $validated['user_id'] = $profiling->user_id;

        return $validated;
    }

    public function store(Request $request)
    {
        $validated = $this->validateManifest($request);

        $manifest = DB::transaction(function () use ($validated) {
            $manifest = CheckinManifest::create([
                'user_id'           => $validated['user_id'],
                'profiling_id'      => $validated['profiling_id'],
                'jenis_layanan'     => $validated['jenis_layanan'],
                'asal'              => $validated['asal'],
                'tujuan'            => $validated['tujuan'],
                'tanggal_berangkat' => $validated['tanggal_berangkat'],
                'jam_berangkat'     => $validated['jam_berangkat'],
                'telepon'           => $validated['telepon'],
                'bawa_kendaraan'    => $validated['bawa_kendaraan'] ?? 'Tidak',
                'jenis_kendaraan'   => $validated['jenis_kendaraan'] ?? null,
                'plat_nomor'        => $validated['plat_nomor'] ?? null,
                'jumlah_penumpang'  => count($validated['penumpangs']),
                'status'            => 'selesai',
            ]);

            foreach ($validated['penumpangs'] as $item) {
                CheckinManifestPenumpang::create([
                    'checkin_manifest_id' => $manifest->id,
                    'nik'                 => $item['nik'],
                    'nama'                => $item['nama'],
                    'tanggal_lahir'       => $item['tanggal_lahir'],
                ]);
            }

            return $manifest;
        });

        $manifest->load(['profiling', 'penumpangs']);

        $this->sendWhatsAppMessage($manifest);

        return redirect()
            ->route('guest.manifest.create')
            ->with('success_popup', [
                'title' => 'Check-In Berhasil',
                'text' => 'Data manifest berhasil dikirim. Link e-ticket sudah dikirim ke WhatsApp perwakilan.',
                'ticket_url' => route('guest.manifest.ticket', $manifest->id),
            ]);
    }

    public function downloadTicket($id)
    {
        $manifest = CheckinManifest::with(['profiling', 'penumpangs'])
            ->findOrFail($id);

        $pdf = Pdf::loadView('pdf.manifest-ticket', compact('manifest'))
            ->setPaper('a4', 'portrait');

        $filename = 'e-ticket-manifest-' . $manifest->id . '.pdf';

        return response($pdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
        ]);
    }

    private function sendWhatsAppMessage(CheckinManifest $manifest): void
    {
        try {
            $nomor = $this->normalizePhoneNumber($manifest->telepon);
            $ticketUrl = route('guest.manifest.ticket', $manifest->id);

            $daftarPenumpang = '';
            foreach ($manifest->penumpangs as $index => $penumpang) {
                $tglLahir = $penumpang->tanggal_lahir
                    ? date('d-m-Y', strtotime($penumpang->tanggal_lahir))
                    : '-';

                $daftarPenumpang .= ($index + 1) . ". {$penumpang->nama} | NIK: {$penumpang->nik} | Tgl Lahir: {$tglLahir}\n";
            }

            $tanggal = $manifest->tanggal_berangkat
                ? date('d-m-Y', strtotime($manifest->tanggal_berangkat))
                : '-';

            $pesan = "Halo, check-in manifest Anda berhasil.\n\n" .
                "Detail perjalanan:\n" .
                "Kapal: " . ($manifest->profiling->nama_kapal ?? '-') . "\n" .
                "Jenis Layanan: " . ucfirst($manifest->jenis_layanan) . "\n" .
                "Rute: {$manifest->asal} - {$manifest->tujuan}\n" .
                "Tanggal: {$tanggal}\n" .
                "Jam: {$manifest->jam_berangkat}\n" .
                "Jumlah Penumpang: {$manifest->jumlah_penumpang}\n";

            if ($manifest->jenis_layanan === 'penyeberangan') {
                $pesan .= "Bawa Kendaraan: " . ($manifest->bawa_kendaraan ?? 'Tidak') . "\n";
                if (($manifest->bawa_kendaraan ?? 'Tidak') === 'Ya') {
                    $pesan .= "Jenis Kendaraan: " . ($manifest->jenis_kendaraan ?? '-') . "\n";
                    $pesan .= "Plat Nomor: " . ($manifest->plat_nomor ?? '-') . "\n";
                }
            }

            $pesan .= "\nDaftar Penumpang:\n" . $daftarPenumpang;
            $pesan .= "\nKlik link berikut untuk membuka / download E-Ticket PDF:\n{$ticketUrl}\n\nTerima kasih.";

            $token = 'xMuwtojnCYHdTWKkqDdw';

            $payload = http_build_query([
                'target'  => $nomor,
                'message' => $pesan,
            ]);

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $payload,
                CURLOPT_HTTPHEADER => [
                    'Authorization: ' . $token,
                    'Content-Type: application/x-www-form-urlencoded',
                ],
            ]);

            $response = curl_exec($curl);

            if (curl_errno($curl)) {
                Log::error('Gagal mengirim WhatsApp manifest: ' . curl_error($curl));
            } else {
                Log::info('WhatsApp manifest berhasil dikirim: ' . $response);
            }

            curl_close($curl);
        } catch (\Throwable $e) {
            Log::error('Error sendWhatsAppMessage manifest: ' . $e->getMessage());
        }
    }

    private function normalizePhoneNumber(string $phone): string
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);

        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }

        if (substr($phone, 0, 2) !== '62') {
            $phone = '62' . $phone;
        }

        return $phone;
    }
}