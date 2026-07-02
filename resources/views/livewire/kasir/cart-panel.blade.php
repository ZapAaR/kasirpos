<div class="flex flex-col h-full">

    <div class="px-5 py-4 border-b border-gray-100 bg-gradient-to-r from-[#F0FDF4] to-white">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-[#22C55E] flex items-center justify-center shadow-md shadow-green-200">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="font-bold text-gray-800">Keranjang</h2>
                    <p class="text-xs text-gray-500">
                        @if($cartCount > 0) {{ $cartCount }} item @else Kosong @endif
                    </p>
                </div>
            </div>
            @if($cartCount > 0)
            <button wire:click="clearCart"
                    wire:confirm="Yakin kosongkan keranjang?"
                    class="w-9 h-9 rounded-lg hover:bg-red-50 flex items-center justify-center text-gray-400 hover:text-red-600 transition-colors"
                    title="Kosongkan">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </button>
            @endif
        </div>
    </div>

    <div class="flex-1 overflow-y-auto">
        @if($cartItems->count() > 0)
        <div class="p-4 space-y-3">
            @foreach($cartItems as $item)
            <div class="bg-white border border-gray-100 rounded-xl p-3 hover:shadow-md transition-shadow group">
                <div class="flex gap-3">
                    <div class="w-16 h-16 rounded-lg bg-gray-100 overflow-hidden flex-shrink-0">
                        @if($item['gambar'])
                        <img src="{{ asset('storage/produk/' . $item['gambar']) }}"
                             alt="{{ $item['nama'] }}"
                             class="w-full h-full object-cover">
                        @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-[#F0FDF4] to-[#86EFAC]/30">
                            <svg class="w-6 h-6 text-[#22C55E]/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        @endif
                    </div>

                    <div class="flex-1 min-w-0">
                        <h4 class="font-semibold text-gray-800 text-sm truncate mb-1">{{ $item['nama'] }}</h4>
                        <p class="text-[#16A34A] font-bold text-sm">Rp {{ number_format($item['harga'], 0, ',', '.') }}</p>

                        <div class="flex items-center justify-between mt-2">
                            <div class="flex items-center gap-1 bg-gray-100 rounded-lg p-1">
                                <button wire:click="updateQty({{ $item['id'] }}, 'decrease')"
                                        class="w-7 h-7 rounded-md hover:bg-white hover:shadow-sm flex items-center justify-center text-gray-600 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                    </svg>
                                </button>
                                <input
                                    type="number"
                                    min="1"
                                    value="{{ $item['qty'] }}"
                                    wire:change="setQty({{ $item['id'] }}, $event.target.value)"
                                    class="w-16 h-7 text-center text-sm font-bold border-0 bg-transparent focus:ring-2 focus:ring-[#22C55E] rounded-md"
                                />
                                <button wire:click="updateQty({{ $item['id'] }}, 'increase')"
                                        class="w-7 h-7 rounded-md hover:bg-white hover:shadow-sm flex items-center justify-center text-gray-600 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                </button>
                            </div>
                            <button wire:click="removeFromCart({{ $item['id'] }})"
                                    wire:confirm="Hapus item ini?"
                                    class="w-7 h-7 rounded-lg hover:bg-red-50 flex items-center justify-center text-gray-400 hover:text-red-600 transition-colors opacity-0 group-hover:opacity-100">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="text-right flex-shrink-0">
                        <p class="font-bold text-gray-800 text-sm">Rp {{ number_format($item['harga'] * $item['qty'], 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="flex flex-col items-center justify-center py-16 px-6">
            <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                </svg>
            </div>
            <h3 class="font-bold text-gray-700 mb-1">Keranjang Kosong</h3>
            <p class="text-gray-400 text-sm text-center">Klik produk untuk menambahkan</p>
        </div>
        @endif
    </div>

    @if($cartCount > 0)
    <div class="border-t border-gray-100 bg-white p-5 space-y-4">
        <div class="space-y-2">
            <div class="flex justify-between text-sm">
                <span class="text-gray-500">Subtotal ({{ $cartCount }} item)</span>
                <span class="font-semibold text-gray-800">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between items-baseline">
                <span class="font-bold text-gray-800">Total</span>
                <span class="text-2xl font-bold text-[#16A34A]">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-3">
            <button wire:click="clearCart"
                    wire:confirm="Yakin kosongkan keranjang?"
                    class="px-4 py-3 border-2 border-gray-200 rounded-xl hover:bg-gray-50 text-gray-700 font-semibold transition-colors flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                Kosongkan
            </button>
            <button wire:click="openCheckout"
                    class="px-4 py-3 bg-gradient-to-r from-[#22C55E] to-[#16A34A] hover:from-[#16A34A] hover:to-[#14532D] text-white rounded-xl font-semibold transition-all shadow-lg shadow-green-200 hover:shadow-xl flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                Bayar
            </button>
        </div>
    </div>
    @endif

</div>
