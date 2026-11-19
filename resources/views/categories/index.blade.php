@extends('layouts.app')
@section('title', 'Daftar Kategori')

@section('content')
    <h2>Daftar Kategori Buku</h2>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <p style="color: green; font-weight: bold; background-color: #e8f5e9; padding: 10px; border-radius: 4px; border: 1px solid #c8e6c9;">
            {{ session('success') }}
        </p>
    @endif

    {{-- Notifikasi error --}}
    @if(session('error'))
        <p style="color: red; font-weight: bold; background-color: #ffebee; padding: 10px; border-radius: 4px; border: 1px solid #ffcdd2;">
            {{ session('error') }}
        </p>
    @endif

    {{-- Form Tambah Kategori --}}
    <form action="{{ route('categories.store') }}" method="POST" style="margin-bottom: 20px;">
        @csrf
        <label><strong>Tambah Kategori Baru:</strong></label><br>
        <input
            type="text"
            name="name"
            value="{{ old('name') }}"
            placeholder="Nama kategori..."
            style="padding: 6px 10px; width: 250px; margin-top: 5px;"
            required
        >
        <button type="submit" style="padding: 6px 14px; margin-left: 6px; cursor: pointer;">+ Tambah</button>
        @error('name')
            <p style="color: red; font-size: 13px; margin-top: 4px;">{{ $message }}</p>
        @enderror
    </form>

    <hr>

    {{-- Tabel Kategori --}}
    @if($categories->isEmpty())
        <p style="color: #888;">Belum ada data kategori.</p>
    @else
        <table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 600px; margin-top: 15px;">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th style="width: 50px; text-align: center;">No</th>
                    <th>Nama Kategori</th>
                    <th style="text-align: center; width: 120px;">Jumlah Buku</th>
                    <th style="text-align: center; width: 140px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $index => $category)
                    <tr>
                        <td style="text-align: center;">{{ $index + 1 }}</td>
                        <td><strong>{{ $category->name }}</strong></td>
                        <td style="text-align: center;">{{ $category->books_count ?? 0 }} buku</td>
                        <td style="text-align: center;">
                            <a href="{{ route('categories.edit', $category->id) }}" style="color: blue;">Edit</a> |
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori {{ $category->name }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: none; border: none; color: red; cursor: pointer; text-decoration: underline; padding: 0;">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
