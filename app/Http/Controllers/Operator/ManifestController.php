<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\CheckinManifest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class ManifestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $rawManifests = CheckinManifest::with(['profiling', 'penumpangs'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        $manifests = $rawManifests
            ->groupBy(function ($item) {
                return $this->buildGroupKey($item);
            })
            ->map(function ($group, $groupKey) {
                $first = $group->first();

                $allPassengers = $group->flatMap(function ($manifest) {
                    return $manifest->penumpangs ?? collect();
                });

                $totalPassengers = $allPassengers->count() > 0
                    ? $allPassengers->count()
                    : $group->sum(function ($manifest) {
                        return (int) ($manifest->jumlah_penumpang ?? 0);
                    });

                return (object) [
                    'group_key' => $this->encodeGroupKey($groupKey),
                    'nama_kapal' => $first->profiling->nama_kapal ?? '-',
                    'profiling' => $first->profiling,
                    'jenis_layanan' => $first->jenis_layanan ?? '-',
                    'asal' => $first->asal ?? '-',
                    'tujuan' => $first->tujuan ?? '-',
                    'tanggal_berangkat' => $first->tanggal_berangkat,
                    'jam_berangkat' => $first->jam_berangkat,
                    'jumlah_penumpang_group' => $totalPassengers,
                ];
            })
            ->values();

        return view('operator.manifest.index', compact('manifests'));
    }

    public function show($key)
    {
        $rawManifests = CheckinManifest::with(['profiling', 'penumpangs'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        $decodedGroupKey = $this->decodeGroupKey($key);

        if (!empty($decodedGroupKey)) {
            $matchedManifests = $rawManifests
                ->filter(function ($item) use ($decodedGroupKey) {
                    return $this->buildGroupKey($item) === $decodedGroupKey;
                })
                ->values();

            if ($matchedManifests->isNotEmpty()) {
                return $this->renderGroupedDetail($matchedManifests, $decodedGroupKey);
            }
        }

        $singleManifest = $rawManifests->first(function ($item) use ($key) {
            return (string) $item->id === (string) $key;
        });

        if ($singleManifest) {
            return $this->renderGroupedDetail(
                collect([$singleManifest]),
                $this->buildGroupKey($singleManifest)
            );
        }

        abort(404);
    }

    public function create()
    {
        return redirect()
            ->route('operator.manifest.index')
            ->with('error', 'Halaman tambah manifest tidak digunakan di menu operator.');
    }

    public function store()
    {
        return redirect()
            ->route('operator.manifest.index')
            ->with('error', 'Simpan manifest dari menu operator tidak diaktifkan.');
    }

    public function edit($id)
    {
        return redirect()
            ->route('operator.manifest.index')
            ->with('error', 'Edit manifest tidak diaktifkan.');
    }

    public function update($id)
    {
        return redirect()
            ->route('operator.manifest.index')
            ->with('error', 'Update manifest tidak diaktifkan.');
    }

    public function destroy($id)
    {
        return redirect()
            ->route('operator.manifest.index')
            ->with('error', 'Hapus manifest tidak diaktifkan.');
    }

    private function renderGroupedDetail(Collection $matchedManifests, string $groupKey)
    {
        $first = $matchedManifests->first();

        $allPassengers = $matchedManifests
            ->flatMap(function ($manifest) {
                return $manifest->penumpangs ?? collect();
            })
            ->values();

        $uniquePassengers = $allPassengers
            ->unique(function ($penumpang) {
                return $penumpang->id
                    ?? md5(
                        ($penumpang->nik ?? '') . '|' .
                        ($penumpang->nama ?? '') . '|' .
                        ($penumpang->tanggal_lahir ?? '')
                    );
            })
            ->values();

        $allVehicles = $matchedManifests
            ->filter(function ($item) {
                $bawa = strtolower(trim((string) ($item->bawa_kendaraan ?? '')));
                return in_array($bawa, ['ya', 'iya', 'yes', '1', 'true']);
            })
            ->map(function ($item) {
                return (object) [
                    'telepon' => $item->telepon ?: '-',
                    'jenis_kendaraan' => $item->jenis_kendaraan ?: '-',
                    'plat_nomor' => $item->plat_nomor ?: '-',
                ];
            })
            ->unique(function ($item) {
                return ($item->telepon ?? '-') . '|' .
                       ($item->jenis_kendaraan ?? '-') . '|' .
                       ($item->plat_nomor ?? '-');
            })
            ->values();

        $checkinGroups = $matchedManifests
            ->groupBy(function ($item) {
                $telepon = trim((string) ($item->telepon ?? ''));
                return $telepon !== '' ? $telepon : 'tanpa_nomor';
            })
            ->map(function ($group, $telepon) {
                $groupPassengers = $group
                    ->flatMap(function ($manifest) {
                        return $manifest->penumpangs ?? collect();
                    })
                    ->unique(function ($penumpang) {
                        return $penumpang->id
                            ?? md5(
                                ($penumpang->nik ?? '') . '|' .
                                ($penumpang->nama ?? '') . '|' .
                                ($penumpang->tanggal_lahir ?? '')
                            );
                    })
                    ->values();

                $groupVehicles = $group
                    ->filter(function ($item) {
                        $bawa = strtolower(trim((string) ($item->bawa_kendaraan ?? '')));
                        return in_array($bawa, ['ya', 'iya', 'yes', '1', 'true']);
                    })
                    ->map(function ($item) {
                        return (object) [
                            'jenis_kendaraan' => $item->jenis_kendaraan ?: '-',
                            'plat_nomor' => $item->plat_nomor ?: '-',
                        ];
                    })
                    ->unique(function ($item) {
                        return ($item->jenis_kendaraan ?? '-') . '|' . ($item->plat_nomor ?? '-');
                    })
                    ->values();

                return (object) [
                    'telepon' => $telepon === 'tanpa_nomor' ? '-' : $telepon,
                    'jumlah_data' => $group->count(),
                    'jumlah_penumpang' => $groupPassengers->count() > 0
                        ? $groupPassengers->count()
                        : $group->sum(function ($item) {
                            return (int) ($item->jumlah_penumpang ?? 0);
                        }),
                    'jumlah_kendaraan' => $groupVehicles->count(),
                    'penumpangs' => $groupPassengers,
                    'kendaraans' => $groupVehicles,
                ];
            })
            ->values();

        $manifest = (object) [
            'group_key' => $this->encodeGroupKey($groupKey),
            'raw_group_key' => $groupKey,
            'nama_kapal' => $first->profiling->nama_kapal ?? '-',
            'jenis_layanan' => $first->jenis_layanan ?? '-',
            'asal' => $first->asal ?? '-',
            'tujuan' => $first->tujuan ?? '-',
            'tanggal_berangkat' => $first->tanggal_berangkat,
            'jam_berangkat' => $first->jam_berangkat,
            'jumlah_penumpang' => $uniquePassengers->count() > 0
                ? $uniquePassengers->count()
                : $matchedManifests->sum(function ($item) {
                    return (int) ($item->jumlah_penumpang ?? 0);
                }),
            'jumlah_kendaraan' => $allVehicles->count(),
            'jumlah_kelompok' => $checkinGroups->count(),
            'group_count' => $matchedManifests->count(),
            'penumpangs' => $uniquePassengers,
            'kendaraans' => $allVehicles,
            'kelompoks' => $checkinGroups,
        ];

        return view('operator.manifest.show', compact('manifest'));
    }

    private function buildGroupKey($item): string
    {
        $namaKapal = strtolower(trim($item->profiling->nama_kapal ?? ''));
        $jenisLayanan = strtolower(trim($item->jenis_layanan ?? ''));
        $asal = strtolower(trim($item->asal ?? ''));
        $tujuan = strtolower(trim($item->tujuan ?? ''));

        $tanggal = !empty($item->tanggal_berangkat)
            ? date('Y-m-d', strtotime($item->tanggal_berangkat))
            : '';

        $jam = !empty($item->jam_berangkat)
            ? date('H:i', strtotime($item->jam_berangkat))
            : '';

        return implode('|', [
            $namaKapal,
            $jenisLayanan,
            $asal,
            $tujuan,
            $tanggal,
            $jam,
        ]);
    }

    private function encodeGroupKey(string $value): string
    {
        return rtrim(strtr(base64_encode($value), '+/', '-_'), '=');
    }

    private function decodeGroupKey(?string $value): ?string
    {
        if (empty($value)) {
            return null;
        }

        $decoded = base64_decode(strtr($value, '-_', '+/'), true);

        return $decoded !== false ? $decoded : null;
    }
}