<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - MOVEON Jasa Raharja</title>
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
    </style>
</head>

<body class="bg-white text-slate-800 antialiased flex min-h-screen">

    <div
        class="hidden lg:flex lg:w-1/2 bg-slate-50 relative items-center justify-center overflow-hidden border-r border-slate-100">

        <div class="absolute -top-24 -left-24 w-96 h-96 bg-brand-softblue/5 rounded-full blur-3xl opacity-50"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-brand-orange/5 rounded-full blur-3xl opacity-50"></div>

        <div class="relative z-10 flex flex-col items-center text-center px-12 py-24">
            <div class="flex flex-col items-center gap-6">
                <img src="{{ asset('images/logo.png') }}" alt="MOVEON Mascot" class="h-48 object-contain">
                <div class="flex flex-col items-center gap-2">
                    <h1 class="text-4xl font-black text-brand-navy font-poppins tracking-wide">
                        MOVE<span class="text-brand-orange">ON</span>
                    </h1>
                    <p class="text-slate-600 text-lg font-medium max-w-md leading-relaxed">
                        Mobility Operation and Voyage Engagement Network
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12 lg:p-24 bg-white relative">

        <a href="/login"
            class="absolute top-8 left-8 sm:top-12 sm:left-12 flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-brand-navy transition-colors bg-white/80 backdrop-blur-sm border border-slate-200 px-4 py-2 rounded-full shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                </path>
            </svg>
            Kembali ke Login
        </a>

        <div class="w-full max-w-md mt-12 lg:mt-0 flex flex-col justify-center gap-10">
            <div class="flex lg:hidden items-center justify-center gap-3 mb-10">
                <img src="{{ asset('images/jasaraharja.png') }}" alt="Jasa Raharja" class="h-8 object-contain">
                <div class="h-6 w-px bg-slate-300"></div>
                <img src="{{ asset('images/logo.png') }}" alt="MOVEON" class="h-10 object-contain">
            </div>

            <div class="text-center lg:text-left">
                <div class="flex items-center gap-4 mb-6">
                    <div
                        class="w-16 h-16 bg-brand-softblue/10 text-brand-softblue rounded-2xl flex items-center justify-center shadow-sm">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z">
                            </path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-brand-navy font-poppins">Reset Kredensial</h2>
                </div>
                <p class="text-slate-500 text-sm leading-relaxed">
                    Masukkan alamat email yang terdaftar pada sistem. Kami akan mengirimkan instruksi beserta tautan
                    aman untuk mengatur ulang kata sandi Anda.
                </p>
            </div>

            <form action="#" method="POST" class="space-y-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Alamat Email Terdaftar</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <input type="email" name="email" placeholder="admin@jasaraharja.co.id" required autofocus
                            class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-brand-softblue outline-none transition-all text-slate-700 bg-slate-50 focus:bg-white">
                    </div>
                </div>

                <button type="submit"
                    class="w-full flex justify-center items-center gap-2 py-4 px-4 rounded-xl shadow-lg shadow-brand-navy/20 text-sm font-bold text-white bg-brand-navy hover:bg-blue-900 transition-all">
                    Kirim Tautan Reset
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                        </path>
                    </svg>
                </button>
            </form>

            <div
                class="mt-8 pt-8 border-t border-slate-100 text-center lg:text-left text-xs text-slate-400 leading-relaxed">
                <p>Menghadapi kendala? Silakan hubungi <a href="#"
                        class="text-brand-softblue hover:underline font-semibold">Tim IT Support Jasa Raharja Riau</a>.
                </p>
                <p>&copy; {{ date('Y') }} PT Jasa Raharja Riau. Versi 2.0.0 | Sistem Terenkripsi</p>
            </div>
        </div>
    </div>
</body>

</html>
