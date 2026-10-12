@extends('layouts.app')
@section('title', 'Edit Buku')
@section('content')
    <h2>Edit Buku</h2>
    <form action="{{ route('books.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Judul:</label> <input type="text" name="title" value="{{ $book->title }}"><br><br>
        <label>Penulis:</label> <input type="text" name="author" value="{{ $book->author }}"><br><br>
        <label>Tahun:</label> <input type="number" name="year" value="{{ $book->year }}"><br><br>
        <label>Stok:</label> <input type="number" name="stock" value="{{ $book->stock }}"><br><br>
        <button type="submit">Update</button>
    </form>
@endsection