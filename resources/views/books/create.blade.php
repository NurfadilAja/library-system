@extends('layouts.app')
@section('title', 'Tambah Buku')
@section('content')
    <h2>Tambah Buku Baru</h2>
    <form action="{{ route('books.store') }}" method="POST">
        @csrf
        <label>Judul:</label> <input type="text" name="title"><br><br>
        <label>Penulis:</label> <input type="text" name="author"><br><br>
        <label>Tahun:</label> <input type="number" name="year"><br><br>
        <label>Stok:</label> <input type="number" name="stock"><br><br>
        <button type="submit">Simpan</button>
    </form>
@endsection