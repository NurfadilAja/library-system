@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    <h2>Dashboard Perpustakaan</h2>
    <p>Selamat datang di Sistem Informasi Perpustakaan, <strong>{{ auth()->user()->name }}</strong> (Role: <em>{{ ucfirst(auth()->user()->role) }}</em>).</p>

    {{-- Ringkasan Statistik --}}
    <div style="display: flex; gap: 15px; flex-wrap: wrap; margin-bottom: 30px;">
        <div style="border: 1px solid #ddd; border-left: 5px solid #007bff; border-radius: 6px; padding: 15px; width: 170px; background: #fafafa;">
            <div style="color: #666; font-size: 13px; text-transform: uppercase;">Total Buku</div>
            <div style="font-size: 28px; font-weight: bold; color: #007bff; margin: 5px 0;">{{ $totalBooks }}</div>
            <a href="{{ route('books.index') }}" style="font-size: 13px; color: #007bff; text-decoration: none;">Lihat Buku &rarr;</a>
        </div>

        <div style="border: 1px solid #ddd; border-left: 5px solid #17a2b8; border-radius: 6px; padding: 15px; width: 170px; background: #fafafa;">
            <div style="color: #666; font-size: 13px; text-transform: uppercase;">Total Kategori</div>
            <div style="font-size: 28px; font-weight: bold; color: #17a2b8; margin: 5px 0;">{{ $totalCategories }}</div>
            <a href="{{ route('categories.index') }}" style="font-size: 13px; color: #17a2b8; text-decoration: none;">Lihat Kategori &rarr;</a>
        </div>

        <div style="border: 1px solid #ddd; border-left: 5px solid #6f42c1; border-radius: 6px; padding: 15px; width: 170px; background: #fafafa;">
            <div style="color: #666; font-size: 13px; text-transform: uppercase;">Total Anggota</div>
            <div style="font-size: 28px; font-weight: bold; color: #6f42c1; margin: 5px 0;">{{ $totalMembers }}</div>
            <a href="{{ route('members.index') }}" style="font-size: 13px; color: #6f42c1; text-decoration: none;">Lihat Anggota &rarr;</a>
        </div>

        <div style="border: 1px solid #ddd; border-left: 5px solid #ffc107; border-radius: 6px; padding: 15px; width: 170px; background: #fafafa;">
            <div style="color: #666; font-size: 13px; text-transform: uppercase;">Total Transaksi</div>
            <div style="font-size: 28px; font-weight: bold; color: #d39e00; margin: 5px 0;">{{ $totalBorrowings }}</div>
            <a href="{{ route('borrowings.index') }}" style="font-size: 13px; color: #d39e00; text-decoration: none;">Lihat Transaksi &rarr;</a>
        </div>

        <div style="border: 1px solid #ddd; border-left: 5px solid #fd7e14; border-radius: 6px; padding: 15px; width: 170px; background: #fafafa;">
            <div style="color: #666; font-size: 13px; text-transform: uppercase;">Sedang Dipinjam</div>
            <div style="font-size: 28px; font-weight: bold; color: #fd7e14; margin: 5px 0;">{{ $activeBorrowings }}</div>
            <span style="font-size: 13px; color: #888;">Buku di tangan anggota</span>
        </div>

        <div style="border: 1px solid #ddd; border-left: 5px solid #28a745; border-radius: 6px; padding: 15px; width: 170px; background: #fafafa;">
            <div style="color: #666; font-size: 13px; text-transform: uppercase;">Sudah Kembali</div>
            <div style="font-size: 28px; font-weight: bold; color: #28a745; margin: 5px 0;">{{ $returnedBorrowings }}</div>
            <span style="font-size: 13px; color: #888;">Transaksi selesai</span>
        </div>
    </div>

    {{-- Riwayat Transaksi Terbaru --}}
    <h3>Transaksi Peminjaman Terbaru</h3>
    @if ($latestBorrowings->isEmpty())
        <p style="color: #888;">Belum ada riwayat transaksi peminjaman.</p>
    @else
        <table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 800px;">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th>ID</th>
                    <th>Peminjam</th>
                    <th>Buku</th>
                    <th>Tgl Pinjam</th>
                    <th>Jatuh Tempo</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($latestBorrowings as $lb)
                    <tr>
                        <td style="text-align: center;"><strong>#{{ $lb->id }}</strong></td>
                        <td>{{ $lb->member->name }}</td>
                        <td>
                            @foreach ($lb->details as $d)
                                {{ $d->book->title }} ({{ $d->quantity }})<br>
                            @endforeach
                        </td>
                        <td>{{ $lb->borrowing_date }}</td>
                        <td>{{ $lb->due_date }}</td>
                        <td>
                            @if ($lb->status === 'borrowed')
                                <span style="color: #856404; font-weight: bold;">Dipinjam</span>
                            @else
                                <span style="color: #155724; font-weight: bold;">Dikembalikan</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        <a href="{{ route('borrowings.index') }}" style="color: blue;">&raquo; Buka Seluruh Riwayat Transaksi</a>
    @endif
@endsection
