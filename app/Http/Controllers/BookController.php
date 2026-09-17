<?php

namespace App\Http\Controllers;

class BookController extends Controller
{
    public function index()
    {
        $books = [
            ['id' => 1, 'title' => 'Harry Potter: The power of stone', 'author' => 'J.K Rowling', 'year' => 1999, 'stock' => 5],
            ['id' => 2, 'title' => 'Si Juki Cari Kerja', 'author' => 'Faza Meonk', 'year' => 2015, 'stock' => 3],
            ['id' => 3, 'title' => 'Kambing Jantan', 'author' => 'Raditya Dika', 'year' => 2001, 'stock' => 0],
            ['id' => 4, 'title' => 'Vila Teratai', 'author' => 'Nanda Hime', 'year' => 2019, 'stock' => 8],
            ['id' => 5, 'title' => 'Pemrograman Berorientasi Objek', 'author' => 'Eko', 'year' => 2023, 'stock' => 2],
        ];

        return view('books.index', compact('books'));
    }

    public function show($id)
    {
        $book = [
            'id' => $id,
            'title' => 'Buku Sampel ID ' . $id,
            'author' => 'Penulis Sampel',
            'year' => 2024,
            'description' => 'Ini adalah halaman deskripsi lengkap untuk buku dengan ID: ' . $id
        ];

        return view('books.show', compact('book'));
    }
}