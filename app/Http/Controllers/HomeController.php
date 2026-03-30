<?php

namespace App\Http\Controllers;

use App\Models\CheckinManifest;
use App\Models\CheckinManifestPenumpang;
use App\Models\PelaporanKapal;
use App\Models\Profiling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     */
    public function index()
    {
        $userId = Auth::id();
        $today = Carbon::today();

        // Ringkasan utama
        $totalProfiling = Profiling::where('user_id', $userId)->count();

        $totalManifest = CheckinManifest::where('user_id', $userId)->count();

        $totalPenumpang = CheckinManifestPenumpang::whereHas('checkinManifest', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->count();

        $totalKendaraan = CheckinManifest::where('user_id', $userId)
            ->whereIn(DB::raw('LOWER(COALESCE(bawa_kendaraan, ""))'), ['ya', 'iya', 'yes', '1', 'true'])
            ->count();

        $totalPelaporan = PelaporanKapal::where('user_id', $userId)->count();

        // Status operasional kapal
        $kapalBeroperasi = PelaporanKapal::where('user_id', $userId)
            ->whereRaw('LOWER(COALESCE(status_operasi, "")) = ?', ['beroperasi'])
            ->count();

        $kapalTidakBeroperasi = PelaporanKapal::where('user_id', $userId)
            ->whereRaw('LOWER(COALESCE(status_operasi, "")) = ?', ['tidak beroperasi'])
            ->count();

        $kapalStatusLain = PelaporanKapal::where('user_id', $userId)
            ->whereNotNull('status_operasi')
            ->whereRaw('LOWER(COALESCE(status_operasi, "")) NOT IN (?, ?)', ['beroperasi', 'tidak beroperasi'])
            ->count();

        // Manifest hari ini
        $manifestHariIni = CheckinManifest::where('user_id', $userId)
            ->whereDate('tanggal_berangkat', $today)
            ->count();

        // Penumpang hari ini
        $penumpangHariIni = CheckinManifestPenumpang::whereHas('checkinManifest', function ($query) use ($userId, $today) {
            $query->where('user_id', $userId)
                  ->whereDate('tanggal_berangkat', $today);
        })->count();

        // Jadwal terdekat dari profiling
        $jadwalTerdekat = Profiling::where('user_id', $userId)
            ->whereNotNull('waktu_keberangkatan')
            ->orderBy('waktu_keberangkatan', 'asc')
            ->take(5)
            ->get();

        // Manifest terbaru
        $manifestTerbaru = CheckinManifest::with(['profiling'])
            ->where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        // Kapal paling aktif berdasarkan jumlah manifest
        $kapalAktif = CheckinManifest::query()
            ->leftJoin('profilings', 'checkin_manifests.profiling_id', '=', 'profilings.id')
            ->where('checkin_manifests.user_id', $userId)
            ->select(
                DB::raw('COALESCE(profilings.nama_kapal, "Tanpa Nama Kapal") as nama_kapal'),
                DB::raw('COUNT(checkin_manifests.id) as total_manifest'),
                DB::raw('COALESCE(SUM(checkin_manifests.jumlah_penumpang), 0) as total_penumpang')
            )
            ->groupBy('profilings.nama_kapal')
            ->orderByDesc('total_manifest')
            ->take(5)
            ->get();

        // Rute paling sering dipakai
        $rutePopuler = CheckinManifest::where('user_id', $userId)
            ->select(
                'asal',
                'tujuan',
                DB::raw('COUNT(id) as total_manifest'),
                DB::raw('COALESCE(SUM(jumlah_penumpang), 0) as total_penumpang')
            )
            ->groupBy('asal', 'tujuan')
            ->orderByDesc('total_manifest')
            ->take(5)
            ->get();

        // Rekap jenis layanan
        $jenisLayanan = CheckinManifest::where('user_id', $userId)
            ->select(
                DB::raw('COALESCE(jenis_layanan, "tidak diketahui") as jenis_layanan'),
                DB::raw('COUNT(id) as total')
            )
            ->groupBy('jenis_layanan')
            ->orderByDesc('total')
            ->get();

        // Rekap manifest bulanan 6 bulan terakhir
        $manifestBulananRaw = CheckinManifest::where('user_id', $userId)
            ->whereNotNull('tanggal_berangkat')
            ->whereDate('tanggal_berangkat', '>=', now()->startOfMonth()->subMonths(5))
            ->selectRaw('DATE_FORMAT(tanggal_berangkat, "%Y-%m") as bulan, COUNT(id) as total')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get()
            ->keyBy('bulan');

        $manifestBulanan = collect();
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->startOfMonth()->subMonths($i);
            $key = $month->format('Y-m');
            $manifestBulanan->push((object) [
                'label' => $month->translatedFormat('M Y'),
                'total' => (int) ($manifestBulananRaw[$key]->total ?? 0),
            ]);
        }

        return view('home', compact(
            'totalProfiling',
            'totalManifest',
            'totalPenumpang',
            'totalKendaraan',
            'totalPelaporan',
            'kapalBeroperasi',
            'kapalTidakBeroperasi',
            'kapalStatusLain',
            'manifestHariIni',
            'penumpangHariIni',
            'jadwalTerdekat',
            'manifestTerbaru',
            'kapalAktif',
            'rutePopuler',
            'jenisLayanan',
            'manifestBulanan'
        ));
    }
}