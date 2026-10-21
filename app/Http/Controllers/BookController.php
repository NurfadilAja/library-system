<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category; // 1. Import model Category

class BookController extends Controller
{
    // READ - Menampilkan Daftar Buku
    public function index()
    {
        // 2. Gunakan eager loading with('category')
        $books = Book::with('category')->get(); 
        return view('books.index', compact('books'));
    }

    // CREATE - Menampilkan form tambah buku
    public function create()
    {
        // 3. Kirim data kategori yang diurutkan ke view create
        $categories = Category::orderBy('name')->get();
        return view('books.create', compact('categories'));
    }

    // STORE - Menyimpan data ke database dengan Validasi
    public function store(Request $request)
    {
        // 4. Tambahkan validasi category_id dengan aturan exists
        $validated = $request->validate([
            'title'       => 'required|string|min:3|max:255',
            'author'      => 'required|string|min:3|max:255',
            'year'        => 'required|integer|min:1900|max:' . date('Y'),
            'stock'       => 'required|integer|min:0|max:1000',
            'category_id' => 'required|exists:categories,id', 
        ]);

        Book::create($validated);

        return redirect()->route('books.index')
            ->with('success', 'Data buku berhasil ditambahkan.');
    }

    // READ DETAIL - Menampilkan detail 1 buku
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    // EDIT - Menampilkan form edit buku (Route Model Binding)
    public function edit(Book $book)
    {
        // 5. Kirim data kategori dan data buku ke view edit
        $categories = Category::orderBy('name')->get();
        return view('books.edit', compact('book', 'categories'));
    }

    // UPDATE - Menyimpan perubahan data ke database dengan Validasi
    public function update(Request $request, Book $book)
    {
        // 6. Tambahkan validasi category_id saat update
        $validated = $request->validate([
            'title'       => 'required|string|min:3|max:255',
            'author'      => 'required|string|min:3|max:255',
            'year'        => 'required|integer|min:1900|max:' . date('Y'),
            'stock'       => 'required|integer|min:0|max:1000',
            'category_id' => 'required|exists:categories,id',
        ]);

        $book->update($validated);

        return redirect()->route('books.index')
            ->with('success', 'Data buku berhasil diperbarui.');
    }

    // DELETE - Menghapus data buku
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Data buku berhasil dihapus.');
    }
}