<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    // READ - Menampilkan Daftar Buku
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    // CREATE - Menampilkan form tambah buku
    public function create()
    {
        return view('books.create');
    }

    // STORE - Menyimpan data ke database dengan Validasi
    public function store(Request $request)
    {
        // Validasi Request (menggabungkan rule standar dan rule tambahan)
        $validated = $request->validate([
            'title'  => 'required|string|min:3|max:255',
            'author' => 'required|string|min:3|max:255',
            'year'   => 'required|integer|min:1900|max:' . date('Y'),
            'stock'  => 'required|integer|min:0|max:1000',
        ]);

        Book::create($validated); // Menyimpan data tervalidasi

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
        return view('books.edit', compact('book'));
    }

    // UPDATE - Menyimpan perubahan data ke database dengan Validasi
    public function update(Request $request, Book $book)
    {
        // Validasi Request saat Update
        $validated = $request->validate([
            'title'  => 'required|string|min:3|max:255',
            'author' => 'required|string|min:3|max:255',
            'year'   => 'required|integer|min:1900|max:' . date('Y'),
            'stock'  => 'required|integer|min:0|max:1000',
        ]);

        $book->update($validated); // Memperbarui data tervalidasi

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