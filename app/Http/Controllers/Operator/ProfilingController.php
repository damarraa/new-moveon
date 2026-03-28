<?php

namespace App\Http\Controllers\Operator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Profiling;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ProfilingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $profilings = Profiling::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('operator.profiling.index', compact('profilings'));
    }

    public function create()
    {
        return redirect()->route('operator.profiling.index');
    }

    public function show($id)
    {
        $profiling = Profiling::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('operator.profiling.show', compact('profiling'));
    }

    public function edit($id)
    {
        return redirect()->route('operator.profiling.index');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama_kapal'           => ['required', 'string', 'max:255'],
                'asal_keberangkatan'   => ['required', 'string', 'max:255'],
                'tujuan_keberangkatan' => ['required', 'string', 'max:255'],
                'waktu_keberangkatan'  => ['required', 'date'],
                'kapasitas_penumpang'  => ['required', 'integer', 'min:1'],
            ], [
                'nama_kapal.required'           => 'Nama kapal wajib diisi.',
                'asal_keberangkatan.required'   => 'Asal keberangkatan wajib diisi.',
                'tujuan_keberangkatan.required' => 'Tujuan keberangkatan wajib diisi.',
                'waktu_keberangkatan.required'  => 'Waktu keberangkatan wajib diisi.',
                'waktu_keberangkatan.date'      => 'Format waktu keberangkatan tidak valid.',
                'kapasitas_penumpang.required'  => 'Kapasitas penumpang wajib diisi.',
                'kapasitas_penumpang.integer'   => 'Kapasitas penumpang harus berupa angka.',
                'kapasitas_penumpang.min'       => 'Kapasitas penumpang minimal 1.',
            ]);
        } catch (ValidationException $e) {
            return redirect()
                ->route('operator.profiling.index')
                ->withErrors($e->validator)
                ->withInput()
                ->with('open_modal', 'create');
        }

        Profiling::create([
            'user_id'              => Auth::id(),
            'nama_kapal'           => $validated['nama_kapal'],
            'asal_keberangkatan'   => $validated['asal_keberangkatan'],
            'tujuan_keberangkatan' => $validated['tujuan_keberangkatan'],
            'waktu_keberangkatan'  => $validated['waktu_keberangkatan'],
            'kapasitas_penumpang'  => $validated['kapasitas_penumpang'],
        ]);

        return redirect()
            ->route('operator.profiling.index')
            ->with('success', 'Data profiling berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        $profiling = Profiling::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        try {
            $validated = $request->validate([
                'nama_kapal'           => ['required', 'string', 'max:255'],
                'asal_keberangkatan'   => ['required', 'string', 'max:255'],
                'tujuan_keberangkatan' => ['required', 'string', 'max:255'],
                'waktu_keberangkatan'  => ['required', 'date'],
                'kapasitas_penumpang'  => ['required', 'integer', 'min:1'],
            ], [
                'nama_kapal.required'           => 'Nama kapal wajib diisi.',
                'asal_keberangkatan.required'   => 'Asal keberangkatan wajib diisi.',
                'tujuan_keberangkatan.required' => 'Tujuan keberangkatan wajib diisi.',
                'waktu_keberangkatan.required'  => 'Waktu keberangkatan wajib diisi.',
                'waktu_keberangkatan.date'      => 'Format waktu keberangkatan tidak valid.',
                'kapasitas_penumpang.required'  => 'Kapasitas penumpang wajib diisi.',
                'kapasitas_penumpang.integer'   => 'Kapasitas penumpang harus berupa angka.',
                'kapasitas_penumpang.min'       => 'Kapasitas penumpang minimal 1.',
            ]);
        } catch (ValidationException $e) {
            return redirect()
                ->route('operator.profiling.index')
                ->withErrors($e->validator)
                ->withInput()
                ->with('open_modal', 'edit')
                ->with('edit_id', $profiling->id);
        }

        $profiling->update([
            'nama_kapal'           => $validated['nama_kapal'],
            'asal_keberangkatan'   => $validated['asal_keberangkatan'],
            'tujuan_keberangkatan' => $validated['tujuan_keberangkatan'],
            'waktu_keberangkatan'  => $validated['waktu_keberangkatan'],
            'kapasitas_penumpang'  => $validated['kapasitas_penumpang'],
        ]);

        return redirect()
            ->route('operator.profiling.index')
            ->with('success', 'Data profiling berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $profiling = Profiling::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $profiling->delete();

        return redirect()
            ->route('operator.profiling.index')
            ->with('success', 'Data profiling berhasil dihapus.');
    }
}