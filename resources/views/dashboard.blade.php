@extends('layouts.app')

@section('page', 'dashboard')

@section('content')
    {{-- Page Content --}}
    <main class="flex-1 p-4 md:p-6 lg:p-8">

        {{-- Stat Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 md:gap-6 mb-6 md:mb-8">

            {{-- Total Produk --}}
            <div class="stat-card bg-white rounded-2xl p-5 md:p-6 shadow-sm border border-gray-100 animate-fade-in-up opacity-0"
                style="animation-fill-mode: forwards;">
                <div class="flex items-center gap-4">
                    <div
                        class="w-12 h-12 md:w-14 md:h-14 rounded-xl bg-green-50 flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 md:w-7 md:h-7 text-green-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl md:text-3xl font-bold text-gray-800">15</p>
                        <p class="text-sm text-gray-500 mt-0.5">Total Produk</p>
                    </div>
                </div>
            </div>

            {{-- Total Kategori --}}
            <div class="stat-card bg-white rounded-2xl p-5 md:p-6 shadow-sm border border-gray-100 animate-fade-in-up opacity-0 delay-100"
                style="animation-fill-mode: forwards;">
                <div class="flex items-center gap-4">
                    <div
                        class="w-12 h-12 md:w-14 md:h-14 rounded-xl bg-green-50 flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 md:w-7 md:h-7 text-green-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl md:text-3xl font-bold text-gray-800">5</p>
                        <p class="text-sm text-gray-500 mt-0.5">Total Kategori</p>
                    </div>
                </div>
            </div>

            {{-- Transaksi Hari Ini --}}
            <div class="stat-card bg-white rounded-2xl p-5 md:p-6 shadow-sm border border-gray-100 animate-fade-in-up opacity-0 delay-200"
                style="animation-fill-mode: forwards;">
                <div class="flex items-center gap-4">
                    <div
                        class="w-12 h-12 md:w-14 md:h-14 rounded-xl bg-green-50 flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 md:w-7 md:h-7 text-green-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl md:text-3xl font-bold text-gray-800">0</p>
                        <p class="text-sm text-gray-500 mt-0.5">Transaksi Hari Ini</p>
                    </div>
                </div>
            </div>

            {{-- Pendapatan Hari Ini --}}
            <div class="stat-card bg-white rounded-2xl p-5 md:p-6 shadow-sm border border-gray-100 animate-fade-in-up opacity-0 delay-300"
                style="animation-fill-mode: forwards;">
                <div class="flex items-center gap-4">
                    <div
                        class="w-12 h-12 md:w-14 md:h-14 rounded-xl bg-green-50 flex items-center justify-center flex-shrink-0">
                        <div class="w-7 h-7 md:w-8 md:h-8 rounded-full bg-green-100 flex items-center justify-center">
                            <span class="text-xs md:text-sm font-bold text-green-700">Rp</span>
                        </div>
                    </div>
                    <div>
                        <p class="text-2xl md:text-3xl font-bold text-gray-800">Rp 0</p>
                        <p class="text-sm text-gray-500 mt-0.5">Pendapatan Hari Ini</p>
                    </div>
                </div>
            </div>

        </div>

        {{-- Content Panels --}}
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-4 md:gap-6">

            {{-- Transaksi Terbaru --}}
            <div class="lg:col-span-3 bg-white rounded-2xl shadow-sm border border-gray-100 animate-slide-left opacity-0 delay-300"
                style="animation-fill-mode: forwards;">
                <div class="p-5 md:p-6 border-b border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-green-50 flex items-center justify-center">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        </div>
                        <h2 class="text-lg font-bold text-gray-800">Transaksi Terbaru</h2>
                    </div>
                </div>
                <div class="p-8 md:p-12 flex flex-col items-center justify-center min-h-[300px]">
                    <div
                        class="w-20 h-20 md:w-24 md:h-24 rounded-full bg-green-50 flex items-center justify-center mb-4 animate-float">
                        <svg class="w-10 h-10 md:w-12 md:h-12 text-green-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <p class="text-green-600 font-medium text-base md:text-lg">Belum ada transaksi</p>
                    <p class="text-gray-400 text-sm mt-1">Transaksi akan muncul di sini</p>
                </div>
            </div>

            {{-- Produk Terlaris --}}
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 animate-slide-right opacity-0 delay-400"
                style="animation-fill-mode: forwards;">
                <div class="p-5 md:p-6 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-green-50 flex items-center justify-center">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                            </div>
                            <h2 class="text-lg font-bold text-gray-800">Produk Terlaris</h2>
                        </div>
                        <div class="relative">
                            <select
                                class="appearance-none bg-white border border-gray-200 rounded-lg px-3 py-1.5 pr-8 text-sm text-gray-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent cursor-pointer hover:border-green-300 transition-colors">
                                <option>Hari Ini</option>
                                <option>Minggu Ini</option>
                                <option>Bulan Ini</option>
                            </select>
                            <svg class="w-4 h-4 text-gray-400 absolute right-2 top-1/2 -translate-y-1/2 pointer-events-none"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="divide-y divide-gray-50">

                    {{-- Product 1 --}}
                    <div class="product-item flex items-center gap-3 px-5 md:px-6 py-4 cursor-pointer">
                        <div class="w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center flex-shrink-0">
                            <span class="text-sm font-bold text-green-700">1</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-gray-800 text-sm md:text-base truncate">Sate Usus</p>
                            <p class="text-xs md:text-sm text-gray-400">Aneka Gorengan</p>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <p class="font-bold text-gray-800 text-sm md:text-base">0</p>
                            <p class="text-xs text-gray-400">terjual</p>
                        </div>
                    </div>

                    {{-- Product 2 --}}
                    <div class="product-item flex items-center gap-3 px-5 md:px-6 py-4 cursor-pointer">
                        <div class="w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center flex-shrink-0">
                            <span class="text-sm font-bold text-green-700">2</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-gray-800 text-sm md:text-base truncate">Risoles Mayo</p>
                            <p class="text-xs md:text-sm text-gray-400">Aneka Gorengan</p>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <p class="font-bold text-gray-800 text-sm md:text-base">0</p>
                            <p class="text-xs text-gray-400">terjual</p>
                        </div>
                    </div>

                    {{-- Product 3 --}}
                    <div class="product-item flex items-center gap-3 px-5 md:px-6 py-4 cursor-pointer">
                        <div class="w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center flex-shrink-0">
                            <span class="text-sm font-bold text-green-700">3</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-gray-800 text-sm md:text-base truncate">Bakwan Sayur</p>
                            <p class="text-xs md:text-sm text-gray-400">Aneka Gorengan</p>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <p class="font-bold text-gray-800 text-sm md:text-base">0</p>
                            <p class="text-xs text-gray-400">terjual</p>
                        </div>
                    </div>

                    {{-- Product 4 --}}
                    <div class="product-item flex items-center gap-3 px-5 md:px-6 py-4 cursor-pointer">
                        <div class="w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center flex-shrink-0">
                            <span class="text-sm font-bold text-green-700">4</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-gray-800 text-sm md:text-base truncate">Lemper Ayam</p>
                            <p class="text-xs md:text-sm text-gray-400">Aneka Kue Basah</p>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <p class="font-bold text-gray-800 text-sm md:text-base">0</p>
                            <p class="text-xs text-gray-400">terjual</p>
                        </div>
                    </div>

                    {{-- Product 5 --}}
                    <div class="product-item flex items-center gap-3 px-5 md:px-6 py-4 cursor-pointer">
                        <div class="w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center flex-shrink-0">
                            <span class="text-sm font-bold text-green-700">5</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-gray-800 text-sm md:text-base truncate">Dadar Gulung</p>
                            <p class="text-xs md:text-sm text-gray-400">Aneka Kue Basah</p>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <p class="font-bold text-gray-800 text-sm md:text-base">0</p>
                            <p class="text-xs text-gray-400">terjual</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </main>
@endsection
