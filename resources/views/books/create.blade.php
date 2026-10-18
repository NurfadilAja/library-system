@extends('layouts.app')
@section('title', 'Tambah Buku')

@section('content')
    <h2>Tambah Buku Baru</h2>
    <form action="{{ route('books.store') }}" method="POST">
        @csrf
        
        {{-- Input Judul --}}
        <label>Judul:</label><br>
        <input type="text" name="title" value="{{ old('title') }}">
        @error('title')
            <p style="color: red; font-size: 14px; margin-top: 2px;">{{ $message }}</p>
        @enderror
        <br><br>

        {{-- Input Penulis --}}
        <label>Penulis:</label><br>
        <input type="text" name="author" value="{{ old('author') }}">
        @error('author')
            <p style="color: red; font-size: 14px; margin-top: 2px;">{{ $message }}</p>
        @enderror
        <br><br>

        {{-- Input Tahun --}}
        <label>Tahun:</label><br>
        <input type="number" name="year" value="{{ old('year') }}">
        @error('year')
            <p style="color: red; font-size: 14px; margin-top: 2px;">{{ $message }}</p>
        @enderror
        <br><br>

        {{-- Input Stok --}}
        <label>Stok:</label><br>
        <input type="number" name="stock" value="{{ old('stock') }}">
        @error('stock')
            <p style="color: red; font-size: 14px; margin-top: 2px;">{{ $message }}</p>
        @enderror
        <br><br>

        <button type="submit">Simpan</button>
    </form>
@endsection