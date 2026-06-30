@extends('layouts.app')

@section('page', 'Produk')

@section('content')

<div class="max-w-6xl mx-auto">

    {{-- Header --}}
    <div class="flex items-center gap-4 mb-6 animate-fade-in-up">
        <a href="{{ route('produk.index') }}"
           class="w-10 h-10 rounded-xl bg-white border border-gray-200 hover:bg-gray-50 flex items-center justify-center text-gray-600 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </a>
        <div class="flex-1">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Detail Produk</h1>
            <p class="text-gray-400 mt-1">Informasi lengkap produk</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('produk.edit', $produk) }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-medium transition-colors shadow-lg shadow-blue-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                <span class="hidden sm:inline">Edit</span>
            </a>
            <button onclick="confirmDelete({{ $produk->id }}, '{{ $produk->nama_produk }}')"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-xl font-medium transition-colors shadow-lg shadow-red-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                <span class="hidden sm:inline">Hapus</span>
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Left - Gambar & Info Utama --}}
        <div class="lg:col-span-1 space-y-4">

            {{-- Gambar Produk --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden animate-slide-left">
                <div class="aspect-square bg-gray-100 relative">
                    @if($produk->gambar)
                    <img src="{{ asset('storage/produk/' . $produk->gambar) }}"
                         alt="{{ $produk->nama_produk }}"
                         class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-green-50 to-emerald-100">
                        <svg class="w-24 h-24 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    @endif

                    {{-- Badge --}}
                    <div class="absolute top-4 left-4">
                        @if($produk->stok == 0)
                        <span class="px-3 py-1.5 bg-red-500 text-white text-sm font-semibold rounded-lg shadow-lg">Stok Habis</span>
                        @elseif($produk->stok <= 10)
                        <span class="px-3 py-1.5 bg-yellow-500 text-white text-sm font-semibold rounded-lg shadow-lg">Stok Menipis</span>
                        @else
                        <span class="px-3 py-1.5 bg-green-500 text-white text-sm font-semibold rounded-lg shadow-lg">Tersedia</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Status Card --}}
            <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm animate-slide-left delay-100">
                <h3 class="font-bold text-gray-800 mb-4">Status</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                        <span class="text-sm text-gray-600">Ketersediaan</span>
                        @if($produk->tersedia)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-600"></span>
                            Tersedia
                        </span>
                        @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                            <span class="w-1.5 h-1.5 rounded-full bg-red-600"></span>
                            Nonaktif
                        </span>
                        @endif
                    </div>
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                        <span class="text-sm text-gray-600">Kategori</span>
                        <span class="text-sm font-semibold text-gray-800">{{ $produk->kategori->nama ?? '-' }}</span>
                    </div>
                </div>
            </div>

        </div>

        {{-- Right - Detail Info --}}
        <div class="lg:col-span-2 space-y-4">

            {{-- Info Produk --}}
            <div class="bg-white rounded-2xl p-6 md:p-8 border border-gray-100 shadow-sm animate-slide-right">
                <div class="flex items-start justify-between mb-6">
                    <div>
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">{{ $produk->nama_produk }}</h2>
                        <p class="text-gray-400">ID: #{{ str_pad($produk->id, 4, '0', STR_PAD_LEFT) }}</p>
                    </div>
                </div>

                {{-- Harga Cards --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-4 border border-blue-200">
                        <p class="text-xs text-blue-600 font-medium mb-1">Harga Modal</p>
                        <p class="text-xl font-bold text-blue-800">{{ $produk->harga_modal_formatted }}</p>
                    </div>
                    <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-4 border border-green-200">
                        <p class="text-xs text-green-600 font-medium mb-1">Harga Jual</p>
                        <p class="text-xl font-bold text-green-800">{{ $produk->harga_jual_formatted }}</p>
                    </div>
                    <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-4 border border-purple-200">
                        <p class="text-xs text-purple-600 font-medium mb-1">Keuntungan</p>
                        <p class="text-xl font-bold text-purple-800">Rp {{ number_format($produk->keuntungan, 0, ',', '.') }}</p>
                        <p class="text-xs text-purple-600 mt-1">Margin: {{ number_format($produk->margin, 1) }}%</p>
                    </div>
                </div>

                {{-- Detail Grid --}}
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 pt-6 border-t border-gray-100">
                    <div>
                        <p class="text-xs text-gray-400 mb-1">Stok Saat Ini</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $produk->stok }}</p>
                        <p class="text-xs text-gray-400 mt-1">unit</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 mb-1">Nilai Stok</p>
                        <p class="text-lg font-bold text-gray-800">Rp {{ number_format($produk->stok * $produk->harga_modal, 0, ',', '.') }}</p>
                        <p class="text-xs text-gray-400 mt-1">modal</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 mb-1">Potensi Pendapatan</p>
                        <p class="text-lg font-bold text-gray-800">Rp {{ number_format($produk->stok * $produk->harga_jual, 0, ',', '.') }}</p>
                        <p class="text-xs text-gray-400 mt-1">jika terjual semua</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 mb-1">Potensi Profit</p>
                        <p class="text-lg font-bold text-green-600">Rp {{ number_format($produk->stok * $produk->keuntungan, 0, ',', '.') }}</p>
                        <p class="text-xs text-gray-400 mt-1">total keuntungan</p>
                    </div>
                </div>
            </div>

            {{-- Timeline --}}
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm animate-slide-right delay-100">
                <h3 class="font-bold text-gray-800 mb-4">Riwayat</h3>
                <div class="space-y-4">
                    <div class="flex gap-4">
                        <div class="flex flex-col items-center">
                            <div class="w-3 h-3 rounded-full bg-green-500"></div>
                            <div class="w-0.5 flex-1 bg-gray-200 mt-1"></div>
                        </div>
                        <div class="flex-1 pb-4">
                            <p class="text-sm font-semibold text-gray-800">Produk dibuat</p>
                            <p class="text-xs text-gray-400 mt-0.5">{{ $produk->created_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="flex flex-col items-center">
                            <div class="w-3 h-3 rounded-full bg-blue-500"></div>
                            <div class="w-0.5 flex-1 bg-gray-200 mt-1"></div>
                        </div>
                        <div class="flex-1 pb-4">
                            <p class="text-sm font-semibold text-gray-800">Terakhir diperbarui</p>
                            <p class="text-xs text-gray-400 mt-0.5">{{ $produk->updated_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="flex flex-col items-center">
                            <div class="w-3 h-3 rounded-full bg-gray-300"></div>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-800">Status saat ini</p>
                            <p class="text-xs text-gray-400 mt-0.5">{{ $produk->tersedia ? 'Aktif dan tersedia untuk dijual' : 'Nonaktif' }}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Produk Terkait --}}
    @if($produkTerkait->count() > 0)
    <div class="mt-8 animate-fade-in-up delay-200">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Produk Terkait</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($produkTerkait as $related)
            <a href="{{ route('produk.show', $related) }}"
               class="bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all group">
                <div class="aspect-square bg-gray-100 overflow-hidden">
                    @if($related->gambar)
                    <img src="{{ asset('storage/produk/' . $related->gambar) }}"
                         alt="{{ $related->nama_produk }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-green-50 to-emerald-100">
                        <svg class="w-12 h-12 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    @endif
                </div>
                <div class="p-3">
                    <h4 class="font-semibold text-gray-800 text-sm truncate group-hover:text-green-600 transition-colors">{{ $related->nama_produk }}</h4>
                    <p class="text-green-600 font-bold text-sm mt-1">{{ $related->harga_jual_formatted }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

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
