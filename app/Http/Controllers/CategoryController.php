<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // Jika tabel kategori masih kosong, isi dengan data default
        if (Category::count() === 0) {
            $defaults = ['Pendidikan', 'Fiksi', 'Komedi', 'Horror', 'Romantis'];
            foreach ($defaults as $name) {
                Category::create(['name' => $name]);
            }
        }

        $categories = Category::orderBy('name')->get();

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
}
