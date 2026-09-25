<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            ['title' => 'Harry Potter: The power of stone', 'author' => 'J.K Rowling', 'year' => 1999, 'stock' => 5],
            ['title' => 'Si Juki Cari Kerja', 'author' => 'Faza Meonk', 'year' => 2015, 'stock' => 3],
            ['title' => 'Kambing Jantan', 'author' => 'Raditya Dika', 'year' => 2001, 'stock' => 0],
            ['title' => 'Vila Teratai', 'author' => 'Nanda Hime', 'year' => 2019, 'stock' => 8],
            ['title' => 'Pemrograman Berorientasi Objek', 'author' => 'Eko', 'year' => 2023, 'stock' => 2],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}