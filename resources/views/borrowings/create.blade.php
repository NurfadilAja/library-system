@extends('layouts.app')
@section('title', 'Tambah Peminjaman')

@section('content')
    <h2>Tambah Transaksi Peminjaman Buku</h2>

    @if ($errors->any())
        <div style="background-color: #ffebee; border: 1px solid #ffcdd2; color: #c62828; padding: 10px; border-radius: 4px; margin-bottom: 15px; max-width: 500px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('borrowings.store') }}" method="POST" style="max-width: 500px;">
        @csrf

        {{-- Pilih Anggota --}}
        <div style="margin-bottom: 15px;">
            <label for="member_id"><strong>Pilih Anggota Perpustakaan:</strong></label><br>
            <select name="member_id" id="member_id" required style="width: 100%; padding: 8px; margin-top: 5px;">
                <option value="">-- Pilih Anggota --</option>
                @foreach ($members as $member)
                    <option value="{{ $member->id }}" @selected(old('member_id') == $member->id)>
                        {{ $member->member_code }} - {{ $member->name }}
                    </option>
                @endforeach
            </select>
            @error('member_id')
                <p style="color: red; font-size: 13px; margin: 2px 0 0;">{{ $message }}</p>
            @enderror
        </div>

        {{-- Pilih Buku --}}
        <div style="margin-bottom: 15px;">
            <label for="book_id"><strong>Pilih Buku:</strong></label><br>
            <select name="book_id" id="book_id" required style="width: 100%; padding: 8px; margin-top: 5px;">
                <option value="">-- Pilih Buku --</option>
                @foreach ($books as $book)
                    <option value="{{ $book->id }}" @selected(old('book_id') == $book->id) {{ $book->stock <= 0 ? 'disabled' : '' }}>
                        {{ $book->title }} (Stok: {{ $book->stock }}) {{ $book->stock <= 0 ? '[STOK HABIS]' : '' }}
                    </option>
                @endforeach
            </select>
            @error('book_id')
                <p style="color: red; font-size: 13px; margin: 2px 0 0;">{{ $message }}</p>
            @enderror
        </div>

        {{-- Jumlah Buku --}}
        <div style="margin-bottom: 15px;">
            <label for="quantity"><strong>Jumlah Pinjam:</strong></label><br>
            <input type="number" name="quantity" id="quantity" value="{{ old('quantity', 1) }}" min="1" required style="width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box;">
            @error('quantity')
                <p style="color: red; font-size: 13px; margin: 2px 0 0;">{{ $message }}</p>
            @enderror
        </div>

        <div style="margin-top: 20px;">
            <button type="submit" style="background-color: #007bff; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer; font-size: 14px;">
                Simpan Transaksi Peminjaman
            </button>
            <a href="{{ route('borrowings.index') }}" style="margin-left: 10px; color: #666; text-decoration: underline;">
                Batal & Kembali
            </a>
        </div>
    </form>
@endsection
