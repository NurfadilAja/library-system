@extends('layouts.app')
@section('title', 'Edit Kategori')

@section('content')
    <h2>Edit Kategori</h2>

    <form action="{{ route('categories.update', $category->id) }}" method="POST" style="max-width: 400px;">
        @csrf
        @method('PUT')

        <div>
            <label for="name"><strong>Nama Kategori:</strong></label><br>
            <input
                type="text"
                name="name"
                id="name"
                value="{{ old('name', $category->name) }}"
                required
                style="width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box;"
            >
            @error('name')
                <p style="color: red; font-size: 13px; margin: 4px 0 0;">{{ $message }}</p>
            @enderror
        </div>

        <br>
        <button type="submit" style="background-color: #007bff; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer;">
            Update Kategori
        </button>
        <a href="{{ route('categories.index') }}" style="margin-left: 10px; color: #666; text-decoration: underline;">
            Kembali
        </a>
    </form>
@endsection
