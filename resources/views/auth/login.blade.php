<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MOVEON Jasa Raharja</title>
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

        .font-poppins {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-white text-slate-800 antialiased flex min-h-screen">

    <div
        class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-blue-50 via-slate-100 to-brand-softblue/20 relative items-center justify-center overflow-hidden border-r border-slate-200/60">

        <div class="absolute -top-24 -left-24 w-96 h-96 bg-brand-softblue/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-brand-orange/10 rounded-full blur-3xl"></div>

        <div class="relative z-10 flex flex-col items-center text-center px-12">
            <div class="bg-white/60 backdrop-blur-md p-8 rounded-3xl border border-white mb-8 shadow-xl">
                <img src="{{ asset('images/logo.png') }}" alt="MOVEON Mascot"
                    class="h-48 object-contain transform hover:scale-105 transition-transform duration-500 hover:-rotate-2">
            </div>
            <h1 class="text-4xl font-black text-brand-navy font-poppins mb-4 tracking-wide">
                MOVE<span class="text-brand-orange">ON</span>
            </h1>
            <p class="text-slate-600 text-lg font-medium max-w-md leading-relaxed">
                Mobility Operation and Voyage Engagement Network
            </p>
        </div>
    </div>

    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12 lg:p-24 bg-white relative">
        <a href="/"
            class="absolute top-8 left-8 sm:top-12 sm:left-12 flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-brand-navy transition-colors bg-white/80 backdrop-blur-sm border border-slate-200 px-4 py-2 rounded-full shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                </path>
            </svg>
            Kembali
        </a>

        <div class="w-full max-w-md mt-12 lg:mt-0">
            <div class="flex lg:hidden items-center justify-center gap-3 mb-10">
                <img src="{{ asset('images/jasaraharja.png') }}" alt="Jasa Raharja" class="h-8 object-contain">
                <div class="h-6 w-px bg-slate-300"></div>
                <img src="{{ asset('images/logo.png') }}" alt="MOVEON" class="h-10 object-contain">
            </div>

            <div class="mb-10 text-center lg:text-left">
                <h2 class="text-3xl font-bold text-brand-navy font-poppins mb-2">Selamat Datang</h2>
                <p class="text-slate-500 text-sm">Silakan masukkan kredensial Anda untuk masuk ke Dashboard.</p>
            </div>

            <form action="#" method="POST" class="space-y-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Email / Username</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <input type="email" name="email" placeholder="admin@jasaraharja.co.id" required
                            class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-brand-softblue outline-none transition-all bg-slate-50 lg:bg-white">
                    </div>
                </div>

                <div x-data="{ showPassword: false }">
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-sm font-semibold text-slate-700">Password</label>
                        <a href="/forgot-password"
                            class="text-xs font-semibold text-brand-softblue hover:text-brand-navy transition-colors">Lupa
                            Password?</a>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input :type="showPassword ? 'text' : 'password'" name="password" placeholder="••••••••"
                            required
                            class="w-full pl-11 pr-12 py-3.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-brand-softblue outline-none transition-all bg-slate-50 lg:bg-white font-mono">
                        <button type="button" @click="showPassword = !showPassword"
                            class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-brand-navy focus:outline-none">
                            <svg x-show="!showPassword" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                            <svg x-show="showPassword" x-cloak class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.543 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <button type="submit"
                    class="w-full flex justify-center items-center gap-2 py-4 px-4 rounded-xl shadow-lg shadow-brand-navy/20 text-sm font-bold text-white bg-brand-navy hover:bg-blue-900 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                        </path>
                    </svg>
                    Masuk Dashboard
                </button>
            </form>
        </div>
    </div>
</body>

</html>
