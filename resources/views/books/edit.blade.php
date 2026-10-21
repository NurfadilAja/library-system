@extends('layouts.app')
@section('title', 'Edit Buku')

@section('content')
    <h2>Edit Buku</h2>
    <form action="{{ route('books.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        {{-- Input Judul --}}
        <label>Judul:</label><br>
        <input type="text" name="title" value="{{ old('title', $book->title) }}">
        @error('title')
            <p style="color: red; font-size: 14px; margin-top: 2px;">{{ $message }}</p>
        @enderror
        <br><br>

        {{-- Input Penulis --}}
        <label>Penulis:</label><br>
        <input type="text" name="author" value="{{ old('author', $book->author) }}">
        @error('author')
            <p style="color: red; font-size: 14px; margin-top: 2px;">{{ $message }}</p>
        @enderror
        <br><br>

        {{-- Input Kategori --}}
        <label>Kategori:</label><br>
        <select name="category_id">
            <option value="">Pilih kategori</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $book->category_id) == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <p style="color: red; font-size: 14px; margin-top: 2px;">{{ $message }}</p>
        @enderror
        <br><br>

        {{-- Input Tahun --}}
        <label>Tahun:</label><br>
        <input type="number" name="year" value="{{ old('year', $book->year) }}">
        @error('year')
            <p style="color: red; font-size: 14px; margin-top: 2px;">{{ $message }}</p>
        @enderror
        <br><br>

        {{-- Input Stok --}}
        <label>Stok:</label><br>
        <input type="number" name="stock" value="{{ old('stock', $book->stock) }}">
        @error('stock')
            <p style="color: red; font-size: 14px; margin-top: 2px;">{{ $message }}</p>
        @enderror
        <br><br>

        <button type="submit">Update</button>
        <a href="{{ route('books.index') }}" style="margin-left: 10px;">Kembali</a>
    </form>
@endsection