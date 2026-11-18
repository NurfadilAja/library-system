@extends('layouts.app')
@section('title', 'Daftar Anggota')

@section('content')
    <h2>Daftar Anggota Perpustakaan</h2>

    @if (session('success'))
        <p style="color: green; font-weight: bold;">{{ session('success') }}</p>
    @endif

    {{-- Form Tambah Anggota --}}
    <details style="margin-bottom: 20px; border: 1px solid #ccc; padding: 10px; border-radius: 4px; max-width: 600px;">
        <summary style="cursor: pointer; font-weight: bold; color: blue;">[+ Tambah Anggota Baru]</summary>
        <form action="{{ route('members.store') }}" method="POST" style="margin-top: 15px;">
            @csrf
            <div>
                <label>Kode Anggota:</label><br>
                <input type="text" name="member_code" value="{{ old('member_code', 'M' . str_pad(App\Models\Member::count() + 1, 3, '0', STR_PAD_LEFT)) }}" required style="padding: 4px; width: 200px;">
                @error('member_code') <p style="color: red; font-size: 13px;">{{ $message }}</p> @enderror
            </div>
            <br>
            <div>
                <label>Nama Lengkap:</label><br>
                <input type="text" name="name" value="{{ old('name') }}" required style="padding: 4px; width: 300px;">
                @error('name') <p style="color: red; font-size: 13px;">{{ $message }}</p> @enderror
            </div>
            <br>
            <div>
                <label>No. Telepon / HP:</label><br>
                <input type="text" name="phone" value="{{ old('phone') }}" style="padding: 4px; width: 250px;">
                @error('phone') <p style="color: red; font-size: 13px;">{{ $message }}</p> @enderror
            </div>
            <br>
            <div>
                <label>Alamat:</label><br>
                <textarea name="address" rows="3" style="padding: 4px; width: 350px;">{{ old('address') }}</textarea>
                @error('address') <p style="color: red; font-size: 13px;">{{ $message }}</p> @enderror
            </div>
            <br>
            <button type="submit" style="padding: 6px 14px;">Simpan Anggota</button>
        </form>
    </details>

    {{-- Tabel Anggota --}}
    @if ($members->isEmpty())
        <p style="color: #666;">Belum ada data anggota.</p>
    @else
        <table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 800px;">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>No. Telepon</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($members as $member)
                    <tr>
                        <td><strong>{{ $member->member_code }}</strong></td>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->phone ?? '-' }}</td>
                        <td>{{ $member->address ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
