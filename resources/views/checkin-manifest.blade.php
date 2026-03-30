<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check-In Manifest Terpadu | MOVEON Jasa Raharja</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            navy: '#0B2447',
                            softblue: '#4F8AAB',
                            orange: '#E68940'
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }

        h1, h2, h3, .font-poppins {
            font-family: 'Poppins', sans-serif;
        }

        .radio-card-input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .radio-card-input:checked + .radio-card-body {
            border-color: #0B2447;
            background-color: #f0f4f8;
            box-shadow: 0 10px 24px rgba(11, 36, 71, 0.10);
        }

        .radio-card-input:checked + .radio-card-body .radio-check {
            opacity: 1;
            transform: scale(1);
        }

        .select2-container {
            width: 100% !important;
        }

        .select2-container .select2-selection--single {
            height: 52px !important;
            border-radius: 0.75rem !important;
            border: 1px solid #cbd5e1 !important;
            display: flex !important;
            align-items: center !important;
            background: #fff !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 50px !important;
            padding-left: 16px !important;
            padding-right: 38px !important;
            color: #334155 !important;
            font-size: 14px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 50px !important;
            right: 10px !important;
        }

        .select2-dropdown {
            border-radius: 14px !important;
            border: 1px solid #cbd5e1 !important;
            overflow: hidden !important;
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.10) !important;
        }

        .select2-search--dropdown {
            padding: 10px !important;
            background: #f8fafc !important;
            border-bottom: 1px solid #e2e8f0 !important;
        }

        .select2-search__field {
            border-radius: 10px !important;
            border: 1px solid #cbd5e1 !important;
            padding: 10px 12px !important;
            font-size: 14px !important;
        }

        .select2-results__option {
            padding: 10px 12px !important;
            font-size: 14px !important;
        }

        .select2-results__option--highlighted {
            background: #0B2447 !important;
        }
    </style>
</head>

<body class="text-slate-800 antialiased">
    <header class="bg-white border-b border-slate-200 sticky top-0 z-50 shadow-sm">
        <div class="container mx-auto px-4 sm:px-6 h-16 flex items-center justify-between max-w-4xl">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="MOVEON" class="h-8 object-contain">
                <div class="h-5 w-px bg-slate-300"></div>
                <h1 class="font-bold text-brand-navy text-lg font-poppins hidden sm:block">Manifest Terpadu</h1>
            </div>
            <a href="/"
               class="flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-brand-navy transition-colors bg-slate-50 hover:bg-slate-100 px-4 py-2 rounded-full border border-slate-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8 max-w-4xl">
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 rounded-2xl px-5 py-4 mb-6 shadow-sm">
                <div class="font-semibold mb-2">Ada data yang perlu diperbaiki:</div>
                <ul class="list-disc pl-5 text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-green-50 border border-green-200 rounded-2xl p-4 sm:p-5 mb-8 flex gap-4 items-start shadow-sm">
            <div class="bg-green-100 p-2 rounded-full text-green-600 shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                </svg>
            </div>
            <div>
                <h3 class="font-bold text-green-800 text-sm sm:text-base mb-1">E-Ticket Terintegrasi WhatsApp</h3>
                <p class="text-xs sm:text-sm text-green-700 leading-relaxed">
                    Bukti Check-In berupa <strong>PDF</strong> akan dikirim ke nomor WhatsApp perwakilan dan bisa langsung diunduh dari link yang diterima.
                </p>
            </div>
        </div>

        <form action="{{ route('guest.manifest.store') }}" method="POST" class="space-y-6" id="guestManifestForm">
            @csrf

            @php
                $oldJenis = old('jenis_layanan', 'pelayaran');
                $oldProfiling = old('profiling_id', '');
                $oldAsal = old('asal', '');
                $oldTujuan = old('tujuan', '');
                $oldTanggal = old('tanggal_berangkat', '');
                $oldJam = old('jam_berangkat', '');
                $oldTelepon = old('telepon', '');
                $oldBawa = old('bawa_kendaraan', 'Tidak');
                $oldJenisKendaraan = old('jenis_kendaraan', '');
                $oldPlat = old('plat_nomor', '');
                $oldPenumpangs = old('penumpangs', [['nik' => '', 'nama' => '', 'tanggal_lahir' => '']]);
                $roroNames = ['KMP Lome', 'KMP Tirus Meranti', 'KMP Wira Loewisa', 'KMP Teluk Singkil'];
            @endphp

            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6 sm:p-8">
                <div class="mb-6 border-b border-slate-100 pb-4">
                    <h2 class="text-xl font-bold text-brand-navy font-poppins">1. Jenis Layanan & Keberangkatan</h2>
                    <p class="text-sm text-slate-500">Pilih jenis layanan dan cari jadwal kapal yang tersedia.</p>
                </div>

                <div class="mb-8">
                    <label class="block text-sm font-semibold text-slate-700 mb-3">
                        Pilih Jenis Layanan Kapal <span class="text-red-500">*</span>
                    </label>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <label class="cursor-pointer relative">
                            <input type="radio" name="jenis_layanan" value="pelayaran" class="radio-card-input jenis-layanan-radio" {{ $oldJenis === 'pelayaran' ? 'checked' : '' }}>
                            <div class="radio-card-body p-4 border-2 border-slate-200 rounded-xl hover:border-brand-softblue transition-all flex items-center gap-4">
                                <div class="w-12 h-12 bg-orange-100 text-brand-orange rounded-full flex items-center justify-center text-xl shrink-0">🚢</div>
                                <div class="flex-grow">
                                    <h4 class="font-bold text-slate-800 text-sm">Pelayaran Umum</h4>
                                    <p class="text-xs text-slate-500 mt-0.5">Kapal laut reguler antar pulau</p>
                                </div>
                                <div class="radio-check opacity-0 transform scale-50 transition-all text-brand-navy shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </label>

                        <label class="cursor-pointer relative">
                            <input type="radio" name="jenis_layanan" value="penyeberangan" class="radio-card-input jenis-layanan-radio" {{ $oldJenis === 'penyeberangan' ? 'checked' : '' }}>
                            <div class="radio-card-body p-4 border-2 border-slate-200 rounded-xl hover:border-brand-softblue transition-all flex items-center gap-4">
                                <div class="w-12 h-12 bg-cyan-100 text-cyan-600 rounded-full flex items-center justify-center text-xl shrink-0">⛴️</div>
                                <div class="flex-grow">
                                    <h4 class="font-bold text-slate-800 text-sm">Penyeberangan Roro</h4>
                                    <p class="text-xs text-slate-500 mt-0.5">Kapal penyeberangan kendaraan dan penumpang</p>
                                </div>
                                <div class="radio-check opacity-0 transform scale-50 transition-all text-brand-navy shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-1">
                            Jadwal Keberangkatan <span class="text-red-500">*</span>
                        </label>

                        <select name="profiling_id" id="profiling_id" class="jadwal-select w-full" required>
                            <option value="">-- Cari jadwal keberangkatan --</option>

                            @foreach($kapals as $kapal)
                                @php
                                    $isRoro = in_array($kapal->nama_kapal, $roroNames);
                                    $jenisKapal = $isRoro ? 'penyeberangan' : 'pelayaran';
                                    $waktuText = $kapal->waktu_keberangkatan
                                        ? \Carbon\Carbon::parse($kapal->waktu_keberangkatan)->format('d-m-Y H:i')
                                        : '-';
                                @endphp
                                <option value="{{ $kapal->id }}"
                                        data-jenis="{{ $jenisKapal }}"
                                        data-asal="{{ $kapal->asal_keberangkatan }}"
                                        data-tujuan="{{ $kapal->tujuan_keberangkatan }}"
                                        data-tanggal="{{ $kapal->waktu_keberangkatan ? \Carbon\Carbon::parse($kapal->waktu_keberangkatan)->format('Y-m-d') : '' }}"
                                        data-jam="{{ $kapal->waktu_keberangkatan ? \Carbon\Carbon::parse($kapal->waktu_keberangkatan)->format('H:i') : '' }}"
                                        {{ (string)$oldProfiling === (string)$kapal->id ? 'selected' : '' }}>
                                    {{ $kapal->nama_kapal }} | {{ $kapal->asal_keberangkatan }} → {{ $kapal->tujuan_keberangkatan }} | {{ $waktuText }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Pelabuhan Asal <span class="text-red-500">*</span></label>
                        <input type="text" name="asal" id="asal" value="{{ $oldAsal }}" readonly class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-slate-100 text-slate-700">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Pelabuhan Tujuan <span class="text-red-500">*</span></label>
                        <input type="text" name="tujuan" id="tujuan" value="{{ $oldTujuan }}" readonly class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-slate-100 text-slate-700">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Tanggal Keberangkatan <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_berangkat" id="tanggal_berangkat" value="{{ $oldTanggal }}" readonly class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-slate-100 text-slate-700">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Jam Keberangkatan <span class="text-red-500">*</span></label>
                        <input type="time" name="jam_berangkat" id="jam_berangkat" value="{{ $oldJam }}" readonly class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-slate-100 text-slate-700">
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-1">No. WhatsApp Perwakilan (Penerima E-Ticket) <span class="text-red-500">*</span></label>
                        <input type="tel" name="telepon" value="{{ $oldTelepon }}" placeholder="Contoh: 08123456789" required class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-green-500 outline-none transition-all text-slate-700 bg-green-50/30">
                    </div>

                    <div id="kendaraanWrap" class="sm:col-span-2 pt-6 mt-2 border-t border-slate-100 {{ $oldJenis === 'penyeberangan' ? '' : 'hidden' }}">
                        <label class="block text-sm font-semibold text-slate-700 mb-3">Apakah Anda Membawa Kendaraan? <span class="text-red-500">*</span></label>

                        <div class="flex gap-4 mb-6 flex-wrap">
                            <label class="flex items-center gap-2 cursor-pointer bg-slate-50 px-4 py-2 border border-slate-200 rounded-lg hover:bg-slate-100 transition-colors">
                                <input type="radio" name="bawa_kendaraan" value="Tidak" {{ $oldBawa === 'Tidak' ? 'checked' : '' }} class="bawa-kendaraan-radio w-4 h-4 text-brand-softblue focus:ring-brand-softblue">
                                <span class="text-sm font-medium text-slate-700">Tidak (Penumpang Pejalan Kaki)</span>
                            </label>

                            <label class="flex items-center gap-2 cursor-pointer bg-brand-softblue/10 px-4 py-2 border border-brand-softblue/30 rounded-lg hover:bg-brand-softblue/20 transition-colors">
                                <input type="radio" name="bawa_kendaraan" value="Ya" {{ $oldBawa === 'Ya' ? 'checked' : '' }} class="bawa-kendaraan-radio w-4 h-4 text-brand-softblue focus:ring-brand-softblue">
                                <span class="text-sm font-medium text-brand-navy">Ya, Bawa Kendaraan</span>
                            </label>
                        </div>

                        <div id="kendaraanDetailWrap" class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-slate-50 p-5 rounded-2xl border border-brand-softblue/20 {{ $oldJenis === 'penyeberangan' && $oldBawa === 'Ya' ? '' : 'hidden' }}">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Jenis / Golongan Kendaraan <span class="text-red-500">*</span></label>
                                <select name="jenis_kendaraan" id="jenis_kendaraan" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-brand-softblue outline-none transition-all text-slate-700 bg-white cursor-pointer text-sm">
                                    <option value="">— Pilih Golongan Kendaraan —</option>
                                    <option value="Gol I" {{ $oldJenisKendaraan === 'Gol I' ? 'selected' : '' }}>Gol I (Sepeda)</option>
                                    <option value="Gol II" {{ $oldJenisKendaraan === 'Gol II' ? 'selected' : '' }}>Gol II (Sepeda Motor &lt; 500cc & Gerobak Dorong)</option>
                                    <option value="Gol III" {{ $oldJenisKendaraan === 'Gol III' ? 'selected' : '' }}>Gol III (Sepeda Motor Besar &gt; 500cc & Roda Tiga)</option>
                                    <option value="Gol IVA" {{ $oldJenisKendaraan === 'Gol IVA' ? 'selected' : '' }}>Gol IVA (Jeep, Sedan, Minibus)</option>
                                    <option value="Gol IVB" {{ $oldJenisKendaraan === 'Gol IVB' ? 'selected' : '' }}>Gol IVB (Mobil Bak Terbuka/Tertutup, Double Cabin)</option>
                                    <option value="Gol VA" {{ $oldJenisKendaraan === 'Gol VA' ? 'selected' : '' }}>Gol VA (Bus Penumpang pjg &gt; 5 - 7 meter)</option>
                                    <option value="Gol VB" {{ $oldJenisKendaraan === 'Gol VB' ? 'selected' : '' }}>Gol VB (Truk/Tangki sedang pjg &gt; 5 - 7 meter)</option>
                                    <option value="Gol VIA" {{ $oldJenisKendaraan === 'Gol VIA' ? 'selected' : '' }}>Gol VIA (Bus Penumpang pjg &gt; 7 - 10 meter)</option>
                                    <option value="Gol VIB" {{ $oldJenisKendaraan === 'Gol VIB' ? 'selected' : '' }}>Gol VIB (Truk/Tangki sedang pjg &gt; 7 - 10 meter)</option>
                                    <option value="Gol VII" {{ $oldJenisKendaraan === 'Gol VII' ? 'selected' : '' }}>Gol VII (Truk Tronton/Tangki/Gandengan pjg &gt; 10 - 12m)</option>
                                    <option value="Gol VIII" {{ $oldJenisKendaraan === 'Gol VIII' ? 'selected' : '' }}>Gol VIII (Truk Tronton/Alat Berat/Gandengan &gt; 12 - 16m)</option>
                                </select>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Nomor Polisi Kendaraan <span class="text-red-500">*</span></label>
                                <input type="text" name="plat_nomor" id="plat_nomor" value="{{ $oldPlat }}" placeholder="Contoh: BM 1234 ABC" class="w-full uppercase px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-brand-softblue outline-none transition-all text-slate-700 font-bold placeholder:font-normal placeholder:normal-case">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6 sm:p-8">
                <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-100 pb-4">
                    <div>
                        <h2 class="text-xl font-bold text-brand-navy font-poppins">2. Daftar Penumpang</h2>
                        <p class="text-sm text-slate-500">Masukkan detail penumpang. Klik tambah jika lebih dari 1 orang.</p>
                    </div>
                    <div class="bg-brand-softblue/10 text-brand-navy px-4 py-2 rounded-lg font-bold text-sm">
                        Total: <span id="totalPenumpang">{{ count($oldPenumpangs) }}</span> Penumpang
                    </div>
                </div>

                <div class="space-y-6" id="penumpangContainer">
                    @foreach($oldPenumpangs as $index => $penumpang)
                        <div class="p-5 rounded-2xl border border-slate-200 bg-slate-50 relative group transition-all penumpang-item">
                            <div class="flex justify-between items-center mb-4">
                                <h4 class="font-bold text-slate-700 penumpang-title">Penumpang #{{ $index + 1 }}</h4>
                                <button type="button" class="btnHapusPenumpang text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 px-3 py-1 rounded-lg text-sm font-medium transition-colors flex items-center gap-1" {{ count($oldPenumpangs) <= 1 ? 'style=display:none;' : '' }}>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Hapus
                                </button>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                <div class="lg:col-span-1">
                                    <label class="block text-xs font-semibold text-slate-600 mb-1">NIK <span class="text-red-500">*</span></label>
                                    <input type="text" name="penumpangs[{{ $index }}][nik]" value="{{ $penumpang['nik'] ?? '' }}" placeholder="16 Digit NIK" required class="w-full px-3 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-brand-navy outline-none transition-all text-sm text-slate-700">
                                </div>

                                <div class="lg:col-span-1">
                                    <label class="block text-xs font-semibold text-slate-600 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                                    <input type="text" name="penumpangs[{{ $index }}][nama]" value="{{ $penumpang['nama'] ?? '' }}" placeholder="Sesuai KTP" required class="w-full px-3 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-brand-navy outline-none transition-all text-sm text-slate-700">
                                </div>

                                <div class="lg:col-span-1">
                                    <label class="block text-xs font-semibold text-slate-600 mb-1">Tanggal Lahir <span class="text-red-500">*</span></label>
                                    <input type="date" name="penumpangs[{{ $index }}][tanggal_lahir]" value="{{ $penumpang['tanggal_lahir'] ?? '' }}" required class="w-full px-3 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-brand-navy outline-none transition-all text-sm text-slate-700">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <button type="button" id="btnTambahPenumpang" class="mt-6 w-full py-3 border-2 border-dashed border-slate-300 text-slate-600 font-semibold rounded-xl hover:bg-slate-50 hover:border-brand-navy hover:text-brand-navy transition-all flex justify-center items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Penumpang Lainnya
                </button>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full py-4 bg-brand-navy hover:bg-blue-900 text-white font-bold text-lg rounded-xl shadow-lg shadow-brand-navy/30 transition-all flex justify-center items-center gap-2">
                    <span>Proses Check-In</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>
        </form>
    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(function () {
            const $profiling = $('#profiling_id');
            const $asal = $('#asal');
            const $tujuan = $('#tujuan');
            const $tanggal = $('#tanggal_berangkat');
            const $jam = $('#jam_berangkat');
            const $kendaraanWrap = $('#kendaraanWrap');
            const $kendaraanDetailWrap = $('#kendaraanDetailWrap');

            function updateJenisCard() {
                $('.jenis-layanan-radio').each(function () {
                    const cardBody = $(this).siblings('.radio-card-body');
                    if ($(this).is(':checked')) {
                        cardBody.addClass('border-brand-navy bg-slate-100');
                    } else {
                        cardBody.removeClass('border-brand-navy bg-slate-100');
                    }
                });
            }

            function getJenisSelected() {
                return $('.jenis-layanan-radio:checked').val() || 'pelayaran';
            }

            function clearJadwalFields() {
                $asal.val('');
                $tujuan.val('');
                $tanggal.val('');
                $jam.val('');
            }

            function fillJadwalFields() {
                const $selected = $profiling.find('option:selected');
                if (!$selected.length || !$selected.val()) {
                    clearJadwalFields();
                    return;
                }

                $asal.val($selected.data('asal') || '');
                $tujuan.val($selected.data('tujuan') || '');
                $tanggal.val($selected.data('tanggal') || '');
                $jam.val($selected.data('jam') || '');
            }

            function filterJadwalByJenis(resetSelection = true) {
                const jenis = getJenisSelected();

                $profiling.find('option').each(function () {
                    const value = $(this).val();
                    if (!value) return;

                    const optionJenis = $(this).data('jenis');
                    if (optionJenis === jenis) {
                        $(this).prop('disabled', false);
                    } else {
                        if ($(this).is(':selected') && resetSelection) {
                            $(this).prop('selected', false);
                        }
                        $(this).prop('disabled', true);
                    }
                });

                if (resetSelection) {
                    $profiling.val('').trigger('change');
                    clearJadwalFields();
                }

                if (jenis === 'penyeberangan') {
                    $kendaraanWrap.removeClass('hidden');
                } else {
                    $kendaraanWrap.addClass('hidden');
                    $kendaraanDetailWrap.addClass('hidden');
                    $('input[name="bawa_kendaraan"][value="Tidak"]').prop('checked', true);
                    $('#jenis_kendaraan').val('');
                    $('#plat_nomor').val('');
                }
            }

            function updateKendaraanDetail() {
                const jenis = getJenisSelected();
                const bawa = $('input[name="bawa_kendaraan"]:checked').val() || 'Tidak';

                if (jenis === 'penyeberangan' && bawa === 'Ya') {
                    $kendaraanDetailWrap.removeClass('hidden');
                } else {
                    $kendaraanDetailWrap.addClass('hidden');
                    $('#jenis_kendaraan').val('');
                    $('#plat_nomor').val('');
                }
            }

            function refreshPenumpang() {
                $('#penumpangContainer .penumpang-item').each(function (index) {
                    $(this).find('.penumpang-title').text('Penumpang #' + (index + 1));
                    $(this).find('input[name*="[nik]"]').attr('name', `penumpangs[${index}][nik]`);
                    $(this).find('input[name*="[nama]"]').attr('name', `penumpangs[${index}][nama]`);
                    $(this).find('input[name*="[tanggal_lahir]"]').attr('name', `penumpangs[${index}][tanggal_lahir]`);
                });

                const total = $('#penumpangContainer .penumpang-item').length;
                $('#totalPenumpang').text(total);

                if (total <= 1) {
                    $('.btnHapusPenumpang').hide();
                } else {
                    $('.btnHapusPenumpang').show();
                }
            }

            $profiling.select2({
                placeholder: '-- Cari jadwal keberangkatan --',
                allowClear: true,
                width: '100%'
            });

            $('.jenis-layanan-radio').on('change', function () {
                updateJenisCard();
                filterJadwalByJenis(true);
                updateKendaraanDetail();
            });

            $profiling.on('change', function () {
                fillJadwalFields();
            });

            $(document).on('change', 'input[name="bawa_kendaraan"]', function () {
                updateKendaraanDetail();
            });

            $('#btnTambahPenumpang').on('click', function () {
                const index = $('#penumpangContainer .penumpang-item').length;

                const html = `
                    <div class="p-5 rounded-2xl border border-slate-200 bg-slate-50 relative group transition-all penumpang-item">
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="font-bold text-slate-700 penumpang-title">Penumpang #${index + 1}</h4>
                            <button type="button" class="btnHapusPenumpang text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 px-3 py-1 rounded-lg text-sm font-medium transition-colors flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Hapus
                            </button>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div class="lg:col-span-1">
                                <label class="block text-xs font-semibold text-slate-600 mb-1">NIK <span class="text-red-500">*</span></label>
                                <input type="text" name="penumpangs[${index}][nik]" placeholder="16 Digit NIK" required class="w-full px-3 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-brand-navy outline-none transition-all text-sm text-slate-700">
                            </div>

                            <div class="lg:col-span-1">
                                <label class="block text-xs font-semibold text-slate-600 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" name="penumpangs[${index}][nama]" placeholder="Sesuai KTP" required class="w-full px-3 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-brand-navy outline-none transition-all text-sm text-slate-700">
                            </div>

                            <div class="lg:col-span-1">
                                <label class="block text-xs font-semibold text-slate-600 mb-1">Tanggal Lahir <span class="text-red-500">*</span></label>
                                <input type="date" name="penumpangs[${index}][tanggal_lahir]" required class="w-full px-3 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-brand-navy outline-none transition-all text-sm text-slate-700">
                            </div>
                        </div>
                    </div>
                `;

                $('#penumpangContainer').append(html);
                refreshPenumpang();
            });

            $(document).on('click', '.btnHapusPenumpang', function () {
                if ($('#penumpangContainer .penumpang-item').length <= 1) return;
                $(this).closest('.penumpang-item').remove();
                refreshPenumpang();
            });

            updateJenisCard();
            filterJadwalByJenis(false);
            updateKendaraanDetail();
            refreshPenumpang();

            if ($profiling.val()) {
                fillJadwalFields();
            }

            @if(session('success_popup'))
                Swal.fire({
                    icon: 'success',
                    title: @json(session('success_popup.title')),
                    text: @json(session('success_popup.text')),
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#0B2447'
                });
            @endif
        });
    </script>
</body>
</html>