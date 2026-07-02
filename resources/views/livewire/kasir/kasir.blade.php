@section('page', 'Kasir POS')
<div class="min-h-screen bg-gray-100">

    {{-- Toast Notification --}}
    <div x-data="{ show: false, message: '', type: 'success' }"
         @toast.window="show = true; message = $event.detail.message; type = $event.detail.type; setTimeout(() => show = false, 3000)"
         class="fixed top-20 right-4 z-50 space-y-2">
        <div x-show="show"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-x-full"
             x-transition:enter-end="opacity-100 translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-x-0"
             x-transition:leave-end="opacity-0 translate-x-full"
             :class="{
                 'bg-green-500': type === 'success',
                 'bg-red-500': type === 'error',
                 'bg-yellow-500': type === 'warning',
                 'bg-blue-500': type === 'info'
             }"
             class="text-white px-6 py-3 rounded-xl shadow-lg flex items-center gap-3 min-w-[280px]">
            <svg x-show="type === 'success'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            <svg x-show="type === 'error'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
            <svg x-show="type === 'warning'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            <span class="font-medium" x-text="message"></span>
        </div>
    </div>

    <div class="flex h-screen overflow-hidden">

        {{-- Main Content Area --}}
        <div class="flex-1 flex flex-col overflow-hidden">

            {{-- Topbar --}}
            <header class="sticky top-0">
                <div class="flex items-center justify-between gap-4">
                    <div class="flex items-center gap-3 flex-1">

                        <div class="flex-1 max-w-2xl relative">
                            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <input type="text"
                                   wire:model.live.debounce.300ms="search"
                                   placeholder="Cari produk..."
                                   class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#22C55E] focus:border-transparent focus:bg-white transition-all mt-2 ml-2">
                            @if($search)
                            <button wire:click="$set('search', '')" class="absolute right-3 top-1/2 -translate-y-1/2 w-6 h-6 rounded-lg hover:bg-gray-200 flex items-center justify-center text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                            @endif
                        </div>
                    </div>

                    <button @click="$wire.showCartMobile = !$wire.showCartMobile"
                            class="lg:hidden relative w-12 h-12 rounded-xl bg-[#22C55E] hover:bg-[#16A34A] text-white flex items-center justify-center shadow-lg shadow-green-200 transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                        </svg>
                        @if($cartCount > 0)
                        <span class="absolute -top-1 -right-1 w-6 h-6 bg-red-500 text-white text-xs font-bold rounded-full flex items-center justify-center shadow-md">
                            {{ $cartCount }}
                        </span>
                        @endif
                    </button>
                </div>

                {{-- Category Filter --}}
                <div class="mt-4 flex items-center gap-2 overflow-x-auto pb-2 scrollbar-hide">
                    <button wire:click="$set('selectedCategory', '')"
                            class="flex-shrink-0 px-4 py-2 rounded-xl font-medium text-sm transition-all {{ !$selectedCategory ? 'bg-[#22C55E] text-white shadow-md shadow-green-200' : 'bg-white text-gray-600 border border-gray-200 hover:border-[#22C55E] hover:text-[#22C55E]' }}">
                        Semua
                    </button>
                    @foreach($categories as $cat)
                    <button wire:click="$set('selectedCategory', '{{ $cat->id }}')"
                            class="flex-shrink-0 px-4 py-2 rounded-xl font-medium text-sm transition-all {{ $selectedCategory == $cat->id ? 'bg-[#22C55E] text-white shadow-md shadow-green-200' : 'bg-white text-gray-600 border border-gray-200 hover:border-[#22C55E] hover:text-[#22C55E]' }}">
                        {{ $cat->nama }}
                    </button>
                    @endforeach
                </div>
            </header>

            {{-- Product Grid Area --}}
            <main class="flex-1 overflow-y-auto p-4 md:p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Kasir</h1>
                        <p class="text-sm text-gray-500 mt-1">
                            {{ $produkList->count() }} produk tersedia
                        </p>
                    </div>
                    <div class="hidden md:flex items-center gap-2 text-sm text-gray-500">
                        <div class="w-2 h-2 rounded-full bg-[#22C55E] animate-pulse"></div>
                        <span>Live</span>
                    </div>
                </div>

                @if($produkList->count() > 0)
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4">
                    @foreach($produkList as $produk)
                    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group cursor-pointer {{ $produk->stok == 0 ? 'opacity-60' : '' }}"
                         wire:click="{{ $produk->stok > 0 ? 'addToCart(' . $produk->id . ')' : '' }}">

                        <div class="relative aspect-square bg-gray-50 overflow-hidden">
                            @if($produk->gambar)
                            <img src="{{ asset('storage/produk/' . $produk->gambar) }}"
                                 alt="{{ $produk->nama_produk }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-[#F0FDF4] to-[#86EFAC]/30">
                                <svg class="w-12 h-12 text-[#22C55E]/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                            </div>
                            @endif

                            <div class="absolute top-2 left-2">
                                @if($produk->stok == 0)
                                <span class="px-2 py-1 bg-red-500 text-white text-[10px] font-bold rounded-lg shadow-md">HABIS</span>
                                @elseif($produk->stok <= 10)
                                <span class="px-2 py-1 bg-yellow-500 text-white text-[10px] font-bold rounded-lg shadow-md">SISA {{ $produk->stok }}</span>
                                @else
                                <span class="px-2 py-1 bg-[#22C55E] text-white text-[10px] font-bold rounded-lg shadow-md">STOK {{ $produk->stok }}</span>
                                @endif
                            </div>

                            @if($produk->stok > 0)
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors flex items-center justify-center opacity-0 group-hover:opacity-100">
                                <div class="w-12 h-12 rounded-full bg-white shadow-lg flex items-center justify-center transform scale-75 group-hover:scale-100 transition-transform">
                                    <svg class="w-6 h-6 text-[#22C55E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                </div>
                            </div>
                            @endif
                        </div>

                        <div class="p-3">
                            <p class="text-[10px] text-gray-400 font-medium uppercase tracking-wider mb-1">
                                {{ $produk->kategori->nama ?? 'Umum' }}
                            </p>
                            <h3 class="font-semibold text-gray-800 text-sm mb-2 line-clamp-2 group-hover:text-[#22C55E] transition-colors">
                                {{ $produk->nama_produk }}
                            </h3>
                            <p class="text-[#16A34A] font-bold text-base">
                                Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="flex flex-col items-center justify-center py-20">
                    <div class="w-24 h-24 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-700 mb-1">Produk tidak ditemukan</h3>
                    <p class="text-gray-400 text-sm">Coba ubah kata kunci pencarian atau filter kategori</p>
                </div>
                @endif
            </main>
        </div>

        {{-- Cart Sidebar (Desktop) --}}
        <aside class="hidden lg:flex w-96 bg-white border-l border-gray-100 flex-col">
            @include('livewire.kasir.cart-panel')
        </aside>

        {{-- Cart Drawer (Mobile) --}}
        <div x-show="$wire.showCartMobile"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-40 lg:hidden">
            <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" @click="$wire.showCartMobile = false"></div>
            <div x-show="$wire.showCartMobile"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="translate-x-full"
                 class="absolute right-0 top-0 bottom-0 w-full max-w-md bg-white shadow-2xl">
                @include('livewire.kasir.cart-panel')
            </div>
        </div>

    </div>

    {{-- Checkout Modal --}}
    @if($showCheckoutModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" wire:click="closeCheckout"></div>
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg animate-scale-in max-h-[90vh] overflow-y-auto">

            <div class="bg-gradient-to-r from-[#22C55E] to-[#16A34A] px-6 py-5 text-white rounded-t-2xl">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-white/20 backdrop-blur flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold">Pembayaran</h3>
                            <p class="text-green-100 text-sm">{{ $cartCount }} item</p>
                        </div>
                    </div>
                    <button wire:click="closeCheckout" class="w-10 h-10 rounded-xl hover:bg-white/20 flex items-center justify-center transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="p-6 space-y-5">

                {{-- Total Harga --}}
                <div class="bg-gradient-to-br from-[#F0FDF4] to-white border border-green-100 rounded-xl p-5">
                    <p class="text-sm text-gray-600 mb-1">Total Belanja</p>
                    <p class="text-3xl font-bold text-[#16A34A]">Rp {{ number_format($total, 0, ',', '.') }}</p>
                </div>

                {{-- Quick Payment Buttons --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Uang Pembeli (Pilih Nominal)</label>
                    <div class="grid grid-cols-3 gap-2 mb-3">
                        @php
                            $total = $total;
                            $quickAmounts = [
                                $total,
                                ceil($total / 10000) * 10000,
                                ceil($total / 20000) * 20000,
                                ceil($total / 50000) * 50000,
                                ceil($total / 100000) * 100000,
                                200000,
                            ];
                            $quickAmounts = array_unique(array_filter($quickAmounts, fn($a) => $a >= $total));
                            sort($quickAmounts);
                            $quickAmounts = array_slice($quickAmounts, 0, 6);
                        @endphp
                        @foreach($quickAmounts as $amount)
                        <button wire:click="setQuickPayment({{ $amount }})"
                                class="px-3 py-2.5 border-2 rounded-xl text-sm font-semibold transition-all {{ $totalBayar == $amount ? 'border-[#22C55E] bg-[#F0FDF4] text-[#14532D]' : 'border-gray-200 hover:border-[#22C55E] text-gray-600' }}">
                            Rp {{ number_format($amount, 0, ',', '.') }}
                        </button>
                        @endforeach
                    </div>
                </div>

                {{-- Custom Payment Input --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Atau Masukkan Nominal</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 font-medium">Rp</span>
                        <input type="number"
                               wire:model.live="totalBayar"
                               min="0"
                               placeholder="0"
                               class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#22C55E] focus:border-[#22C55E] bg-gray-50 focus:bg-white transition-all text-lg font-semibold">
                    </div>
                </div>

                {{-- Summary --}}
                <div class="bg-gray-50 rounded-xl p-4 space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Total Harga</span>
                        <span class="font-semibold text-gray-800">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Dibayar</span>
                        <span class="font-semibold text-gray-800">Rp {{ number_format($totalBayar, 0, ',', '.') }}</span>
                    </div>
                    <div class="border-t border-gray-200 pt-3 flex justify-between items-baseline">
                        <span class="font-bold text-gray-800">Kembalian</span>
                        <span class="text-2xl font-bold {{ $kembalian >= 0 ? 'text-[#16A34A]' : 'text-red-600' }}">
                            Rp {{ number_format($kembalian, 0, ',', '.') }}
                        </span>
                    </div>
                    @if($totalBayar > 0 && $totalBayar < $total)
                    <div class="bg-red-50 border border-red-200 rounded-lg p-3 text-center">
                        <p class="text-sm text-red-600 font-medium">
                            ⚠️ Uang kurang Rp {{ number_format($total - $totalBayar, 0, ',', '.') }}
                        </p>
                    </div>
                    @endif
                </div>

            </div>

            <div class="px-6 py-4 border-t border-gray-100 flex gap-3">
                <button wire:click="closeCheckout"
                        class="flex-1 px-4 py-3 border-2 border-gray-200 rounded-xl hover:bg-gray-50 text-gray-700 font-semibold transition-colors">
                    Batal
                </button>
                <button wire:click="processCheckout"
                        {{ $kembalian < 0 ? 'disabled' : '' }}
                        class="flex-1 px-4 py-3 bg-gradient-to-r from-[#22C55E] to-[#16A34A] hover:from-[#16A34A] hover:to-[#14532D] text-white rounded-xl font-semibold transition-all shadow-lg shadow-green-200 flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Proses Pembayaran
                </button>
            </div>

        </div>
    </div>
    @endif

    {{-- Success Modal --}}
    @if($showSuccessModal && $lastTransaction)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md animate-scale-in overflow-hidden">

            <div class="bg-gradient-to-br from-[#22C55E] to-[#16A34A] px-6 py-8 text-white text-center">
                <div class="w-20 h-20 rounded-full bg-white/20 backdrop-blur flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-1">Transaksi Berhasil!</h3>
                <p class="text-green-100">Terima kasih</p>
            </div>

            <div class="p-6 space-y-4">
                <div class="bg-gray-50 rounded-xl p-4 space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Nomor Nota</span>
                        <span class="font-bold text-gray-800">{{ $lastTransaction['nomor_nota'] }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Jumlah Item</span>
                        <span class="font-semibold text-gray-800">{{ $lastTransaction['items_count'] }} item</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Total Harga</span>
                        <span class="font-semibold text-gray-800">Rp {{ number_format($lastTransaction['total_harga'], 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Dibayar</span>
                        <span class="font-semibold text-gray-800">Rp {{ number_format($lastTransaction['total_bayar'], 0, ',', '.') }}</span>
                    </div>
                    <div class="border-t border-gray-200 pt-3 flex justify-between items-baseline">
                        <span class="font-bold text-gray-800">Kembalian</span>
                        <span class="text-2xl font-bold text-[#16A34A]">Rp {{ number_format($lastTransaction['kembalian'], 0, ',', '.') }}</span>
                    </div>
                </div>

                <button wire:click="closeSuccessModal"
                        class="w-full px-4 py-3 bg-gradient-to-r from-[#22C55E] to-[#16A34A] hover:from-[#16A34A] hover:to-[#14532D] text-white rounded-xl font-semibold transition-all shadow-lg shadow-green-200 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Transaksi Baru
                </button>
            </div>

        </div>
    </div>
    @endif

</div>
