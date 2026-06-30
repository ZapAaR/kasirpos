@extends('layouts.app')

@section('page', 'Produk')

@section('content')

<div class="flex flex-col xl:flex-row gap-6">

    {{-- Main Content --}}
    <div class="flex-1">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 animate-fade-in-up">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Produk</h1>
                <p class="text-gray-400 mt-1">Kelola semua produk warung Anda</p>
            </div>
            <a href="{{ route('produk.create') }}"
               class="inline-flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-xl font-medium transition-all duration-200 shadow-lg shadow-green-200 hover:shadow-xl hover:shadow-green-300 hover:-translate-y-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span>Tambah Produk</span>
            </a>
        </div>

        {{-- Search & Filter --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 mb-6 animate-slide-left">
            <div class="p-5 border-b border-gray-100">
                <form method="GET" action="{{ route('produk.index') }}" class="flex flex-col lg:flex-row gap-3">

                    {{-- Search --}}
                    <div class="flex-1 relative">
                        <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text"
                               name="search"
                               placeholder="Cari nama produk..."
                               value="{{ request('search') }}"
                               class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all bg-gray-50 focus:bg-white">
                    </div>

                    {{-- Filter Kategori --}}
                    <select name="category"
                            onchange="this.form.submit()"
                            class="px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 bg-white text-gray-600 cursor-pointer hover:border-green-300 transition-colors min-w-[160px]">
                        <option value="">Semua Kategori</option>
                        @foreach($kategoris as $kat)
                        <option value="{{ $kat->id }}" {{ request('category') == $kat->id ? 'selected' : '' }}>
                            {{ $kat->nama }}
                        </option>
                        @endforeach
                    </select>

                    {{-- Filter Stok --}}
                    <select name="stok"
                            onchange="this.form.submit()"
                            class="px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 bg-white text-gray-600 cursor-pointer hover:border-green-300 transition-colors min-w-[160px]">
                        <option value="">Semua Stok</option>
                        <option value="aman" {{ request('stok') == 'aman' ? 'selected' : '' }}>Stok Aman</option>
                        <option value="menipis" {{ request('stok') == 'menipis' ? 'selected' : '' }}>Stok Menipis</option>
                        <option value="habis" {{ request('stok') == 'habis' ? 'selected' : '' }}>Stok Habis</option>
                    </select>

                    {{-- Reset --}}
                    @if(request('search') || request('category') || request('stok'))
                    <a href="{{ route('produk.index') }}"
                       class="px-4 py-3 border border-gray-200 rounded-xl hover:bg-gray-50 text-gray-600 transition-colors flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                    </a>
                    @endif
                </form>
            </div>

            {{-- Grid Produk --}}
            <div class="p-5">
                @if($produks->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                    @foreach($produks as $produk)
                    <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group animate-fade-in">

                        {{-- Gambar --}}
                        <div class="relative aspect-square bg-gray-100 overflow-hidden">
                            @if($produk->gambar)
                            <img src="{{ asset('storage/produk/' . $produk->gambar) }}"
                                 alt="{{ $produk->nama_produk }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-green-50 to-emerald-100">
                                <svg class="w-16 h-16 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            @endif

                            {{-- Badge Stok --}}
                            <div class="absolute top-3 left-3">
                                @if($produk->stok == 0)
                                <span class="px-2.5 py-1 bg-red-500 text-white text-xs font-semibold rounded-lg shadow-lg">Habis</span>
                                @elseif($produk->stok <= 10)
                                <span class="px-2.5 py-1 bg-yellow-500 text-white text-xs font-semibold rounded-lg shadow-lg">Menipis</span>
                                @else
                                <span class="px-2.5 py-1 bg-green-500 text-white text-xs font-semibold rounded-lg shadow-lg">Tersedia</span>
                                @endif
                            </div>

                            {{-- Badge Tersedia --}}
                            @if(!$produk->tersedia)
                            <div class="absolute top-3 right-3">
                                <span class="px-2.5 py-1 bg-gray-800 text-white text-xs font-semibold rounded-lg shadow-lg">Nonaktif</span>
                            </div>
                            @endif

                            {{-- Quick Actions Overlay --}}
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
                                <a href="{{ route('produk.show', $produk) }}"
                                   class="w-10 h-10 rounded-xl bg-white/90 hover:bg-white flex items-center justify-center text-gray-700 hover:text-green-600 transition-all hover:scale-110"
                                   title="Lihat">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>
                                <a href="{{ route('produk.edit', $produk) }}"
                                   class="w-10 h-10 rounded-xl bg-white/90 hover:bg-white flex items-center justify-center text-gray-700 hover:text-blue-600 transition-all hover:scale-110"
                                   title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <button onclick="confirmDelete({{ $produk->id }}, '{{ $produk->nama_produk }}')"
                                        class="w-10 h-10 rounded-xl bg-white/90 hover:bg-white flex items-center justify-center text-gray-700 hover:text-red-600 transition-all hover:scale-110"
                                        title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        {{-- Info --}}
                        <div class="p-4">
                            <div class="flex items-start justify-between gap-2 mb-2">
                                <div class="flex-1 min-w-0">
                                    <a href="{{ route('produk.show', $produk) }}" class="block">
                                        <h3 class="font-bold text-gray-800 truncate hover:text-green-600 transition-colors">{{ $produk->nama_produk }}</h3>
                                    </a>
                                    <p class="text-xs text-gray-400 mt-0.5">{{ $produk->kategori->nama ?? 'Tanpa Kategori' }}</p>
                                </div>
                            </div>

                            <div class="flex items-end justify-between mt-3 pt-3 border-t border-gray-50">
                                <div>
                                    <p class="text-xs text-gray-400">Harga Jual</p>
                                    <p class="text-lg font-bold text-green-600">{{ $produk->harga_jual_formatted }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs text-gray-400">Stok</p>
                                    <p class="font-bold text-gray-800">{{ $produk->stok }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
                @else
                {{-- Empty State --}}
                <div class="text-center py-16">
                    <div class="w-24 h-24 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-700 mb-1">Belum ada produk</h3>
                    <p class="text-gray-400 text-sm mb-6">Mulai tambahkan produk pertama Anda</p>
                    <a href="{{ route('produk.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-xl font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Tambah Produk Pertama
                    </a>
                </div>
                @endif
            </div>

            {{-- Pagination --}}
            @if($produks->hasPages())
            <div class="px-5 py-4 border-t border-gray-100 bg-gray-50/30 rounded-b-2xl">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="text-sm text-gray-500">
                        Menampilkan <span class="font-semibold text-gray-700">{{ $produks->firstItem() }}</span> - <span class="font-semibold text-gray-700">{{ $produks->lastItem() }}</span> dari <span class="font-semibold text-gray-700">{{ $produks->total() }}</span> produk
                    </div>

                    <div class="flex items-center gap-1">
                        @if($produks->onFirstPage())
                        <button disabled class="px-3 py-2 rounded-lg border border-gray-200 text-gray-300 cursor-not-allowed bg-white">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </button>
                        @else
                        <a href="{{ $produks->previousPageUrl() }}" class="px-3 py-2 rounded-lg border border-gray-200 hover:bg-white hover:border-green-300 hover:text-green-600 text-gray-600 transition-all bg-white">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </a>
                        @endif

                        @foreach($produks->getUrlRange(1, $produks->lastPage()) as $page => $url)
                            @if($page == $produks->currentPage())
                            <span class="px-4 py-2 rounded-lg bg-green-600 text-white font-semibold shadow-md shadow-green-200">{{ $page }}</span>
                            @else
                            <a href="{{ $url }}" class="px-4 py-2 rounded-lg border border-gray-200 hover:bg-white hover:border-green-300 hover:text-green-600 text-gray-600 transition-all bg-white">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if($produks->hasMorePages())
                        <a href="{{ $produks->nextPageUrl() }}" class="px-3 py-2 rounded-lg border border-gray-200 hover:bg-white hover:border-green-300 hover:text-green-600 text-gray-600 transition-all bg-white">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                        @else
                        <button disabled class="px-3 py-2 rounded-lg border border-gray-200 text-gray-300 cursor-not-allowed bg-white">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        </div>

    </div>
</div>

{{-- Delete Confirmation Modal --}}
<div id="deleteModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeDeleteModal()"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm animate-scale-in overflow-hidden">
            <div class="bg-gradient-to-r from-red-500 to-red-600 px-6 py-5 text-white text-center">
                <div class="w-16 h-16 rounded-full bg-white/20 backdrop-blur flex items-center justify-center mx-auto mb-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold">Hapus Produk?</h3>
            </div>
            <div class="p-6 text-center">
                <p class="text-gray-600 mb-2">Apakah Anda yakin ingin menghapus</p>
                <p class="text-gray-800 font-bold text-lg mb-4">"<span id="deleteProdukNama"></span>"?</p>
                <p class="text-sm text-gray-400 mb-6">Tindakan ini tidak dapat dibatalkan.</p>

                <form id="deleteForm" method="POST" class="flex gap-3">
                    @csrf
                    @method('DELETE')
                    <button type="button"
                            onclick="closeDeleteModal()"
                            class="flex-1 px-4 py-3 border-2 border-gray-200 rounded-xl hover:bg-gray-50 text-gray-700 font-semibold transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                            class="flex-1 px-4 py-3 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white rounded-xl font-semibold transition-all shadow-lg shadow-red-200">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function confirmDelete(id, nama) {
        document.getElementById('deleteProdukNama').textContent = nama;
        document.getElementById('deleteForm').action = `/produk/${id}`;
        document.getElementById('deleteModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeDeleteModal();
    });
</script>
@endpush
