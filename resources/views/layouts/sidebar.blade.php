@php
    $currentRoute = request()->route()->getName();
@endphp

<aside id="sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen bg-white border-r border-gray-100 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out flex flex-col">

    {{-- Logo --}}
    <div class="flex items-center gap-3 px-5 py-5 border-b border-gray-100">
        <div class="w-10 h-10 bg-green-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-md shadow-green-200">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
            </svg>
        </div>
        <div>
            <h1 class="font-bold text-gray-800 text-base leading-tight">Warung Gorengan</h1>
            <p class="text-xs text-gray-400">Sistem Kasir POS</p>
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 overflow-y-auto py-4 px-3">
        <ul class="space-y-1">

            {{-- Dashboard --}}
            <li>
                <a href="{{ route('dashboard') }}"
                   class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 {{ $currentRoute === 'dashboard' ? 'active' : '' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span class="text-sm font-medium">Dashboard</span>
                </a>
            </li>

            {{-- Kasir (POS) --}}
            <li>
                <a href="#"
                   class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 {{ str_contains($currentRoute ?? '', 'kasir') ? 'active' : '' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                    <span class="text-sm font-medium">Kasir (POS)</span>
                </a>
            </li>

            {{-- Produk --}}
            <li>
                <a href="#"
                   class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 {{ str_contains($currentRoute ?? '', 'produk') ? 'active' : '' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    <span class="text-sm font-medium">Produk</span>
                </a>
            </li>

            {{-- Kategori --}}
            <li>
                <a href="{{ route('kategori.index') }}"
                   class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 {{ str_contains($currentRoute ?? '', 'kategori') ? 'active' : '' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    <span class="text-sm font-medium">Kategori</span>
                </a>
            </li>

            {{-- Transaksi --}}
            <li>
                <a href="#"
                   class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 {{ str_contains($currentRoute ?? '', 'transaksi') ? 'active' : '' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    <span class="text-sm font-medium">Transaksi</span>
                </a>
            </li>

            {{-- Laporan --}}
            <li>
                <a href="#"
                   class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 {{ str_contains($currentRoute ?? '', 'laporan') ? 'active' : '' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    <span class="text-sm font-medium">Laporan</span>
                </a>
            </li>

            {{-- Pengaturan --}}
            <li>
                <a href="#"
                   class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 {{ str_contains($currentRoute ?? '', 'pengaturan') ? 'active' : '' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="text-sm font-medium">Pengaturan</span>
                </a>
            </li>

        </ul>
    </nav>

    {{-- User Profile --}}
    <div class="border-t border-gray-100 p-4">
        <div class="flex items-center gap-3 px-2 py-2">
            <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                <span class="text-green-700 font-bold text-sm">A</span>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-gray-800 truncate">Admin Warung</p>
                <p class="text-xs text-gray-400 truncate">Administrator</p>
            </div>
            <a href="#" class="w-9 h-9 rounded-lg hover:bg-red-50 flex items-center justify-center text-gray-400 hover:text-red-500 transition-colors group" title="Logout">
                <svg class="w-5 h-5 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
            </a>
        </div>
    </div>

</aside>
