<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check-In Manifest Pelayaran | MOVEON Jasa Raharja</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Poppins:wght@500;600;700&display=swap"
        rel="stylesheet">

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

        h1,
        h2,
        h3,
        .font-poppins {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="text-slate-800 antialiased" x-data="{
    perjalanan: {
        kapal: '',
        asal: '',
        tujuan: '',
        tanggalBerangkat: '',
        jamBerangkat: '',
        telepon: ''
    },
    // Array dinamis untuk penumpang, default ada 1 form kosong
    daftarPenumpang: [
        { id: Date.now(), nama: '', nik: '', tanggalLahir: '' }
    ],

    tambahPenumpang() {
        this.daftarPenumpang.push({ id: Date.now(), nama: '', nik: '', tanggalLahir: '' });
    },

    hapusPenumpang(id) {
        if (this.daftarPenumpang.length > 1) {
            this.daftarPenumpang = this.daftarPenumpang.filter(p => p.id !== id);
        }
    },

    // Fungsi cek anak diubah agar menerima parameter tanggal dari per-penumpang
    cekAnak(tgl) {
        if (!tgl) return false;
        const birthDate = new Date(tgl);
        const today = new Date();
        let age = today.getFullYear() - birthDate.getFullYear();
        const m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        return age >= 0 && age <= 2;
    }
}">

    <header class="bg-white border-b border-slate-200 sticky top-0 z-50 shadow-sm">
        <div class="container mx-auto px-4 sm:px-6 h-16 flex items-center justify-between max-w-4xl">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="MOVEON" class="h-8 object-contain">
                <div class="h-5 w-px bg-slate-300"></div>
                <h1 class="font-bold text-brand-navy text-lg font-poppins hidden sm:block">Manifest Pelayaran</h1>
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
                    Bukti Check-In (termasuk daftar rombongan) berupa <strong>PDF</strong> akan dikirim otomatis ke
                    nomor WhatsApp perwakilan yang Anda masukkan di bawah.
                </p>
            </div>
        </div>

        <form action="#" method="POST" class="space-y-6">

            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6 sm:p-8">
                <div class="mb-6 border-b border-slate-100 pb-4">
                    <h2 class="text-xl font-bold text-brand-navy font-poppins">1. Data Keberangkatan & Kontak</h2>
                    <p class="text-sm text-slate-500">Informasi kapal dan kontak perwakilan rombongan.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Nama Kapal <span
                                class="text-red-500">*</span></label>
                        <input type="text" x-model="perjalanan.kapal" placeholder="Contoh: KM Kelud" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-brand-orange focus:border-brand-orange outline-none transition-all text-slate-700">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Pelabuhan Asal <span
                                class="text-red-500">*</span></label>
                        <input type="text" x-model="perjalanan.asal" placeholder="Asal..." required
                            class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-brand-orange outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Pelabuhan Tujuan <span
                                class="text-red-500">*</span></label>
                        <input type="text" x-model="perjalanan.tujuan" placeholder="Tujuan..." required
                            class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-brand-orange outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Tanggal Keberangkatan <span
                                class="text-red-500">*</span></label>
                        <input type="date" x-model="perjalanan.tanggalBerangkat" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-brand-orange outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Jam Keberangkatan <span
                                class="text-red-500">*</span></label>
                        <input type="time" x-model="perjalanan.jamBerangkat" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-brand-orange outline-none transition-all">
                    </div>
                    <div class="sm:col-span-2 mt-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-1">No. WhatsApp Perwakilan (Penerima
                            E-Ticket) <span class="text-red-500">*</span></label>
                        <input type="tel" x-model="perjalanan.telepon" placeholder="Contoh: 08123456789" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-green-500 outline-none transition-all text-slate-700 bg-green-50/30">
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6 sm:p-8">
                <div
                    class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-100 pb-4">
                    <div>
                        <h2 class="text-xl font-bold text-brand-navy font-poppins">2. Daftar Penumpang</h2>
                        <p class="text-sm text-slate-500">Masukkan detail penumpang. Klik tambah jika lebih dari 1
                            orang.</p>
                    </div>
                    <div class="bg-brand-softblue/10 text-brand-navy px-4 py-2 rounded-lg font-bold text-sm">
                        Total: <span x-text="daftarPenumpang.length"></span> Penumpang
                    </div>
                </div>

                <div class="space-y-6">
                    <template x-for="(penumpang, index) in daftarPenumpang" :key="penumpang.id">
                        <div class="p-5 rounded-2xl border border-slate-200 bg-slate-50 relative group transition-all">

                            <div class="flex justify-between items-center mb-4">
                                <h4 class="font-bold text-slate-700">Penumpang #<span x-text="index + 1"></span></h4>

                                <button type="button" x-show="daftarPenumpang.length > 1"
                                    @click="hapusPenumpang(penumpang.id)"
                                    class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 px-3 py-1 rounded-lg text-sm font-medium transition-colors flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                    Hapus
                                </button>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                <div class="lg:col-span-1">
                                    <label class="block text-xs font-semibold text-slate-600 mb-1">NIK <span
                                            class="text-red-500">*</span></label>
                                    <input type="number" x-model="penumpang.nik" placeholder="16 Digit NIK" required
                                        class="w-full px-3 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-brand-softblue outline-none transition-all text-sm">
                                </div>

                                <div class="lg:col-span-1">
                                    <label
                                        class="block text-xs font-semibold text-slate-600 mb-1 flex items-center gap-2">
                                        Nama Lengkap <span class="text-red-500">*</span>
                                        <span x-show="cekAnak(penumpang.tanggalLahir)" x-transition
                                            class="bg-brand-orange text-white text-[9px] uppercase font-bold px-1.5 py-0.5 rounded tracking-wide animate-pulse">Anak</span>
                                    </label>
                                    <input type="text" x-model="penumpang.nama" placeholder="Sesuai KTP" required
                                        class="w-full px-3 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-brand-softblue outline-none transition-all text-sm">
                                </div>

                                <div class="lg:col-span-1">
                                    <label class="block text-xs font-semibold text-slate-600 mb-1">Tanggal Lahir <span
                                            class="text-red-500">*</span></label>
                                    <input type="date" x-model="penumpang.tanggalLahir" required
                                        class="w-full px-3 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-brand-softblue outline-none transition-all text-sm">
                                </div>
                            </div>
                        </div>
                    </template>
                </div>

                <button type="button" @click="tambahPenumpang()"
                    class="mt-6 w-full py-3 border-2 border-dashed border-slate-300 text-slate-600 font-semibold rounded-xl hover:bg-slate-50 hover:border-brand-softblue hover:text-brand-softblue transition-all flex justify-center items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                        </path>
                    </svg>
                    Tambah Penumpang Lainnya
                </button>
            </div>

            <div class="pt-4">
                <button type="button"
                    class="w-full py-4 bg-brand-orange hover:bg-orange-600 text-white font-bold text-lg rounded-xl shadow-lg shadow-brand-orange/30 transition-all flex justify-center items-center gap-2">
                    <span>Proses Check-In & Kirim E-Ticket</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                        </path>
                    </svg>
                </button>
            </div>

        </form>
    </main>

</body>

</html>
