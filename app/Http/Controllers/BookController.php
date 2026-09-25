<?php

namespace App\Http\Controllers;

use App\Models\Book; // 1. Wajib tambahkan ini untuk memanggil Model Book

class BookController extends Controller
{
    public function index()
    {
        // 2. Ganti array statis lama dengan baris ini agar mengambil data dari database
        $books = Book::all();

        return view('books.index', compact('books'));
    }

    public function show($id)
    {
        // Mengambil 1 buku berdasarkan ID dari database
        $book = Book::findOrFail($id);
        
        return view('books.show', compact('book'));
    }
}