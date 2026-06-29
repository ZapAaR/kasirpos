<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO Meta Tags -->
    <title>KasirPOS Pak Mushab - Aneka Kue Basah dan Gorengan</title>
    <meta name="description"
        content="KasirPOS Pak Mushab adalah aplikasi kasir (Point of Sale) modern berbasis cloud. Kelola produk, stok, transaksi, dan laporan dengan mudah. Cocok untuk UMKM dan Retail.">
    <meta name="keywords" content="kasir pos, aplikasi kasir, point of sale, manajemen stok, kasir umkm, pak mushab pos">
    <meta name="author" content="KasirPOS Pak Mushab">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="KasirPOS Pak Mushab - Solusi Kasir Modern">
    <meta property="og:description"
        content="Aplikasi kasir modern untuk mengelola transaksi, stok, dan laporan toko Anda secara real-time.">
    <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">

    <!-- Vite Assets (No CDN) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Custom Animations & Utilities */
        html {
            scroll-behavior: smooth;
        }

        .fade-up {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .fade-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        .animate-float {
            animation: float 4s ease-in-out infinite;
        }

        @keyframes pulse-ring {
            0% {
                transform: scale(0.8);
                opacity: 1;
            }

            100% {
                transform: scale(1.5);
                opacity: 0;
            }
        }

        .pulse-ring::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 50%;
            background: rgba(34, 197, 94, 0.4);
            animation: pulse-ring 2s cubic-bezier(0.215, 0.61, 0.355, 1) infinite;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #F0FDF4;
        }

        ::-webkit-scrollbar-thumb {
            background: #86EFAC;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #22C55E;
        }
    </style>
</head>

<body class="bg-white text-[#4B5563] antialiased font-sans">

    <!-- ==================== NAVBAR ==================== -->
    <header id="navbar"
        class="fixed top-0 left-0 right-0 z-50 bg-white/90 backdrop-blur-md transition-shadow duration-300">
        <nav class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 lg:h-20">
                <!-- Logo -->
                <a href="#" class="flex items-center gap-2 group">
                    <div
                        class="w-9 h-9 bg-[#22C55E] rounded-lg flex items-center justify-center group-hover:bg-[#16A34A] transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 10.5L4.5 4.5h15L21 10.5M4.5 10.5V18a2 2 0 002 2h11a2 2 0 002-2v-7.5M4.5 10.5h15M9 20v-5h6v5" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-[#14532D]">KasirPOS <span class="text-[#22C55E]">Pak
                            Mushab</span></span>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden lg:flex items-center gap-8">
                    <a href="#fitur"
                        class="text-[#4B5563] hover:text-[#22C55E] font-medium transition-colors">Fitur</a>
                    <a href="#keunggulan"
                        class="text-[#4B5563] hover:text-[#22C55E] font-medium transition-colors">Keunggulan</a>
                    <a href="#cara-kerja" class="text-[#4B5563] hover:text-[#22C55E] font-medium transition-colors">Cara
                        Kerja</a>
                    <a href="#tentang"
                        class="text-[#4B5563] hover:text-[#22C55E] font-medium transition-colors">Tentang</a>
                    <a href="#kontak"
                        class="text-[#4B5563] hover:text-[#22C55E] font-medium transition-colors">Kontak</a>
                </div>

                <!-- Desktop Auth Buttons -->
                <div class="hidden lg:flex items-center gap-3">
                    @guest
                        <a href="{{ route('login') }}"
                            class="px-5 py-2.5 bg-[#22C55E] text-white font-semibold rounded-lg hover:bg-[#16A34A] shadow-lg shadow-green-500/20 hover:shadow-green-500/40 transition-all">Masuk</a>
                    @endguest

                    @auth
                        <a href="{{ route('login') }}"
                            class="px-5 py-2.5 bg-[#22C55E] text-white font-semibold rounded-lg hover:bg-[#16A34A] shadow-lg shadow-green-500/20 hover:shadow-green-500/40 transition-all">Dashboard
                            {{ auth()->user()->name }}</a>
                    @endauth
                </div>

                <!-- Mobile Hamburger -->
                <button id="hamburger-btn"
                    class="lg:hidden p-2 text-[#14532D] focus:outline-none focus:ring-2 focus:ring-[#22C55E] rounded-lg"
                    aria-label="Toggle menu" aria-expanded="false">
                    <svg id="icon-open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg id="icon-close" class="w-6 h-6 hidden" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden lg:hidden pb-6 border-t border-gray-100 mt-2 pt-4">
                <div class="flex flex-col gap-4">
                    <a href="#fitur" class="text-[#4B5563] hover:text-[#22C55E] font-medium px-2 py-1">Fitur</a>
                    <a href="#keunggulan"
                        class="text-[#4B5563] hover:text-[#22C55E] font-medium px-2 py-1">Keunggulan</a>
                    <a href="#cara-kerja" class="text-[#4B5563] hover:text-[#22C55E] font-medium px-2 py-1">Cara
                        Kerja</a>
                    <a href="#tentang" class="text-[#4B5563] hover:text-[#22C55E] font-medium px-2 py-1">Tentang</a>
                    <a href="#kontak" class="text-[#4B5563] hover:text-[#22C55E] font-medium px-2 py-1">Kontak</a>
                    <hr class="border-gray-100">
                    @guest
                        <a href="{{ route('login') }}"
                            class="text-center px-5 py-2.5 bg-[#22C55E] text-white font-semibold rounded-lg hover:bg-[#16A34A]">Masuk
                        </a>
                    @endguest

                    @auth
                        <a href="{{ route('dashboard') }}"
                            class="text-center px-5 py-2.5 bg-[#22C55E] text-white font-semibold rounded-lg hover:bg-[#16A34A]">Dashboard
                            {{ auth()->user()->name }}
                        </a>
                    @endauth
                </div>
            </div>
        </nav>
    </header>

    <main class="pt-16 lg:pt-20">
        <!-- ==================== HERO SECTION ==================== -->
        <section class="relative bg-[#F0FDF4] overflow-hidden">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <!-- Left Content -->
                    <div class="fade-up">
                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-[#14532D] leading-tight mb-6">
                            Kelola UMKM Pedagang Kaki Lima Lebih Mudah dengan <span
                                class="text-[#22C55E]">KasirPOS</span>
                        </h1>
                        <p class="text-lg text-[#4B5563] mb-8 max-w-lg leading-relaxed">
                            KasirPOS Pak Mushab membantu UMKM mengelola penjualan, stok barang, dan laporan usaha dengan
                            mudah, cepat, dan terorganisir dalam satu sistem kasir modern.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4">
                            @guest
                                <a href="{{ route('login') }}"
                                    class="inline-flex items-center justify-center px-8 py-4 bg-[#22C55E] text-white font-bold rounded-xl hover:bg-[#16A34A] shadow-xl shadow-green-500/20 hover:shadow-green-500/40 transition-all transform hover:-translate-y-1">
                                    Masuk
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </a>
                            @endguest

                            @auth
                                <a href="{{ route('dashboard') }}"
                                    class="inline-flex items-center justify-center px-8 py-4 bg-[#22C55E] text-white font-bold rounded-xl hover:bg-[#16A34A] shadow-xl shadow-green-500/20 hover:shadow-green-500/40 transition-all transform hover:-translate-y-1">
                                    Dashboard {{ auth()->user()->name }}
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </a>
                            @endauth
                            <a href="#cara-kerja"
                                class="inline-flex items-center justify-center px-8 py-4 bg-white text-[#14532D] font-bold rounded-xl border border-[#86EFAC] hover:border-[#22C55E] hover:bg-[#F0FDF4] transition-all">
                                <svg class="w-5 h-5 mr-2 text-[#22C55E]" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Lihat Demo
                            </a>
                        </div>
                    </div>

                    <!-- Right Image & Floating Card -->
                    <div class="relative fade-up">
                        <div
                            class="relative z-10 rounded-2xl overflow-hidden shadow-2xl shadow-green-900/10 border border-[#86EFAC]">
                            <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?auto=format&fit=crop&w=800&q=80"
                                alt="Dashboard KasirPOS Pak Mushab" class="w-full h-auto object-cover">
                        </div>

                        <!-- Background Decoration -->
                        <div
                            class="absolute -z-10 top-10 right-10 w-72 h-72 bg-[#86EFAC] rounded-full mix-blend-multiply filter blur-3xl opacity-30">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ==================== FEATURES ==================== -->
        <section id="fitur" class="py-20 lg:py-28 bg-white">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-2xl mx-auto mb-16 fade-up">
                    <span class="text-[#22C55E] font-bold tracking-wider uppercase text-sm">Fitur Unggulan</span>
                    <h2 class="text-3xl lg:text-4xl font-extrabold text-[#14532D] mt-3 mb-4">Semua yang Anda Butuhkan
                        dalam Satu Aplikasi</h2>
                    <p class="text-[#4B5563] text-lg">Dirancang khusus untuk mempermudah operasional bisnis Anda dari
                        hulu ke hilir.</p>
                </div>

                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div
                        class="fade-up group p-8 bg-[#F0FDF4] rounded-2xl border border-transparent hover:border-[#86EFAC] hover:shadow-xl hover:shadow-green-500/5 transition-all duration-300">
                        <div
                            class="w-14 h-14 bg-white rounded-xl flex items-center justify-center shadow-sm group-hover:bg-[#22C55E] transition-colors mb-6">
                            <svg class="w-7 h-7 text-[#22C55E] group-hover:text-white transition-colors"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-[#14532D] mb-3">Manajemen Produk</h3>
                        <p class="text-[#4B5563] leading-relaxed">Kelola produk dengan mudah. Lengkap dengan kategori,
                            stok, dan foto produk.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div
                        class="fade-up group p-8 bg-[#F0FDF4] rounded-2xl border border-transparent hover:border-[#86EFAC] hover:shadow-xl hover:shadow-green-500/5 transition-all duration-300">
                        <div
                            class="w-14 h-14 bg-white rounded-xl flex items-center justify-center shadow-sm group-hover:bg-[#22C55E] transition-colors mb-6">
                            <svg class="w-7 h-7 text-[#22C55E] group-hover:text-white transition-colors"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-[#14532D] mb-3">Kategori Fleksibel</h3>
                        <p class="text-[#4B5563] leading-relaxed">Kelompokkan produk ke dalam kategori
                            agar pencarian lebih cepat.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div
                        class="fade-up group p-8 bg-[#F0FDF4] rounded-2xl border border-transparent hover:border-[#86EFAC] hover:shadow-xl hover:shadow-green-500/5 transition-all duration-300">
                        <div
                            class="w-14 h-14 bg-white rounded-xl flex items-center justify-center shadow-sm group-hover:bg-[#22C55E] transition-colors mb-6">
                            <svg class="w-7 h-7 text-[#22C55E] group-hover:text-white transition-colors"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-[#14532D] mb-3">Kontrol Stok Real-time</h3>
                        <p class="text-[#4B5563] leading-relaxed">Pantau stok secara real-time. Dapatkan notifikasi
                            otomatis jika stok menipis.</p>
                    </div>

                    <!-- Feature 4 -->
                    <div
                        class="fade-up group p-8 bg-[#F0FDF4] rounded-2xl border border-transparent hover:border-[#86EFAC] hover:shadow-xl hover:shadow-green-500/5 transition-all duration-300">
                        <div
                            class="w-14 h-14 bg-white rounded-xl flex items-center justify-center shadow-sm group-hover:bg-[#22C55E] transition-colors mb-6">
                            <svg class="w-7 h-7 text-[#22C55E] group-hover:text-white transition-colors"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-[#14532D] mb-3">Transaksi Cepat</h3>
                        <p class="text-[#4B5563] leading-relaxed">Antarmuka kasir yang intuitif. Support berbagai
                            metode pembayaran dan cetak struk.</p>
                    </div>

                    <!-- Feature 5 -->
                    <div
                        class="fade-up group p-8 bg-[#F0FDF4] rounded-2xl border border-transparent hover:border-[#86EFAC] hover:shadow-xl hover:shadow-green-500/5 transition-all duration-300">
                        <div
                            class="w-14 h-14 bg-white rounded-xl flex items-center justify-center shadow-sm group-hover:bg-[#22C55E] transition-colors mb-6">
                            <svg class="w-7 h-7 text-[#22C55E] group-hover:text-white transition-colors"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-[#14532D] mb-3">Role & Permission</h3>
                        <p class="text-[#4B5563] leading-relaxed">Atur hak akses Admin. Batasi fitur yang bisa
                            diakses oleh kasir.</p>
                    </div>

                    <!-- Feature 6 -->
                    <div
                        class="fade-up group p-8 bg-[#F0FDF4] rounded-2xl border border-transparent hover:border-[#86EFAC] hover:shadow-xl hover:shadow-green-500/5 transition-all duration-300">
                        <div
                            class="w-14 h-14 bg-white rounded-xl flex items-center justify-center shadow-sm group-hover:bg-[#22C55E] transition-colors mb-6">
                            <svg class="w-7 h-7 text-[#22C55E] group-hover:text-white transition-colors"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-[#14532D] mb-3">Laporan Lengkap</h3>
                        <p class="text-[#4B5563] leading-relaxed">Laporan penjualan, laba rugi, dan stok yang bisa
                            diekspor ke Excel/PDF kapan saja.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ==================== CARA KERJA ==================== -->
        <section id="cara-kerja" class="py-20 lg:py-28 bg-white">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-2xl mx-auto mb-16 fade-up">
                    <span class="text-[#22C55E] font-bold tracking-wider uppercase text-sm">Cara Kerja</span>
                    <h2 class="text-3xl lg:text-4xl font-extrabold text-[#14532D] mt-3 mb-4">Mulai Dalam 3 Langkah
                        Mudah</h2>
                    <p class="text-[#4B5563] text-lg">Tidak perlu keahlian teknis. Setup toko Anda dalam hitungan
                        menit.</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8 relative">
                    <!-- Connecting Line (Desktop) -->
                    <div class="hidden md:block absolute top-16 left-1/4 right-1/4 h-0.5 bg-[#86EFAC]"></div>

                    <!-- Step 1 -->
                    <div class="fade-up text-center relative z-10">
                        <div
                            class="w-16 h-16 bg-[#22C55E] text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-6 shadow-lg shadow-green-500/30">
                            1</div>
                        <h3 class="text-xl font-bold text-[#14532D] mb-3">Masuk Akun</h3>
                        <p class="text-[#4B5563]">Masuk ke akun Anda untuk mengelola produk, stok, transaksi, dan
                            laporan usaha dengan mudah.</p>
                    </div>

                    <!-- Step 2 -->
                    <div class="fade-up text-center relative z-10">
                        <div
                            class="w-16 h-16 bg-[#22C55E] text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-6 shadow-lg shadow-green-500/30">
                            2</div>
                        <h3 class="text-xl font-bold text-[#14532D] mb-3">Setup Produk & Toko</h3>
                        <p class="text-[#4B5563]">Masukkan daftar produk, atur kategori, harga, dan stok awal. Bisa
                            import via Excel.</p>
                    </div>

                    <!-- Step 3 -->
                    <div class="fade-up text-center relative z-10">
                        <div
                            class="w-16 h-16 bg-[#22C55E] text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-6 shadow-lg shadow-green-500/30">
                            3</div>
                        <h3 class="text-xl font-bold text-[#14532D] mb-3">Mulai Berjualan</h3>
                        <p class="text-[#4B5563]">Transaksi menjadi super cepat. Pantau laporan bisnis Anda secara
                            real-time.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ==================== TENTANG ==================== -->
        <section id="tentang" class="py-20 lg:py-28 bg-[#F0FDF4]">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-16 items-center">
                    <div class="fade-up">
                        <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=800&q=80"
                            alt="Tim KasirPOS Pak Mushab" class="rounded-2xl shadow-xl border border-[#86EFAC]">
                    </div>
                    <div class="fade-up">
                        <span class="text-[#22C55E] font-bold tracking-wider uppercase text-sm">Tentang Kami</span>
                        <h2 class="text-3xl lg:text-4xl font-extrabold text-[#14532D] mt-3 mb-6">Dibangun untuk
                            Membantu UMKM Berkembang</h2>
                        <p class="text-[#4B5563] text-lg mb-6 leading-relaxed">
                            KasirPOS Pak Mushab hadir sebagai solusi untuk membantu pelaku UMKM mengelola penjualan,
                            stok barang, dan transaksi dengan lebih mudah dan terorganisir.
                            Kami memahami bahwa pencatatan manual sering kali memakan waktu dan berpotensi menimbulkan
                            kesalahan.
                        </p>
                        <p class="text-[#4B5563] text-lg mb-8 leading-relaxed">
                            Karena itu, KasirPOS Pak Mushab dirancang dengan tampilan yang sederhana, mudah digunakan,
                            dan fokus pada kebutuhan bisnis sehari-hari.
                            Dengan fitur manajemen produk, stok, transaksi, dan laporan, kami berkomitmen membantu usaha
                            Anda berjalan lebih efisien.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ==================== KONTAK & MAPS ==================== -->
        <section id="kontak" class="py-20 lg:py-28 bg-white">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-2xl mx-auto mb-16 fade-up">
                    <span class="text-[#22C55E] font-bold tracking-wider uppercase text-sm">Hubungi Kami</span>
                    <h2 class="text-3xl lg:text-4xl font-extrabold text-[#14532D] mt-3 mb-4">Kunjungi UMKM Pedagang
                        Kaki Lima Kami</h2>
                    <p class="text-[#4B5563] text-lg">Kami selalu siap membantu Anda. Jangan ragu untuk mampir atau
                        menghubungi kami.</p>
                </div>

                <div class="grid lg:grid-cols-3 gap-8">
                    <!-- Contact Info -->
                    <div class="fade-up space-y-6">
                        <div class="flex items-start gap-4 p-6 bg-[#F0FDF4] rounded-xl border border-[#86EFAC]">
                            <div
                                class="w-12 h-12 bg-[#22C55E] rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-[#14532D] mb-1">Alamat</h4>
                                <p class="text-[#4B5563] text-sm">Perum Griya Asri Blok I2 No 5, Purwakarta,
                                    Indonesia 41118</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4 p-6 bg-[#F0FDF4] rounded-xl border border-[#86EFAC]">
                            <div
                                class="w-12 h-12 bg-[#22C55E] rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-[#14532D] mb-1">Telepon / WA</h4>
                                <p class="text-[#4B5563] text-sm">+62 812-3456-7890</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4 p-6 bg-[#F0FDF4] rounded-xl border border-[#86EFAC]">
                            <div
                                class="w-12 h-12 bg-[#22C55E] rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-[#14532D] mb-1">Email</h4>
                                <p class="text-[#4B5563] text-sm">support@kasirpospakmushab.id</p>
                            </div>
                        </div>
                    </div>

                    <!-- Google Maps -->
                    <div
                        class="fade-up lg:col-span-2 rounded-2xl overflow-hidden shadow-lg border border-[#86EFAC] h-[400px] lg:h-auto">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d247.75049465926!2d107.4579767941601!3d-6.520680001878187!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zNsKwMzEnMTQuOCJTIDEwN8KwMjcnMjguMSJF!5e0!3m2!1sid!2sid!4v1782387531826!5m2!1sid!2sid"
                            width="100%" height="100%" style="border:0; min-height: 400px;" allowfullscreen=""
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                            title="Lokasi Kantor KasirPOS Pak Mushab">
                        </iframe>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- ==================== FOOTER ==================== -->
    <footer class="bg-[#14532D] text-green-100 pt-16 pb-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                <!-- Brand -->
                <div class="lg:col-span-1">
                    <a href="#" class="flex items-center gap-2 mb-4">
                        <div class="w-9 h-9 bg-[#22C55E] rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 10.5L4.5 4.5h15L21 10.5M4.5 10.5V18a2 2 0 002 2h11a2 2 0 002-2v-7.5M4.5 10.5h15M9 20v-5h6v5" />
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-white">KasirPOS Pak Mushab</span>
                    </a>
                    <p class="text-green-200/80 text-sm leading-relaxed mb-6">Solusi kasir modern dan terpercaya untuk
                        membantu bisnis Anda tumbuh lebih cepat dan terorganisir.</p>
                    <div class="flex gap-4">
                        <a href="#" aria-label="Facebook"
                            class="w-9 h-9 bg-green-900/50 hover:bg-[#22C55E] rounded-lg flex items-center justify-center transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z" />
                            </svg>
                        </a>
                        <a href="#" aria-label="Instagram"
                            class="w-9 h-9 bg-green-900/50 hover:bg-[#22C55E] rounded-lg flex items-center justify-center transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </a>
                        <a href="#" aria-label="Twitter"
                            class="w-9 h-9 bg-green-900/50 hover:bg-[#22C55E] rounded-lg flex items-center justify-center transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Links 1 -->
                <div>
                    <h4 class="text-white font-bold mb-4">Produk</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#fitur" class="hover:text-[#86EFAC] transition-colors">Fitur Utama</a></li>
                        <li><a href="#" class="hover:text-[#86EFAC] transition-colors">Harga & Paket</a></li>
                        <li><a href="#" class="hover:text-[#86EFAC] transition-colors">Integrasi Hardware</a>
                        </li>
                        <li><a href="#" class="hover:text-[#86EFAC] transition-colors">Update Terbaru</a></li>
                    </ul>
                </div>

                <!-- Links 2 -->
                <div>
                    <h4 class="text-white font-bold mb-4">Perusahaan</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#tentang" class="hover:text-[#86EFAC] transition-colors">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-[#86EFAC] transition-colors">Karir</a></li>
                        <li><a href="#" class="hover:text-[#86EFAC] transition-colors">Blog & Artikel</a></li>
                        <li><a href="#kontak" class="hover:text-[#86EFAC] transition-colors">Hubungi Kami</a></li>
                    </ul>
                </div>

                <!-- Links 3 -->
                <div>
                    <h4 class="text-white font-bold mb-4">Bantuan</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#" class="hover:text-[#86EFAC] transition-colors">Pusat Bantuan</a></li>
                        <li><a href="#" class="hover:text-[#86EFAC] transition-colors">Video Tutorial</a></li>
                        <li><a href="#" class="hover:text-[#86EFAC] transition-colors">Kebijakan Privasi</a>
                        </li>
                        <li><a href="#" class="hover:text-[#86EFAC] transition-colors">Syarat & Ketentuan</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-green-900 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-green-200/60 text-sm">&copy; {{ date('Y') }} KasirPOS Pak Mushab. All rights
                    reserved.</p>
                <p class="text-green-200/60 text-sm">Dibuat dengan <span class="text-red-400">❤</span> di Indonesia
                </p>
            </div>
        </div>
    </footer>

    <!-- ==================== JAVASCRIPT ==================== -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            // 1. Navbar Shadow on Scroll
            const navbar = document.getElementById('navbar');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 10) {
                    navbar.classList.add('shadow-md', 'border-b', 'border-gray-100');
                } else {
                    navbar.classList.remove('shadow-md', 'border-b', 'border-gray-100');
                }
            });

            // 2. Hamburger Toggle
            const hamburgerBtn = document.getElementById('hamburger-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            const iconOpen = document.getElementById('icon-open');
            const iconClose = document.getElementById('icon-close');

            hamburgerBtn.addEventListener('click', () => {
                const isExpanded = hamburgerBtn.getAttribute('aria-expanded') === 'true';
                hamburgerBtn.setAttribute('aria-expanded', !isExpanded);

                mobileMenu.classList.toggle('hidden');
                iconOpen.classList.toggle('hidden');
                iconClose.classList.toggle('hidden');
            });

            // Close mobile menu when clicking a link
            document.querySelectorAll('#mobile-menu a').forEach(link => {
                link.addEventListener('click', () => {
                    mobileMenu.classList.add('hidden');
                    iconOpen.classList.remove('hidden');
                    iconClose.classList.add('hidden');
                    hamburgerBtn.setAttribute('aria-expanded', 'false');
                });
            });

            // 3. Intersection Observer for Fade-up & Counters
            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.1
            };

            const fadeUpObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        // If it's a counter, trigger it
                        if (entry.target.classList.contains('counter-wrapper')) {
                            animateCounters(entry.target);
                        }
                        fadeUpObserver.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.fade-up').forEach(el => {
                fadeUpObserver.observe(el);
            });

            // 4. Counter Animation
            const counters = document.querySelectorAll('.counter');
            let countersAnimated = false;

            const counterObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && !countersAnimated) {
                        countersAnimated = true;
                        counters.forEach(counter => {
                            const target = +counter.getAttribute('data-target');
                            const suffix = counter.getAttribute('data-suffix') || '';
                            const duration = 2000; // 2 seconds
                            const stepTime = Math.abs(Math.floor(duration / target));
                            let current = 0;

                            const timer = setInterval(() => {
                                current += Math.ceil(target / 100);
                                if (current >= target) {
                                    current = target;
                                    clearInterval(timer);
                                }
                                counter.textContent = current.toLocaleString(
                                    'id-ID') + suffix;
                            }, stepTime);
                        });
                        counterObserver.disconnect();
                    }
                });
            }, {
                threshold: 0.5
            });

            // Observe the parent section of counters
            const statsSection = document.querySelector('.counter')?.closest('section');
            if (statsSection) {
                counterObserver.observe(statsSection);
            }

            // 5. Active Link Highlighting (Optional but good for UX)
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('header nav a[href^="#"]');

            window.addEventListener('scroll', () => {
                let current = '';
                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    if (scrollY >= sectionTop - 100) {
                        current = section.getAttribute('id');
                    }
                });

                navLinks.forEach(link => {
                    link.classList.remove('text-[#22C55E]', 'font-bold');
                    if (link.getAttribute('href') === `#${current}`) {
                        link.classList.add('text-[#22C55E]', 'font-bold');
                    }
                });
            });
        });
    </script>
</body>

</html>
