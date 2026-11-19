<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class CategoryController extends Controller
{
    public function index()
    {
        if (!Schema::hasTable('categories')) {
            $categories = collect();
            return view('categories.index', compact('categories'));
        }

        // Jika tabel kategori masih kosong, isi dengan data default
        if (Category::count() === 0) {
            $defaults = ['Pendidikan', 'Fiksi', 'Komedi', 'Horror', 'Romantis'];
            foreach ($defaults as $name) {
                Category::create(['name' => $name]);
            }
        }

        $categories = Category::withCount('books')->orderBy('name')->get();

        return view('categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2|max:100|unique:categories,name',
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.min'      => 'Nama kategori minimal 2 karakter.',
            'name.unique'   => 'Kategori dengan nama tersebut sudah ada.',
        ]);

        Category::create(['name' => $request->name]);

        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|min:2|max:100|unique:categories,name,' . $category->id,
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.min'      => 'Nama kategori minimal 2 karakter.',
            'name.unique'   => 'Kategori dengan nama tersebut sudah ada.',
        ]);

        $category->update(['name' => $request->name]);

        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category)
    {
        // Cegah penghapusan jika masih ada buku yang berkategori ini
        if ($category->books()->exists()) {
            return back()->with('error', 'Kategori "' . $category->name . '" tidak dapat dihapus karena masih digunakan oleh ' . $category->books()->count() . ' buku.');
        }

        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
