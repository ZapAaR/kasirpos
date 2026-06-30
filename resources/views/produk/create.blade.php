@extends('layouts.app')

@section('page', 'Produk')

@section('content')

<div class="max-w-5xl mx-auto">

    {{-- Header --}}
    <div class="flex items-center gap-4 mb-6 animate-fade-in-up">
        <a href="{{ route('produk.index') }}"
           class="w-10 h-10 rounded-xl bg-white border border-gray-200 hover:bg-gray-50 flex items-center justify-center text-gray-600 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </a>
        <div class="flex-1">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Tambah Produk Baru</h1>
            <p class="text-gray-400 mt-1">Isi detail produk yang akan ditambahkan</p>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 animate-slide-left">
        <form method="POST" action="{{ route('produk.store') }}" enctype="multipart/form-data" class="p-6 md:p-8">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Left Column - Main Info --}}
                <div class="lg:col-span-2 space-y-6">

                    {{-- Nama Produk --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Produk <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               name="nama_produk"
                               value="{{ old('nama_produk') }}"
                               required
                               placeholder="Contoh: Sate Usus"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all bg-gray-50 focus:bg-white @error('nama_produk') border-red-500 @enderror">
                        @error('nama_produk')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Kategori --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <select name="category_id"
                                required
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 bg-white text-gray-600 cursor-pointer hover:border-green-300 transition-colors @error('category_id') border-red-500 @enderror">
                            <option value="">Pilih Kategori</option>
                            @foreach($kategoris as $kat)
                            <option value="{{ $kat->id }}" {{ old('category_id') == $kat->id ? 'selected' : '' }}>
                                {{ $kat->nama }}
                            </option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Harga Grid --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Harga Modal <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 font-medium">Rp</span>
                                <input type="number"
                                       name="harga_modal"
                                       value="{{ old('harga_modal') }}"
                                       required
                                       min="0"
                                       step="100"
                                       placeholder="0"
                                       class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all bg-gray-50 focus:bg-white @error('harga_modal') border-red-500 @enderror">
                            </div>
                            @error('harga_modal')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Harga Jual <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 font-medium">Rp</span>
                                <input type="number"
                                       name="harga_jual"
                                       value="{{ old('harga_jual') }}"
                                       required
                                       min="0"
                                       step="100"
                                       placeholder="0"
                                       class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all bg-gray-50 focus:bg-white @error('harga_jual') border-red-500 @enderror">
                            </div>
                            @error('harga_jual')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Keuntungan Preview --}}
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-100 rounded-xl p-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Estimasi Keuntungan</p>
                                    <p class="text-xs text-gray-400">Per unit produk</p>
                                </div>
                            </div>
                            <p class="text-2xl font-bold text-green-700" id="keuntunganPreview">Rp 0</p>
                        </div>
                    </div>

                    {{-- Stok --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Stok <span class="text-red-500">*</span>
                        </label>
                        <input type="number"
                               name="stok"
                               value="{{ old('stok', 0) }}"
                               required
                               min="0"
                               placeholder="0"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all bg-gray-50 focus:bg-white @error('stok') border-red-500 @enderror">
                        @error('stok')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tersedia Toggle --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Status Ketersediaan</label>
                        <label class="flex items-center gap-4 cursor-pointer group">
                            <div class="relative">
                                <input type="checkbox"
                                       name="tersedia"
                                       value="1"
                                       {{ old('tersedia', true) ? 'checked' : '' }}
                                       class="sr-only peer">
                                <div class="w-14 h-8 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-100 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-green-600"></div>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800 group-hover:text-green-700 transition-colors">Tersedia untuk dijual</p>
                                <p class="text-xs text-gray-400">Produk akan muncul di daftar kasir</p>
                            </div>
                        </label>
                    </div>

                </div>

                {{-- Right Column - Gambar --}}
                <div class="space-y-6">

                    {{-- Upload Gambar --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Gambar Produk
                        </label>
                        <div class="relative">
                            <input type="file"
                                   name="gambar"
                                   id="gambarInput"
                                   accept="image/*"
                                   class="hidden"
                                   onchange="previewImage(event)">

                            <label for="gambarInput"
                                   id="uploadArea"
                                   class="block aspect-square border-2 border-dashed border-gray-200 rounded-2xl cursor-pointer hover:border-green-400 hover:bg-green-50/30 transition-all group overflow-hidden">

                                {{-- Default State --}}
                                <div id="uploadDefault" class="absolute inset-0 flex flex-col items-center justify-center p-6">
                                    <div class="w-16 h-16 rounded-2xl bg-green-50 group-hover:bg-green-100 flex items-center justify-center mb-3 transition-colors">
                                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <p class="text-sm font-medium text-gray-700 mb-1">Klik untuk upload</p>
                                    <p class="text-xs text-gray-400 text-center">PNG, JPG, WEBP (Max 2MB)</p>
                                </div>

                                {{-- Preview Image --}}
                                <img id="imagePreview" class="absolute inset-0 w-full h-full object-cover hidden">

                                {{-- Remove Button --}}
                                <button type="button"
                                        id="removeImage"
                                        onclick="removeImage(event)"
                                        class="absolute top-3 right-3 w-8 h-8 rounded-lg bg-red-500 hover:bg-red-600 text-white flex items-center justify-center shadow-lg hidden z-10">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </label>
                        </div>
                        @error('gambar')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Info Card --}}
                    <div class="bg-blue-50 border border-blue-100 rounded-xl p-4">
                        <div class="flex gap-3">
                            <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <p class="text-sm font-semibold text-blue-800 mb-1">Tips</p>
                                <ul class="text-xs text-blue-600 space-y-1">
                                    <li>• Gunakan gambar berkualitas tinggi</li>
                                    <li>• Rasio 1:1 (persegi) direkomendasikan</li>
                                    <li>• Ukuran maksimal 2MB</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            {{-- Form Actions --}}
            <div class="flex flex-col sm:flex-row items-center gap-3 mt-8 pt-6 border-t border-gray-100">
                <a href="{{ route('produk.index') }}"
                   class="w-full sm:w-auto px-6 py-3 border-2 border-gray-200 rounded-xl hover:bg-gray-50 text-gray-700 font-semibold transition-colors text-center">
                    Batal
                </a>
                <button type="submit"
                        class="w-full sm:flex-1 px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white rounded-xl font-semibold transition-all shadow-lg shadow-green-200 hover:shadow-xl hover:shadow-green-300 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Produk
                </button>
            </div>

        </form>
    </div>

</div>

@endsection

@push('scripts')
<script>
    // Preview image
    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').src = e.target.result;
                document.getElementById('imagePreview').classList.remove('hidden');
                document.getElementById('uploadDefault').classList.add('hidden');
                document.getElementById('removeImage').classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    }

    function removeImage(event) {
        event.preventDefault();
        event.stopPropagation();
        document.getElementById('gambarInput').value = '';
        document.getElementById('imagePreview').classList.add('hidden');
        document.getElementById('uploadDefault').classList.remove('hidden');
        document.getElementById('removeImage').classList.add('hidden');
    }

    // Keuntungan preview
    const hargaModal = document.querySelector('input[name="harga_modal"]');
    const hargaJual = document.querySelector('input[name="harga_jual"]');
    const keuntunganPreview = document.getElementById('keuntunganPreview');

    function updateKeuntungan() {
        const modal = parseFloat(hargaModal.value) || 0;
        const jual = parseFloat(hargaJual.value) || 0;
        const keuntungan = jual - modal;
        keuntunganPreview.textContent = 'Rp ' + keuntungan.toLocaleString('id-ID');
    }

    hargaModal.addEventListener('input', updateKeuntungan);
    hargaJual.addEventListener('input', updateKeuntungan);
</script>
@endpush
