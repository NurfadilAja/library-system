<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $fiksi      = Category::where('name', 'Fiksi')->first();
        $komedi     = Category::where('name', 'Komedi')->first();
        $horror     = Category::where('name', 'Horror')->first();
        $romantis   = Category::where('name', 'Romantis')->first();
        $pendidikan = Category::where('name', 'Pendidikan')->first();

        $books = [
            ['title' => 'Harry Potter: The power of stone', 'author' => 'J.K Rowling',   'year' => 1999, 'stock' => 5, 'category_id' => $fiksi?->id],
            ['title' => 'Si Juki Cari Kerja',               'author' => 'Faza Meonk',    'year' => 2015, 'stock' => 3, 'category_id' => $komedi?->id],
            ['title' => 'Kambing Jantan',                   'author' => 'Raditya Dika',  'year' => 2001, 'stock' => 0, 'category_id' => $komedi?->id],
            ['title' => 'Vila Teratai',                     'author' => 'Nanda Hime',    'year' => 2019, 'stock' => 8, 'category_id' => $romantis?->id],
            ['title' => 'Pemrograman Berorientasi Objek',   'author' => 'Eko',           'year' => 2023, 'stock' => 2, 'category_id' => $pendidikan?->id],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
