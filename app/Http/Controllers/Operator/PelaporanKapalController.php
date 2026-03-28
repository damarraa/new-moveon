<?php

namespace App\Http\Controllers\Operator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PelaporanKapal;
use Illuminate\Support\Facades\Auth;

class PelaporanKapalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pelaporanKapals = PelaporanKapal::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('operator.pelaporan-kapal.index', compact('pelaporanKapals'));
    }

    public function create()
    {
        return view('operator.pelaporan-kapal.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kapal' => ['required', 'string', 'max:255'],
            'status_operasi' => ['required', 'in:Docking,Rusak Sementara,Rusak Selamanya,Ubah Sifat'],
            'lama_tidak_beroperasi' => ['required', 'in:1-3 Bulan,3-6 Bulan,6-12 Bulan,Selamanya'],
        ], [
            'nama_kapal.required' => 'Nama kapal wajib diisi.',
            'status_operasi.required' => 'Status operasi wajib dipilih.',
            'status_operasi.in' => 'Status operasi tidak valid.',
            'lama_tidak_beroperasi.required' => 'Lama tidak beroperasi wajib dipilih.',
            'lama_tidak_beroperasi.in' => 'Lama tidak beroperasi tidak valid.',
        ]);

        PelaporanKapal::create([
            'user_id' => Auth::id(),
            'nama_kapal' => $validated['nama_kapal'],
            'status_operasi' => $validated['status_operasi'],
            'lama_tidak_beroperasi' => $validated['lama_tidak_beroperasi'],
        ]);

        return redirect()
            ->route('operator.pelaporan-kapal.index')
            ->with('success', 'Laporan kapal berhasil disimpan.');
    }

    public function show(string $id)
    {
        $pelaporanKapal = PelaporanKapal::where('user_id', Auth::id())
            ->findOrFail($id);

        return view('operator.pelaporan-kapal.show', compact('pelaporanKapal'));
    }

    public function edit(string $id)
    {
        $pelaporanKapal = PelaporanKapal::where('user_id', Auth::id())
            ->findOrFail($id);

        return view('operator.pelaporan-kapal.edit', compact('pelaporanKapal'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama_kapal' => ['required', 'string', 'max:255'],
            'status_operasi' => ['required', 'in:Docking,Rusak Sementara,Rusak Selamanya,Ubah Sifat'],
            'lama_tidak_beroperasi' => ['required', 'in:1-3 Bulan,3-6 Bulan,6-12 Bulan,Selamanya'],
        ], [
            'nama_kapal.required' => 'Nama kapal wajib diisi.',
            'status_operasi.required' => 'Status operasi wajib dipilih.',
            'status_operasi.in' => 'Status operasi tidak valid.',
            'lama_tidak_beroperasi.required' => 'Lama tidak beroperasi wajib dipilih.',
            'lama_tidak_beroperasi.in' => 'Lama tidak beroperasi tidak valid.',
        ]);

        $pelaporanKapal = PelaporanKapal::where('user_id', Auth::id())
            ->findOrFail($id);

        $pelaporanKapal->update([
            'nama_kapal' => $validated['nama_kapal'],
            'status_operasi' => $validated['status_operasi'],
            'lama_tidak_beroperasi' => $validated['lama_tidak_beroperasi'],
        ]);

        return redirect()
            ->route('operator.pelaporan-kapal.index')
            ->with('success', 'Laporan kapal berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $pelaporanKapal = PelaporanKapal::where('user_id', Auth::id())
            ->findOrFail($id);

        $pelaporanKapal->delete();

        return redirect()
            ->route('operator.pelaporan-kapal.index')
            ->with('success', 'Laporan kapal berhasil dihapus.');
    }
}