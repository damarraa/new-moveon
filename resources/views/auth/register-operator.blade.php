<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Operator - MOVEON Jasa Raharja</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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

        /* Custom Scrollbar for textarea */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }
    </style>
</head>

<body class="bg-white text-slate-800 antialiased flex min-h-screen">

    <div
        class="hidden lg:flex lg:w-5/12 bg-slate-50 relative items-center justify-center overflow-hidden border-r border-slate-100 sticky top-0 h-screen">

        <div class="absolute -top-24 -left-24 w-96 h-96 bg-brand-softblue/5 rounded-full blur-3xl opacity-50"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-brand-orange/5 rounded-full blur-3xl opacity-50"></div>

        <div class="relative z-10 flex flex-col items-center text-center px-12 py-24">
            <div class="flex flex-col items-center gap-6">
                <img src="{{ asset('images/logo.png') }}" alt="MOVEON Mascot" class="h-48 object-contain">
                <div class="flex flex-col items-center gap-2">
                    <h1 class="text-4xl font-black text-brand-navy font-poppins tracking-wide">
                        MOVE<span class="text-brand-orange">ON</span>
                    </h1>
                    <p class="text-slate-600 text-lg font-medium max-w-sm leading-relaxed">
                        Portal Registrasi Mitra & Agen Operasional
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full lg:w-7/12 flex items-start justify-center p-8 sm:p-12 lg:p-16 bg-white relative overflow-y-auto">

        <a href="/"
            class="absolute top-6 left-6 sm:top-8 sm:left-8 flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-brand-navy transition-colors bg-white/80 backdrop-blur-sm border border-slate-200 px-4 py-2 rounded-full shadow-sm z-10">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                </path>
            </svg>
            Kembali
        </a>

        <div class="w-full max-w-xl mt-16 lg:mt-0">

            <div class="flex lg:hidden items-center justify-center gap-3 mb-8">
                <img src="{{ asset('images/jasaraharja.png') }}" alt="Jasa Raharja" class="h-8 object-contain">
                <div class="h-6 w-px bg-slate-300"></div>
                <img src="{{ asset('images/logo.png') }}" alt="MOVEON" class="h-10 object-contain">
            </div>

            <div class="mb-8 text-center lg:text-left">
                <h2 class="text-3xl font-bold text-brand-navy font-poppins mb-2">Daftar Operator Baru</h2>
                <p class="text-slate-500 text-sm">Lengkapi data di bawah ini untuk mendapatkan akses pelaporan
                    operasional terpadu Jasa Raharja.</p>
            </div>

            <form action="#" method="POST" class="space-y-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Nama Perusahaan / Perorangan
                            <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_perusahaan"
                            placeholder="Contoh: PT. Bintang Laut atau John Doe" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-brand-softblue outline-none transition-all text-slate-700 bg-slate-50 focus:bg-white">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Nama Pemilik / Pengelola <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="nama_pengelola" placeholder="Sesuai KTP" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-brand-softblue outline-none transition-all text-slate-700 bg-slate-50 focus:bg-white">
                    </div>

                    <div class="md:col-span-2" x-data="{ status: 'Pemilik' }">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Status Pendaftar <span
                                class="text-red-500">*</span></label>
                        <div class="flex gap-4">
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="status" value="Pemilik" x-model="status"
                                    class="peer sr-only">
                                <div class="w-full text-center py-3 px-4 rounded-xl border-2 transition-all"
                                    :class="status === 'Pemilik' ?
                                        'border-brand-navy bg-brand-softblue/10 text-brand-navy font-bold' :
                                        'border-slate-200 bg-slate-50 text-slate-500 hover:border-slate-300'">
                                    Pemilik
                                </div>
                            </label>
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="status" value="Pengelola" x-model="status"
                                    class="peer sr-only">
                                <div class="w-full text-center py-3 px-4 rounded-xl border-2 transition-all"
                                    :class="status === 'Pengelola' ?
                                        'border-brand-navy bg-brand-softblue/10 text-brand-navy font-bold' :
                                        'border-slate-200 bg-slate-50 text-slate-500 hover:border-slate-300'">
                                    Pengelola / Agen
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Alamat Kantor / Operasional <span
                                class="text-red-500">*</span></label>
                        <textarea name="alamat" rows="3" placeholder="Tulis alamat lengkap..." required
                            class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-brand-softblue outline-none transition-all text-slate-700 bg-slate-50 focus:bg-white resize-none"></textarea>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Nomor Telepon / WhatsApp <span
                                class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                    </path>
                                </svg>
                            </div>
                            <input type="tel" name="telepon" placeholder="Contoh: 081234567890" required
                                class="w-full pl-11 pr-4 py-3 rounded-xl border border-brand-softblue/50 focus:ring-2 focus:ring-brand-softblue outline-none transition-all text-slate-700 bg-brand-softblue/5 focus:bg-white">
                        </div>
                        <p class="text-[11px] text-brand-softblue mt-1.5 flex items-center gap-1 font-medium">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Nomor ini akan digunakan sebagai User ID (Username) untuk Login sistem.
                        </p>
                    </div>

                    <div class="md:col-span-2" x-data="{ showPassword: false }">
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Password <span
                                class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                    </path>
                                </svg>
                            </div>
                            <input :type="showPassword ? 'text' : 'password'" name="password"
                                placeholder="Buat password yang aman" required
                                class="w-full pl-11 pr-12 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-brand-softblue outline-none transition-all text-slate-700 bg-slate-50 focus:bg-white font-mono">
                            <button type="button" @click="showPassword = !showPassword"
                                class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-brand-navy focus:outline-none">
                                <svg x-show="!showPassword" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21">
                                    </path>
                                </svg>
                                <svg x-show="showPassword" x-cloak class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.543 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="w-full flex justify-center items-center gap-2 py-4 px-4 rounded-xl shadow-lg shadow-brand-navy/20 text-sm font-bold text-white bg-brand-navy hover:bg-blue-900 transition-all">
                        Kirim Permintaan Registrasi
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </button>
                </div>

                <div class="text-center mt-6">
                    <p class="text-sm text-slate-500">
                        Sudah punya akun / terdaftar?
                        <a href="/login"
                            class="font-bold text-brand-orange hover:text-orange-600 transition-colors">Login di
                            sini</a>
                    </p>
                </div>
            </form>

        </div>
    </div>
</body>

</html>
