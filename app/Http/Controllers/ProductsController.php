<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsStoreRequest;
use App\Http\Requests\ProductsUpdateRequest;
use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $query = Products::with('kategori');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama_produk', 'like', "%{$search}%")
                    ->orWhere('kode_produk', 'like', "%{$search}%")
                    ->orWhereHas('kategori', function ($kategori) use ($search) {
                        $kategori->where('nama_kategori', 'like', "%{$search}%");
                    });
            });
        }

        // Filter kategori
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter tersedia
        if ($request->filled('tersedia')) {
            $query->where('tersedia', $request->boolean('tersedia'));
        }

        // Filter stok
        if ($request->filled('stok')) {
            if ($request->stok === 'habis') {
                $query->where('stok', 0);
            } elseif ($request->stok === 'menipis') {
                $query->whereBetween('stok', [1, 10]);
            } elseif ($request->stok === 'aman') {
                $query->where('stok', '>', 10);
            }
        }

        $produks = $query->latest()->paginate(6)->withQueryString();
        $kategoris = Categories::select('id', 'nama')->get();

        // Stats
        $stats = [
            'total' => Products::query()->count(),
            'tersedia' => Products::query()->where('tersedia', true)->count(),
            'stok_habis' => Products::query()->where('stok', 0)->count(),
            'stok_menipis' => Products::query()->whereBetween('stok', [1, 10])->count(),
        ];

        return view('produk.index', compact('produks', 'kategoris', 'stats'));
    }

    public function create()
    {
        $kategoris = Categories::all();
        return view('produk.create', compact('kategoris'));
    }

    public function store(ProductsStoreRequest $request)
    {
        $data = $request->validated();
        $data['tersedia'] = $request->boolean('tersedia');

        // Handle upload gambar
        if ($gambar = $this->uploadGambar($request)) {
            $data['gambar'] = $gambar;
        }

        Products::create($data);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    public function show(Products $produk)
    {
        $produk->load('kategori');
        $produkTerkait = Products::with('kategori')
            ->where('category_id', $produk->category_id)
            ->whereKeyNot($produk->id)
            ->take(4)
            ->get();

        return view('produk.show', compact('produk', 'produkTerkait'));
    }

    public function edit(Products $produk)
    {
        $kategoris = Categories::all();
        return view('produk.edit', compact('produk', 'kategoris'));
    }

    public function update(ProductsUpdateRequest $request, Products $produk)
    {
        $data = $request->validated();
        $data['tersedia'] = $request->boolean('tersedia');

        // Handle upload gambar baru
        if ($gambar = $this->uploadGambar($request)) {

            if ($produk->gambar) {
                Storage::disk('public')->delete('produk/' . $produk->gambar);
            }

            $data['gambar'] = $gambar;
        }

        $produk->update($data);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy(Products $produk)
    {
        // Hapus gambar
        if ($produk->gambar) {
            Storage::disk('public')->delete('produk/' . $produk->gambar);
        }

        $produk->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus');
    }

    private function uploadGambar($request): ?string
    {
        if (!$request->hasFile('gambar')) {
            return null;
        }

        $file = $request->file('gambar');

        $nama = Str::slug($request->nama_produk)
            . '-'
            . time()
            . '.'
            . $file->getClientOriginalExtension();

        $file->storeAs('produk', $nama, 'public');

        return $nama;
    }
}
