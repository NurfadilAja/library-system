@extends('layouts.app')
@section('title', 'Daftar Anggota')

@section('content')
    <h2>Daftar Anggota Perpustakaan</h2>

    @if (!empty($needsMigration))
        <div style="background-color: #fff3cd; border: 1px solid #ffeeba; color: #856404; padding: 12px; border-radius: 6px; margin-bottom: 20px;">
            <strong>⚠️ Perhatian:</strong> Tabel <code>members</code> belum dibuat di MySQL Anda.
            <br>
            Silakan buka terminal dan jalankan perintah: <code>php artisan migrate</code>
        </div>
    @endif

    {{-- Notifikasi sukses --}}
    @if (session('success'))
        <p style="color: green; font-weight: bold; background-color: #e8f5e9; padding: 10px; border-radius: 4px; border: 1px solid #c8e6c9;">
            {{ session('success') }}
        </p>
    @endif

    {{-- Notifikasi error --}}
    @if (session('error'))
        <p style="color: red; font-weight: bold; background-color: #ffebee; padding: 10px; border-radius: 4px; border: 1px solid #ffcdd2;">
            {{ session('error') }}
        </p>
    @endif

    {{-- Form Tambah Anggota --}}
    <details style="margin-bottom: 20px; border: 1px solid #ccc; padding: 10px; border-radius: 4px; max-width: 600px;">
        <summary style="cursor: pointer; font-weight: bold; color: blue;">[+ Tambah Anggota Baru]</summary>
        <form action="{{ route('members.store') }}" method="POST" style="margin-top: 15px;">
            @csrf
            <div>
                <label>Kode Anggota:</label><br>
                <input type="text" name="member_code" value="{{ old('member_code', 'M' . str_pad($members->count() + 1, 3, '0', STR_PAD_LEFT)) }}" required style="padding: 4px; width: 200px;">
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
            <button type="submit" style="padding: 6px 14px; cursor: pointer;">Simpan Anggota</button>
        </form>
    </details>

    {{-- Tabel Anggota --}}
    @if ($members->isEmpty())
        <p style="color: #666;">Belum ada data anggota.</p>
    @else
        <table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 900px;">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>No. Telepon</th>
                    <th>Alamat</th>
                    <th style="text-align: center; width: 140px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($members as $member)
                    <tr>
                        <td><strong>{{ $member->member_code }}</strong></td>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->phone ?? '-' }}</td>
                        <td>{{ $member->address ?? '-' }}</td>
                        <td style="text-align: center;">
                            <a href="{{ route('members.edit', $member->id) }}" style="color: blue;">Edit</a> |
                            <form action="{{ route('members.destroy', $member->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data anggota {{ $member->name }}?')">
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
