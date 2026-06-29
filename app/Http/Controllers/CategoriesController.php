<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriesStoreRequest;
use App\Http\Requests\CategoriesUpdateRequest;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(Request $request)
    {
        $query = Categories::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%");
            });
        }
        $kategoris = $query->latest()->paginate(4);

        return view('kategori.index', compact('kategoris'));
    }

    public function store(CategoriesStoreRequest $request)
    {
        $data = $request->validated();

        Categories::create($data);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update(CategoriesUpdateRequest $request, Categories $kategori)
    {
        $data = $request->validated();

        $kategori->update($data);

        return redirect()->back()->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Categories $kategori)
    {
        $kategori->delete();

        return redirect()->back()->with('success', 'Kategori berhasil dihapus.');
    }
}
