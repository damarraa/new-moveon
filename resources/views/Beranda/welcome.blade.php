<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MOVEON | Jasa Raharja Riau</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Poppins:wght@500;600;700;900&display=swap"
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
        }

        h1,
        h2,
        h3,
        .font-poppins {
            font-family: 'Poppins', sans-serif;
        }

        .glass-panel {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.6);
        }

        .leaflet-control-zoom a {
            background-color: #ffffff !important;
            color: #0B2447 !important;
            border-color: #cbd5e1 !important;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 antialiased flex flex-col min-h-screen">

    <nav
        class="fixed w-full top-0 z-50 bg-white/95 backdrop-blur-md shadow-sm py-3 transition-all duration-300 border-b border-slate-200">
        <div class="container mx-auto px-6 lg:px-12 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <img src="{{ asset('assets/logo/jasaraharja.png') }}" alt="Jasa Raharja" class="h-8 lg:h-10 object-contain">
                <div class="h-8 w-px bg-slate-300 hidden sm:block"></div>
                <img src="{{ asset('assets/logo/logo.png') }}" alt="MOVEON"
                    class="h-10 lg:h-12 object-contain hidden sm:block">
            </div>

            <div class="flex items-center gap-3 lg:gap-4">
                <a href="#layanan"
                    class="hidden lg:flex items-center gap-2 text-sm text-slate-600 hover:text-brand-orange font-medium transition-colors">
                    Pendaftaran Operator
                </a>
                <a href="#layanan"
                    class="hidden lg:flex items-center gap-2 text-sm text-slate-600 hover:text-brand-orange font-medium transition-colors">
                    Check-in Manifest
                </a>
                <a href="#contact"
                    class="hidden lg:flex items-center gap-2 text-sm text-slate-600 hover:text-brand-orange font-medium transition-colors">
                    Contact
                </a>

                <a href="/register/operator"
                    class="hidden sm:flex items-center gap-2 border border-brand-softblue text-brand-navy hover:bg-brand-softblue hover:text-white px-5 py-2.5 rounded-full font-medium transition-all shadow-sm hover:shadow-md">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4v16m8-8H4"></path>
                    </svg>
                    Pendaftaran Operator
                </a>

                <a href="/login"
                    class="bg-brand-navy text-white hover:bg-blue-900 px-6 py-2.5 rounded-full font-medium transition-all shadow-md hover:shadow-lg flex items-center gap-2 ml-2">
                    Login
                </a>
            </div>
        </div>
    </nav>

    <section class="relative pt-40 pb-32 lg:pt-48 lg:pb-40 overflow-hidden bg-slate-50">
        <div id="map-bg" class="absolute inset-0 z-0 opacity-75 mix-blend-multiply"></div>
        <div
            class="absolute inset-0 bg-gradient-to-b from-slate-50/80 via-slate-50/60 to-slate-50 z-0 pointer-events-none">
        </div>

        <div class="container mx-auto px-6 lg:px-12 relative z-10 flex flex-col lg:flex-row items-center gap-12">
            <div class="max-w-2xl lg:w-2/3 text-center lg:text-left">
                <div
                    class="inline-block px-4 py-1.5 rounded-full bg-brand-softblue/10 border border-brand-softblue/30 text-brand-navy text-sm font-semibold mb-6 backdrop-blur-sm shadow-sm tracking-wide">
                    Sistem Operasional Digital Jasa Raharja Riau
                </div>
                <h1
                    class="text-4xl lg:text-6xl font-black text-brand-navy leading-tight mb-6 drop-shadow-sm font-poppins">
                    Integrated Mobility Operation <br class="hidden lg:block">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-orange to-amber-500">For
                        Safer Transport</span>
                </h1>
                <p class="text-lg text-slate-600 mb-10 leading-relaxed max-w-xl mx-auto lg:mx-0">
                    Platform terpadu untuk monitoring, integrasi data, dan manajemen operasional angkutan darat dan laut
                    secara real-time, interaktif, dan aman.
                </p>

                <div class="flex flex-col sm:flex-row justify-center lg:justify-start gap-4">
                    <a href="#layanan"
                        class="px-8 py-3.5 bg-brand-orange hover:bg-orange-600 text-white font-bold rounded-full shadow-lg shadow-brand-orange/30 transition-all flex items-center justify-center gap-3 w-full sm:w-auto">
                        Akses Portal Layanan
                        <svg class="w-5 h-5 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                    </a>

                    <a href="/pendaftaran-operator"
                        class="px-8 py-3.5 bg-white hover:bg-slate-100 text-brand-navy border border-slate-300 font-bold rounded-full shadow-md transition-all flex items-center justify-center gap-3 w-full sm:w-auto">
                        Pendaftaran Operator
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4v16m8-8H4"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="hidden lg:flex lg:w-1/3 justify-center items-center drop-shadow-2xl z-10">
                <img src="{{ asset('assets/logo/logo.png') }}" alt="Mascot MOVEON"
                    class="w-full max-w-md transform hover:scale-105 transition-transform duration-500 hover:-rotate-2">
            </div>
        </div>
    </section>

    <section class="relative z-20 -mt-10 px-6 lg:px-12">
        <div class="container mx-auto">
            <div
                class="bg-gradient-to-r from-brand-navy to-slate-800 text-white rounded-3xl shadow-xl px-6 py-6 lg:px-8 lg:py-7 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-5">
                <div class="max-w-3xl">
                    <p class="text-brand-orange text-sm font-semibold uppercase tracking-[0.2em] mb-2">Akses Cepat</p>
                    <h2 class="text-2xl lg:text-3xl font-bold font-poppins mb-2">Pendaftaran Operator</h2>
                    <p class="text-slate-200 text-sm lg:text-base leading-relaxed">
                        Daftarkan operator baru ke dalam sistem untuk kebutuhan pengelolaan operasional dan akses portal secara terstruktur.
                    </p>
                </div>
                <div class="w-full lg:w-auto">
                    <a href="/pendaftaran-operator"
                        class="inline-flex w-full lg:w-auto items-center justify-center gap-3 px-7 py-3.5 bg-brand-orange hover:bg-orange-600 text-white font-bold rounded-2xl shadow-lg shadow-brand-orange/30 transition-all">
                        Buka Halaman Pendaftaran Operator
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="layanan" class="relative z-20 py-20 bg-white border-y border-slate-200">
        <div class="container mx-auto px-6 lg:px-12">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-brand-navy mb-4 font-poppins">Pilih Layanan Portal</h2>
                <p class="text-slate-600 max-w-2xl mx-auto">Silakan pilih layanan pendaftaran agen operasional atau
                    portal check-in manifest terpadu.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">

                <div
                    class="bg-slate-50 rounded-2xl p-8 border border-slate-200 hover:shadow-xl hover:border-brand-softblue transition-all duration-300 flex flex-col h-full group relative overflow-hidden">
                    <div
                        class="absolute top-0 right-0 bg-brand-softblue text-white text-[10px] font-bold px-3 py-1 rounded-bl-lg uppercase tracking-wider">
                        Mitra / Agen
                    </div>
                    <div
                        class="w-16 h-16 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-sm group-hover:scale-110 transition-transform">
                        🏢
                    </div>
                    <h3 class="text-xl font-bold text-brand-navy mb-3">Pendaftaran Operator</h3>
                    <p class="text-slate-600 mb-8 flex-grow text-sm leading-relaxed">
                        Portal registrasi mandiri bagi mitra agen pelayaran dan pengelola angkutan untuk mendapatkan
                        akses ke dalam ekosistem pelaporan Jasa Raharja.
                    </p>
                    <a href="/register-operator"
                        class="mt-auto w-full py-3 px-4 bg-brand-softblue text-white font-bold rounded-xl text-center hover:bg-blue-700 shadow-md transition-colors">
                        Daftar Menjadi Operator
                    </a>
                </div>

                <div
                    class="bg-slate-50 rounded-2xl p-8 border border-slate-200 hover:shadow-xl hover:border-brand-orange transition-all duration-300 flex flex-col h-full group relative overflow-hidden">
                    <div
                        class="absolute top-0 right-0 bg-brand-orange text-white text-[10px] font-bold px-3 py-1 rounded-bl-lg uppercase tracking-wider">
                        Penumpang
                    </div>
                    <div
                        class="w-16 h-16 bg-orange-100 text-brand-orange rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-sm group-hover:scale-110 transition-transform">
                        🚢
                    </div>
                    <h3 class="text-xl font-bold text-brand-navy mb-3">Check-In Manifest Terpadu</h3>
                    <p class="text-slate-600 mb-6 flex-grow text-sm leading-relaxed">
                        Portal satu pintu untuk pelaporan data manifest Pelayaran Umum maupun Penyeberangan Roro
                        (mendukung pendaftaran kendaraan).
                    </p>

                    <div class="bg-green-50 border border-green-200 rounded-lg p-3 mb-6 flex gap-3 items-start">
                        <span class="text-green-600 text-lg">📱</span>
                        <p class="text-[11px] text-green-700 font-medium leading-tight">
                            Bukti E-Ticket PDF akan dikirim otomatis ke WhatsApp Anda.
                        </p>
                    </div>

                    <a href="/checkin-manifest"
                        class="mt-auto w-full py-3 px-4 bg-brand-orange text-white font-bold rounded-xl text-center hover:bg-orange-600 shadow-md transition-colors">
                        Mulai Check-In
                    </a>
                </div>

            </div>
        </div>
    </section>

    <section id="about" class="relative z-20 pt-24 pb-12 px-6 lg:px-12 bg-slate-50">
        <div class="container mx-auto max-w-6xl">
            <div class="flex flex-col lg:flex-row items-center gap-12 mb-16">
                <div class="lg:w-1/2">
                    <h2 class="text-sm font-bold text-brand-orange tracking-widest uppercase mb-2">Tentang Sistem</h2>
                    <h3 class="text-3xl font-bold text-brand-navy mb-6 font-poppins">Transformasi Digital Pelayanan
                        Terpadu</h3>
                    <p class="text-slate-600 mb-4 leading-relaxed text-justify">
                        <strong>MOVEON</strong> (Mobility Operation and Voyage Engagement Network) adalah inisiatif
                        strategis dari PT Jasa Raharja Wilayah Riau untuk mendigitalisasi proses pelaporan operasional
                        dan manifest penumpang.
                    </p>
                    <p class="text-slate-600 leading-relaxed text-justify">
                        Sistem ini dirancang untuk memberikan kemudahan, kecepatan, dan keamanan data bagi mitra
                        operator kapal dan kendaraan darat dalam melaporkan data perjalanan yang terintegrasi langsung
                        dengan database pusat Jasa Raharja demi menjamin keselamatan dan hak perlindungan masyarakat.
                    </p>
                </div>
                <div class="lg:w-1/2 flex justify-center">
                    <div class="relative w-full max-w-md">
                        <div class="absolute inset-0 bg-brand-softblue/10 rounded-3xl transform rotate-3"></div>
                        <img src="{{ asset('images/logo.png') }}" alt="MOVEON Concept"
                            class="relative z-10 w-full bg-white p-8 rounded-3xl shadow-lg border border-slate-100">
                    </div>
                </div>
            </div>

            <div class="glass-panel shadow-lg rounded-3xl p-8 lg:p-10 border-t-4 border-t-brand-navy">
                <h3 class="text-xl font-bold text-brand-navy mb-8 text-center font-poppins">Alur Sistem Terintegrasi
                </h3>
                <div class="flex flex-col lg:flex-row justify-between items-center gap-6 relative">
                    <div
                        class="hidden lg:block absolute top-1/2 left-0 w-full h-1 bg-slate-200 -z-10 transform -translate-y-1/2">
                    </div>

                    @php
                        $steps = [
                            ['icon' => '📝', 'title' => 'Input Data', 'desc' => 'Operator & Guest'],
                            ['icon' => '📱', 'title' => 'E-Ticket WA', 'desc' => 'Distribusi Dokumen'],
                            ['icon' => '🛡️', 'title' => 'Validation', 'desc' => 'Verifikasi Petugas'],
                            ['icon' => '📊', 'title' => 'Monitoring', 'desc' => 'Dashboard Real-time'],
                            ['icon' => '📑', 'title' => 'Reporting', 'desc' => 'Rekapitulasi Resmi'],
                        ];
                    @endphp

                    @foreach ($steps as $step)
                        <div
                            class="flex flex-col items-center text-center bg-white lg:bg-transparent p-4 lg:p-0 rounded-xl shadow-sm lg:shadow-none w-full lg:w-auto z-10 hover:transform hover:-translate-y-1 transition-transform">
                            <div
                                class="w-16 h-16 rounded-full bg-white border-4 border-slate-50 shadow-md flex items-center justify-center text-2xl mb-3 text-brand-navy ring-2 ring-slate-200">
                                {{ $step['icon'] }}
                            </div>
                            <h4 class="font-bold text-slate-800">{{ $step['title'] }}</h4>
                            <p class="text-xs text-slate-500 mt-1">{{ $step['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="py-20 bg-white border-t border-slate-200">
        <div class="container mx-auto px-6 lg:px-12">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-brand-navy mb-4 font-poppins">Butuh Bantuan Operasional?</h2>
                <p class="text-slate-600 max-w-2xl mx-auto">Tim operasional dan IT Support Jasa Raharja Wilayah Riau
                    siap
                    membantu kendala Anda terkait pendaftaran sistem atau pelaporan manifest.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <div
                    class="bg-slate-50 p-8 rounded-2xl border border-slate-200 text-center hover:shadow-md transition-shadow">
                    <div
                        class="w-14 h-14 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-brand-navy mb-2">Kantor Wilayah Riau</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Jl. Jend. Sudirman No.285, Simpang Empat, Kec.
                        Pekanbaru Kota, Kota Pekanbaru, Riau 28121</p>
                </div>

                <div
                    class="bg-slate-50 p-8 rounded-2xl border border-slate-200 text-center hover:shadow-md transition-shadow">
                    <div
                        class="w-14 h-14 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-brand-navy mb-2">WhatsApp Center</h3>
                    <p class="text-sm text-slate-600 mb-4">Senin - Jumat (08:00 - 17:00)</p>
                    <a href="https://wa.me/6281234567890" target="_blank"
                        class="text-green-600 font-semibold hover:text-green-700">Chat Sekarang &rarr;</a>
                </div>

                <div
                    class="bg-slate-50 p-8 rounded-2xl border border-slate-200 text-center hover:shadow-md transition-shadow">
                    <div
                        class="w-14 h-14 bg-orange-100 text-brand-orange rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-brand-navy mb-2">Email Support</h3>
                    <p class="text-sm text-slate-600 mb-4">Dukungan teknis 24/7</p>
                    <a href="mailto:support.riau@jasaraharja.co.id"
                        class="text-brand-orange font-semibold hover:text-orange-600">Kirim Email &rarr;</a>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-brand-navy text-slate-400 py-12">
        <div class="container mx-auto px-6 lg:px-12 flex flex-col lg:flex-row justify-between items-center gap-6">
            <div class="text-center lg:text-left">
                <div class="flex items-center justify-center lg:justify-start gap-3 mb-2">
                    <img src="{{ asset('assets/logo/jasaraharja.png') }}" alt="Logo Jasa Raharja"
                        class="h-8 brightness-0 invert opacity-80">
                </div>
                <p class="text-sm mt-2 text-brand-softblue">Mobility Operation and Voyage Engagement Network</p>
            </div>
            <div class="text-sm text-center lg:text-right">
                <p>&copy; {{ date('Y') }} PT Jasa Raharja Riau. All rights reserved.</p>
                <p class="mt-1 text-slate-500 text-xs">Versi 2.0.0</p>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var riauLat = 0.5071;
            var riauLng = 101.4451;
            var map = L.map('map-bg', {
                zoomControl: false,
                attributionControl: false,
                scrollWheelZoom: false
            }).setView([riauLat, riauLng], 7);

            L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
                maxZoom: 19,
                subdomains: 'abcd'
            }).addTo(map);

            L.circleMarker([riauLat, riauLng], {
                color: '#E68940',
                fillColor: '#E68940',
                fillOpacity: 0.8,
                radius: 8
            }).addTo(map);
        });
    </script>
</body>

</html>