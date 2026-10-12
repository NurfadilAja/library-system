@extends('layouts.app')
@section('title', 'Detail Buku')
@section('content')
    <h2>Detail Buku</h2>
    
    <ul>
        <li><strong>Judul:</strong> {{ $book->title }}</li>
        <li><strong>Penulis:</strong> {{ $book->author }}</li>
        <li><strong>Tahun Terbit:</strong> {{ $book->year }}</li>
        <li><strong>Stok Tersedia:</strong> {{ $book->stock }}</li>
    </ul>

    <br>
    <a href="{{ route('books.index') }}">[Kembali ke Daftar Buku]</a>
@endsection