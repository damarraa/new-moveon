<?php

namespace App\Http\Controllers;

use App\Models\Profiling;
use Illuminate\Http\Request;

class GuestManifestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kapals = Profiling::orderBy('nama_kapal', 'asc')->get();

        return view('checkin-manifest', compact('kapals'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'jenis_layanan' => 'required|in:pelayaran,penyeberangan',
            'profiling_id'  => 'required|exists:profilings,id',
            'asal'          => 'required|string',
            'tujuan'        => 'required|string',
            'tanggal_berangkat' => 'required|date',
            'jam_berangkat'     => 'required',
            'telepon'       => 'required|string',
            'bawa_kendaraan'   => 'required|in:Ya,Tidak',
            'jenis_kendaraan'  => 'required_if:bawa_kendaraan,Ya|string|nullable',
            'plat_nomor'       => 'required_if:bawa_kendaraan,Ya|string|nullable',
            'penumpangs'               => 'required|array|min:1',
            'penumpangs.*.nik'         => 'required|numeric|digits:16',
            'penumpangs.*.nama'        => 'required|string|max:255',
            'penumpangs.*.tanggal_lahir' => 'required|date',
        ]);

        // --- Bantu logic store data ke db snaak ---
        // Untuk sekarang, aku return success msg
        return back()->with('success', 'Data manifest berhasil disubmit! Bukti E-Ticket sedang diproses (Mockup).');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
