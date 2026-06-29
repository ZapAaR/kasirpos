<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Masuk — KasirPOS Pak Mushab</title>

    {{-- Vite (Tailwind + JS) — BUKAN CDN --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Animasi fade-in */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up { animation: fadeInUp .6s ease-out both; }
        .delay-100 { animation-delay: .1s; }
        .delay-200 { animation-delay: .2s; }
        .delay-300 { animation-delay: .3s; }

        /* Background pattern dots */
        .bg-dots {
            background-image: radial-gradient(rgba(22,163,74,.12) 1px, transparent 1px);
            background-size: 22px 22px;
        }

        /* Spinner */
        .spinner {
            width: 18px; height: 18px;
            border: 2px solid rgba(255,255,255,.4);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin .7s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
    </style>
</head>

<body class="h-full bg-[#F0FDF4] text-[#4B5563] antialiased">

    <div class="min-h-screen flex flex-col lg:flex-row">

        {{-- KIRI: Branding panel (desktop only) --}}
        <aside class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-gradient-to-br from-[#16A34A] via-[#22C55E] to-[#86EFAC] text-white">
            <div class="absolute inset-0 bg-dots opacity-40"></div>
            <div class="relative z-10 flex flex-col justify-between p-12 w-full">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-xl bg-white/20 backdrop-blur flex items-center justify-center">
                        {{-- Logo icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="18" height="18" rx="3"/>
                            <path d="M7 8h10M7 12h10M7 16h6"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold text-lg leading-tight">KasirPOS</p>
                        <p class="text-xs text-white/80">Pak Mushab</p>
                    </div>
                </div>

                <div class="animate-fade-in-up">
                    <h1 class="text-4xl font-extrabold leading-tight mb-4">
                        Kelola Toko Lebih <br/>Cepat & Akurat.
                    </h1>
                    <p class="text-white/90 text-lg max-w-md">
                        Sistem kasir modern untuk mencatat transaksi, stok, dan laporan harian dalam satu dashboard yang ringkas.
                    </p>

                    <ul class="mt-8 space-y-3">
                        <li class="flex items-center gap-3">
                            <span class="w-6 h-6 rounded-full bg-white/25 flex items-center justify-center">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12l5 5L20 7"/></svg>
                            </span>
                            Transaksi cepat & offline-ready
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="w-6 h-6 rounded-full bg-white/25 flex items-center justify-center">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12l5 5L20 7"/></svg>
                            </span>
                            Laporan otomatis setiap hari
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="w-6 h-6 rounded-full bg-white/25 flex items-center justify-center">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12l5 5L20 7"/></svg>
                            </span>
                            Manajemen stok real-time
                        </li>
                    </ul>
                </div>

                <p class="text-xs text-white/70">© {{ date('Y') }} KasirPOS Pak Mushab. All rights reserved.</p>
            </div>
        </aside>

        {{-- KANAN: Form Login --}}
        <main class="flex-1 flex items-center justify-center p-4 sm:p-8">
            <div class="w-full max-w-md animate-fade-in-up">

                {{-- Logo Mobile --}}
                <div class="lg:hidden flex items-center justify-center gap-3 mb-8">
                    <div class="w-12 h-12 rounded-xl bg-[#22C55E] text-white flex items-center justify-center shadow-lg shadow-[#22C55E]/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="18" height="18" rx="3"/>
                            <path d="M7 8h10M7 12h10M7 16h6"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold text-[#14532D] text-lg leading-tight">KasirPOS</p>
                        <p class="text-xs text-[#4B5563]">Pak Mushab</p>
                    </div>
                </div>

                {{-- Card --}}
                <section class="bg-white rounded-2xl shadow-xl shadow-[#22C55E]/5 border border-gray-100 p-7 sm:p-9">

                    <header class="mb-7 text-center animate-fade-in-up delay-100">
                        <h2 class="text-2xl font-bold text-[#14532D]">Selamat Datang 👋</h2>
                        <p class="text-sm text-[#4B5563] mt-1">Masuk ke akun KasirPOS Anda</p>
                    </header>

                    {{-- Session Flash Messages --}}
                    @if (session('success'))
                        <div role="status" class="mb-5 flex items-start gap-3 rounded-lg bg-[#F0FDF4] border border-[#86EFAC] text-[#14532D] px-4 py-3 text-sm animate-fade-in-up">
                            <svg class="w-5 h-5 mt-0.5 flex-shrink-0 text-[#16A34A]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12l5 5L20 7"/></svg>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (session('error') || session('status') === 'error')
                        <div role="alert" class="mb-5 flex items-start gap-3 rounded-lg bg-red-50 border border-red-200 text-red-800 px-4 py-3 text-sm animate-fade-in-up">
                            <svg class="w-5 h-5 mt-0.5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><path d="M12 8v4M12 16h.01"/></svg>
                            <span>{{ session('error') ?? 'Terjadi kesalahan. Silakan coba lagi.' }}</span>
                        </div>
                    @endif

                    {{-- Form --}}
                    <form method="POST" action="{{ route('login') }}" id="loginForm" novalidate class="space-y-5 animate-fade-in-up delay-200">
                        @csrf

                        {{-- Email --}}
                        <div>
                            <label for="email" class="block text-sm font-semibold text-[#14532D] mb-1.5">
                                Email
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-[#4B5563]/60 pointer-events-none">
                                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="5" width="18" height="14" rx="2"/>
                                        <path d="M3 7l9 6 9-6"/>
                                    </svg>
                                </span>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    autocomplete="email"
                                    autofocus
                                    placeholder="nama@email.com"
                                    aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}"
                                    class="w-full pl-11 pr-4 py-3 rounded-xl border bg-white text-[#14532D] placeholder:text-gray-400
                                           focus:outline-none focus:ring-2 focus:ring-[#22C55E]/40 focus:border-[#22C55E]
                                           transition-all duration-200
                                           {{ $errors->has('email') ? 'border-red-400 focus:ring-red-200 focus:border-red-400' : 'border-gray-200 hover:border-gray-300' }}"
                                />
                            </div>
                            @error('email')
                                <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1" role="alert">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><path d="M12 8v4M12 16h.01"/></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <label for="password" class="block text-sm font-semibold text-[#14532D]">
                                    Password
                                </label>
                                <a href="{{ route('password.request') }}"
                                   class="text-xs font-semibold text-[#16A34A] hover:text-[#14532D] transition-colors">
                                    Lupa password?
                                </a>
                            </div>

                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-[#4B5563]/60 pointer-events-none">
                                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="4" y="11" width="16" height="10" rx="2"/>
                                        <path d="M8 11V7a4 4 0 018 0v4"/>
                                    </svg>
                                </span>
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    required
                                    autocomplete="current-password"
                                    placeholder="Masukkan password"
                                    aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}"
                                    class="w-full pl-11 pr-12 py-3 rounded-xl border bg-white text-[#14532D] placeholder:text-gray-400
                                           focus:outline-none focus:ring-2 focus:ring-[#22C55E]/40 focus:border-[#22C55E]
                                           transition-all duration-200
                                           {{ $errors->has('password') ? 'border-red-400 focus:ring-red-200 focus:border-red-400' : 'border-gray-200 hover:border-gray-300' }}"
                                />
                                <button
                                    type="button"
                                    id="togglePassword"
                                    aria-label="Tampilkan password"
                                    class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-[#4B5563]/60 hover:text-[#16A34A] transition-colors"
                                >
                                    {{-- Eye open --}}
                                    <svg id="iconEyeOn" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                    {{-- Eye off --}}
                                    <svg id="iconEyeOff" class="w-5 h-5 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M17.94 17.94A10.94 10.94 0 0112 20c-7 0-11-8-11-8a21.77 21.77 0 015.17-6.06M9.9 4.24A10.94 10.94 0 0112 4c7 0 11 8 11 8a21.8 21.8 0 01-3.17 4.19M14.12 14.12A3 3 0 019.88 9.88"/>
                                        <path d="M1 1l22 22"/>
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1" role="alert">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><path d="M12 8v4M12 16h.01"/></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Remember Me --}}
                        <div class="flex items-center">
                            <input
                                type="checkbox"
                                id="remember"
                                name="remember"
                                {{ old('remember') ? 'checked' : '' }}
                                class="w-4 h-4 rounded border-gray-300 text-[#22C55E] focus:ring-[#22C55E] focus:ring-offset-0 cursor-pointer"
                            />
                            <label for="remember" class="ml-2 text-sm text-[#4B5563] cursor-pointer select-none">
                                Ingat saya selama 30 hari
                            </label>
                        </div>

                        {{-- Submit --}}
                        <button
                            type="submit"
                            id="btnSubmit"
                            class="group relative w-full inline-flex items-center justify-center gap-2 py-3 px-4 rounded-xl
                                   bg-gradient-to-r from-[#22C55E] to-[#16A34A]
                                   text-white font-semibold shadow-lg shadow-[#22C55E]/30
                                   hover:shadow-xl hover:shadow-[#22C55E]/40 hover:-translate-y-0.5
                                   focus:outline-none focus:ring-2 focus:ring-[#22C55E]/50 focus:ring-offset-2
                                   active:translate-y-0 active:shadow-md
                                   transition-all duration-200
                                   disabled:opacity-70 disabled:cursor-not-allowed disabled:hover:translate-y-0"
                        >
                            <span id="btnLabel">Masuk</span>
                            <svg id="btnArrow" class="w-4 h-4 transition-transform group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14M13 5l7 7-7 7"/>
                            </svg>
                            <span id="btnSpinner" class="spinner hidden" aria-hidden="true"></span>
                        </button>

                    </form>

                </section>

                <p class="text-center text-xs text-[#4B5563]/70 mt-6">
                    Dengan masuk, Anda menyetujui
                    <a href="#" class="underline hover:text-[#16A34A]">Ketentuan Layanan</a> &
                    <a href="#" class="underline hover:text-[#16A34A]">Kebijakan Privasi</a>.
                </p>

            </div>
        </main>
    </div>

    {{-- Inline Script (bisa dipindah ke resources/js/app.js bila mau) --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            /* ===== Toggle Password ===== */
            const toggleBtn  = document.getElementById('togglePassword');
            const password   = document.getElementById('password');
            const eyeOn      = document.getElementById('iconEyeOn');
            const eyeOff     = document.getElementById('iconEyeOff');

            if (toggleBtn && password) {
                toggleBtn.addEventListener('click', () => {
                    const isHidden = password.type === 'password';
                    password.type  = isHidden ? 'text' : 'password';
                    eyeOn.classList.toggle('hidden', isHidden);
                    eyeOff.classList.toggle('hidden', !isHidden);
                    toggleBtn.setAttribute('aria-label', isHidden ? 'Sembunyikan password' : 'Tampilkan password');
                });
            }

            /* ===== Loading State saat Submit ===== */
            const form    = document.getElementById('loginForm');
            const btn     = document.getElementById('btnSubmit');
            const label   = document.getElementById('btnLabel');
            const arrow   = document.getElementById('btnArrow');
            const spinner = document.getElementById('btnSpinner');

            if (form && btn) {
                form.addEventListener('submit', (e) => {
                    // Validasi client-side cepat
                    if (!form.checkValidity()) {
                        e.preventDefault();
                        form.reportValidity();
                        return;
                    }

                    btn.disabled = true;
                    if (label)   label.textContent   = 'Memproses...';
                    if (arrow)   arrow.classList.add('hidden');
                    if (spinner) spinner.classList.remove('hidden');
                });
            }

            /* ===== Auto-hide flash message setelah 6 detik ===== */
            document.querySelectorAll('[role="status"], [role="alert"]').forEach(el => {
                if (el.closest('form')) return; // skip validasi error
                setTimeout(() => {
                    el.style.transition = 'opacity .4s ease, transform .4s ease';
                    el.style.opacity    = '0';
                    el.style.transform  = 'translateY(-8px)';
                    setTimeout(() => el.remove(), 400);
                }, 6000);
            });
        });
    </script>
</body>
</html>
