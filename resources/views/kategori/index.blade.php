@extends('layouts.app')

@section('page', 'Kategori')

@section('content')

<div class="max-w-7xl lg:px-8">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 animate-fade-in-up">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Kategori</h1>
            <p class="text-gray-400 mt-1">Kelola kategori produk warung</p>
        </div>
        <button onclick="openModal()"
                class="inline-flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-xl font-medium transition-all duration-200 shadow-lg shadow-green-200 hover:shadow-xl hover:shadow-green-300 hover:-translate-y-0.5 animate-fade-in-up delay-100">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <span>Tambah Kategori</span>
        </button>
    </div>

    {{-- Search & Filter --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 mb-6 animate-slide-left">
        <div class="p-4 md:p-6 border-b border-gray-100">
            <form method="GET" action="{{ route('kategori.index') }}" class="flex flex-col md:flex-row gap-3">

                {{-- Search --}}
                <div class="flex-1 relative">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text"
                           name="search"
                           placeholder="Cari kategori..."
                           value="{{ request('search') }}"
                           class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all">
                </div>

                {{-- Reset Button --}}
                @if(request('search') || request('status'))
                <a href="{{ route('kategori.index') }}"
                   class="px-4 py-3 border border-gray-200 rounded-xl hover:bg-gray-50 text-gray-600 transition-colors flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    <span>Reset</span>
                </a>
                @endif
            </form>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-4">
                            Nama Kategori
                        </th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-4">
                            Slug
                        </th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-4 hidden md:table-cell">
                            Dibuat
                        </th>
                        <th class="text-right text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-4">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">

                    @forelse($kategoris as $kategori)
                    <tr class="hover:bg-green-50/50 transition-colors group animate-fade-in">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $kategori->nama }}</p>
                                    <p class="text-xs text-gray-400 sm:hidden">{{ $kategori->slug }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <code class="text-sm text-gray-600 bg-gray-100 px-2 py-1 rounded">{{ $kategori->slug }}</code>
                        </td>
                        <td class="px-6 py-4 hidden md:table-cell">
                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>{{ $kategori->created_at->format('d M Y') }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-2">
                                {{-- Edit Button --}}
                                <button onclick="openModal({{ $kategori->id }}, '{{ $kategori->nama }}', '{{ $kategori->slug }}')"
                                        class="w-9 h-9 rounded-lg hover:bg-blue-50 flex items-center justify-center text-gray-400 hover:text-blue-600 transition-colors"
                                        title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </button>

                                {{-- Delete Button --}}
                                <button onclick="confirmDelete({{ $kategori->id }}, '{{ $kategori->nama }}')"
                                        class="w-9 h-9 rounded-lg hover:bg-red-50 flex items-center justify-center text-gray-400 hover:text-red-600 transition-colors"
                                        title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <p class="text-gray-500 font-medium">Tidak ada kategori ditemukan</p>
                                <p class="text-gray-400 text-sm mt-1">Coba ubah kata kunci pencarian</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($kategoris->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="text-sm text-gray-500">
                    Menampilkan {{ $kategoris->firstItem() }} - {{ $kategoris->lastItem() }} dari {{ $kategoris->total() }} kategori
                </div>

                <div class="flex items-center gap-2">
                    {{-- Previous --}}
                    @if($kategoris->onFirstPage())
                    <button disabled class="px-3 py-2 rounded-lg border border-gray-200 text-gray-400 cursor-not-allowed">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>
                    @else
                    <a href="{{ $kategoris->previousPageUrl() }}" class="px-3 py-2 rounded-lg border border-gray-200 hover:bg-gray-50 text-gray-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>
                    @endif

                    {{-- Page Numbers --}}
                    @foreach($kategoris->getUrlRange(1, $kategoris->lastPage()) as $page => $url)
                        @if($page == $kategoris->currentPage())
                        <span class="px-3 py-2 rounded-lg bg-green-600 text-white font-medium">{{ $page }}</span>
                        @else
                        <a href="{{ $url }}" class="px-3 py-2 rounded-lg border border-gray-200 hover:bg-gray-50 text-gray-600 transition-colors">{{ $page }}</a>
                        @endif
                    @endforeach

                    {{-- Next --}}
                    @if($kategoris->hasMorePages())
                    <a href="{{ $kategoris->nextPageUrl() }}" class="px-3 py-2 rounded-lg border border-gray-200 hover:bg-gray-50 text-gray-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                    @else
                    <button disabled class="px-3 py-2 rounded-lg border border-gray-200 text-gray-400 cursor-not-allowed">
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

{{-- Modal Tambah/Edit Kategori --}}
<div id="kategoriModal" class="fixed inset-0 z-50 hidden">
    {{-- Overlay --}}
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm transition-opacity" onclick="closeModal()"></div>

    {{-- Modal Content --}}
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md animate-scale-in">

            {{-- Modal Header --}}
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-800" id="modalTitle">Tambah Kategori</h3>
                        <p class="text-sm text-gray-400">Isi detail kategori</p>
                    </div>
                </div>
                <button onclick="closeModal()" class="w-8 h-8 rounded-lg hover:bg-gray-100 flex items-center justify-center text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Modal Body --}}
            <form id="kategoriForm" method="POST" action="{{ route('kategori.store') }}" class="p-6">
                @csrf
                <input type="hidden" id="kategoriId" name="id">

                <div class="space-y-4">
                    {{-- Nama Kategori --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kategori</label>
                        <input type="text"
                               id="namaKategori"
                               name="nama"
                               required
                               placeholder="Masukkan nama kategori"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all">
                    </div>

                    {{-- Slug --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
                        <input type="text"
                               id="slugKategori"
                               name="slug"
                               required
                               placeholder="slug-kategori"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all bg-gray-50">
                        <p class="text-xs text-gray-400 mt-1">Slug akan otomatis dibuat dari nama</p>
                    </div>

                </div>

                {{-- Modal Footer --}}
                <div class="flex items-center gap-3 mt-6 pt-6 border-t border-gray-100">
                    <button type="button"
                            onclick="closeModal()"
                            class="flex-1 px-4 py-3 border border-gray-200 rounded-xl hover:bg-gray-50 text-gray-700 font-medium transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                            class="flex-1 px-4 py-3 bg-green-600 hover:bg-green-700 text-white rounded-xl font-medium transition-colors shadow-lg shadow-green-200">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Delete Confirmation Modal --}}
<div id="deleteModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeDeleteModal()"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm animate-scale-in">
            <div class="p-6 text-center">
                <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Hapus Kategori?</h3>
                <p class="text-gray-500 text-sm mb-6">Apakah Anda yakin ingin menghapus kategori <span id="deleteKategoriNama" class="font-semibold"></span>? Tindakan ini tidak dapat dibatalkan.</p>

                <form id="deleteForm" method="POST" class="flex gap-3">
                    @csrf
                    @method('DELETE')
                    <button type="button"
                            onclick="closeDeleteModal()"
                            class="flex-1 px-4 py-3 border border-gray-200 rounded-xl hover:bg-gray-50 text-gray-700 font-medium transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                            class="flex-1 px-4 py-3 bg-red-600 hover:bg-red-700 text-white rounded-xl font-medium transition-colors">
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
    // Auto generate slug from nama
    document.getElementById('namaKategori').addEventListener('input', function(e) {
        const nama = e.target.value;
        const slug = nama
            .toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');
        document.getElementById('slugKategori').value = slug;
    });

    // Open modal untuk tambah/edit
    function openModal(id = null, nama = '', slug = '') {
        const modal = document.getElementById('kategoriModal');
        const title = document.getElementById('modalTitle');
        const form = document.getElementById('kategoriForm');

        if (id) {
            // Edit mode
            title.textContent = 'Edit Kategori';
            document.getElementById('kategoriId').value = id;
            document.getElementById('namaKategori').value = nama;
            document.getElementById('slugKategori').value = slug;
            form.action = `/kategori/${id}`;

            // Tambah method PUT
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PUT';
            form.appendChild(methodInput);
        } else {
            // Tambah mode
            title.textContent = 'Tambah Kategori';
            form.reset();
            document.getElementById('kategoriId').value = '';
            form.action = "{{ route('kategori.store') }}";

            // Hapus method PUT jika ada
            const methodInput = form.querySelector('input[name="_method"]');
            if (methodInput) methodInput.remove();
        }

        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    // Close modal
    function closeModal() {
        const modal = document.getElementById('kategoriModal');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Confirm delete
    function confirmDelete(id, nama) {
        const modal = document.getElementById('deleteModal');
        document.getElementById('deleteKategoriNama').textContent = nama;
        document.getElementById('deleteForm').action = `/kategori/${id}`;
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    // Close delete modal
    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Close modal dengan ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
            closeDeleteModal();
        }
    });
</script>
@endpush
