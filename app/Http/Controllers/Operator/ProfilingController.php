<?php

namespace App\Http\Controllers\Operator;

use Illuminate\Http\Request;

class ProfilingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('profiling.index');
    }

    public function create()
    {
        return view('profiling.create');
    }

    public function show($id)
    {
        return view('profiling.show', ['id' => $id]);
    }

    public function edit($id)
    {
        return view('profiling.edit', ['id' => $id]);
    }

    public function store(Request $request)
    {
        return redirect()->route('profiling.index')->with('success', 'Data profiling berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('profiling.index')->with('success', 'Data profiling berhasil diperbarui.');
    }

    public function destroy($id)
    {
        return redirect()->route('profiling.index')->with('success', 'Data profiling berhasil dihapus.');
    }
}
