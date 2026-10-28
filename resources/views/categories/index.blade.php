@extends('layouts.app')
@section('title', 'Daftar Kategori')

@section('content')
    <h2>Daftar Kategori</h2>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <p style="color: green; font-weight: bold;">{{ session('success') }}</p>
    @endif

    {{-- Form Tambah Kategori --}}
    <form action="{{ route('categories.store') }}" method="POST" style="margin-bottom: 16px;">
        @csrf
        <label><strong>Tambah Kategori Baru:</strong></label><br>
        <input
            type="text"
            name="name"
            value="{{ old('name') }}"
            placeholder="Nama kategori..."
            style="padding: 4px 8px; width: 220px;"
        >
        <button type="submit" style="padding: 4px 12px; margin-left: 6px;">+ Tambah</button>
        @error('name')
            <p style="color: red; font-size: 13px; margin-top: 4px;">{{ $message }}</p>
        @enderror
    </form>

    <hr>

    {{-- Daftar Kategori --}}
    @if($categories->isEmpty())
        <p style="color: #888;">Belum ada kategori.</p>
    @else
        <ul>
            @foreach($categories as $category)
                <li>{{ $category->name }}</li>
            @endforeach
        </ul>
    @endif
@endsection
