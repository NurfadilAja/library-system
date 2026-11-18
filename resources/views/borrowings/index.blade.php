@extends('layouts.app')
@section('title', 'Daftar Peminjaman')

@section('content')
    <h2>Transaksi Peminjaman & Pengembalian Buku</h2>

    @if (session('success'))
        <p style="color: green; font-weight: bold; background-color: #e8f5e9; padding: 10px; border-radius: 4px; border: 1px solid #c8e6c9;">
            {{ session('success') }}
        </p>
    @endif

    @if (session('error'))
        <p style="color: red; font-weight: bold; background-color: #ffebee; padding: 10px; border-radius: 4px; border: 1px solid #ffcdd2;">
            {{ session('error') }}
        </p>
    @endif

    <div style="margin-bottom: 15px;">
        <a href="{{ route('borrowings.create') }}" style="font-weight: bold; color: blue; text-decoration: none; border: 1px solid blue; padding: 6px 12px; border-radius: 4px; display: inline-block;">
            [+ Tambah Transaksi Peminjaman Baru]
        </a>
    </div>

    @if ($borrowings->isEmpty())
        <p style="color: #666;">Belum ada riwayat transaksi peminjaman.</p>
    @else
        <table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 100%;">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th>ID</th>
                    <th>Peminjam (Anggota)</th>
                    <th>Buku yang Dipinjam</th>
                    <th>Jumlah</th>
                    <th>Tgl Pinjam</th>
                    <th>Jatuh Tempo</th>
                    <th>Tgl Kembali</th>
                    <th>Status</th>
                    <th>Petugas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($borrowings as $b)
                    <tr>
                        <td style="text-align: center;"><strong>#{{ $b->id }}</strong></td>
                        <td>
                            <strong>{{ $b->member->name }}</strong><br>
                            <small style="color: #666;">Kode: {{ $b->member->member_code }}</small>
                        </td>
                        <td>
                            @foreach ($b->details as $d)
                                <span>{{ $d->book->title }}</span><br>
                            @endforeach
                        </td>
                        <td style="text-align: center;">
                            @foreach ($b->details as $d)
                                <span>{{ $d->quantity }}</span><br>
                            @endforeach
                        </td>
                        <td>{{ $b->borrowing_date }}</td>
                        <td>{{ $b->due_date }}</td>
                        <td>{{ $b->return_date ?? '-' }}</td>
                        <td style="text-align: center;">
                            @if ($b->status === 'borrowed')
                                <span style="background-color: #fff3cd; color: #856404; padding: 4px 8px; border-radius: 4px; font-weight: bold; font-size: 13px;">
                                    Dipinjam
                                </span>
                            @else
                                <span style="background-color: #d4edda; color: #155724; padding: 4px 8px; border-radius: 4px; font-weight: bold; font-size: 13px;">
                                    Dikembalikan
                                </span>
                            @endif
                        </td>
                        <td>{{ $b->user->name ?? '-' }}</td>
                        <td style="text-align: center;">
                            @if ($b->status === 'borrowed')
                                <form action="{{ route('borrowings.return', $b->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin memproses pengembalian buku ini? Stok akan otomatis bertambah kembali.')">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" style="background-color: #28a745; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; font-size: 13px;">
                                        Kembalikan
                                    </button>
                                </form>
                            @else
                                <span style="color: #666; font-size: 13px;">Selesai</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
