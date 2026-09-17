@extends('layouts.app')
@section('title', 'Detail Buku')
@section('content')
    <h2>Detail Buku</h2>
    <p><strong>Judul:</strong> {{ $book['title'] }}</p>
    <p><strong>Penulis:</strong> {{ $book['author'] }}</p>
    <p><strong>Tahun:</strong> {{ $book['year'] }}</p>
    <p><strong>Deskripsi:</strong> {{ $book['description'] }}</p>
    <a href="/books">Kembali ke Daftar Buku</a>
@endsection