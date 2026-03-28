<?php

namespace App\Http\Controllers\Operator;

use Illuminate\Http\Request;

class ManifestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('manifest.index');
    }

    public function create()
    {
        return view('manifest.create');
    }

    public function show($id)
    {
        return view('manifest.show', ['id' => $id]);
    }

    public function edit($id)
    {
        return view('manifest.edit', ['id' => $id]);
    }

    public function store(Request $request)
    {
        return redirect()->route('manifest.index')->with('success', 'Data manifest berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('manifest.index')->with('success', 'Data manifest berhasil diperbarui.');
    }

    public function destroy($id)
    {
        return redirect()->route('manifest.index')->with('success', 'Data manifest berhasil dihapus.');
    }
}
