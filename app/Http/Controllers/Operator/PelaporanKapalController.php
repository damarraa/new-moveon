<?php

namespace App\Http\Controllers\Operator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 


class PelaporanKapalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('operator.pelaporan-kapal.index');
    }

    public function create()
    {
        return view('operator.pelaporan-kapal.create');
    }

    public function show($id)
    {
        return view('operator.pelaporan-kapal.show', ['id' => $id]);
    }

    public function edit($id)
    {
        return view('operator.pelaporan-kapal.edit', ['id' => $id]);
    }

    public function store(Request $request)
    {
        return redirect()->route('operator.pelaporan-kapal.index')->with('success', 'Laporan kapal berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('operator.pelaporan-kapal.index')->with('success', 'Laporan kapal berhasil diperbarui.');
    }

    public function destroy($id)
    {
        return redirect()->route('operator.pelaporan-kapal.index')->with('success', 'Laporan kapal berhasil dihapus.');
    }
}
