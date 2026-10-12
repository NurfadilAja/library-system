<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book; // Jangan lupa import model Book

class BookController extends Controller
{
    // READ - Menampilkan Daftar Buku
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    // CREATE - Menampilkan form tambah
    public function create()
    {
        return view('books.create');
    }

    // STORE - Menyimpan data ke database
    public function store(Request $request)
    {
        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'year' => $request->year,
            'stock' => $request->stock,
        ]);
        return redirect()->route('books.index');
    }

    // UPDATE - Menampilkan form edit (Route Model Binding)
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    // UPDATE - Menyimpan perubahan ke database
    public function update(Request $request, Book $book)
    {
        $book->update([
            'title' => $request->title,
            'author' => $request->author,
            'year' => $request->year,
            'stock' => $request->stock,
        ]);
        return redirect()->route('books.index');
    }

    // DELETE - Menghapus data
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index');
    }

    // READ DETAIL - Menampilkan detail 1 buku
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }
}