@extends('layouts.app')
@section('title', 'Daftar Buku')

@section('content')
    <h2>Daftar Buku</h2>

    <!-- Tombol Tambah Buku -->
    <a href="{{ route('books.create') }}" style="margin-bottom: 10px; display: inline-block;">
        [+ Tambah Buku Baru]
    </a>

    <ul>
        @foreach($books as $book)
            <li>
                <a href="{{ route('books.show', $book->id) }}">
                    {{ $book->title }}
                </a>
                oleh {{ $book->author }}

                <!-- Menampilkan Nama Kategori -->
                <br>
                <small style="color: #666;">
                    Kategori:
                    <strong>
                        {{ $book->category?->name ?? 'Belum ada kategori' }}
                    </strong>
                </small>

                @if($book->stock > 0)
                    (Stok tersedia: {{ $book->stock }})
                @else
                    (Stok habis)
                @endif

                <br>

                <!-- Tombol Edit & Hapus -->
                <a href="{{ route('books.edit', $book->id) }}">Edit</a> |

                <form action="{{ route('books.destroy', $book->id) }}"
                      method="POST"
                      style="display:inline;">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            style="background: none; border: none; color: red; cursor: pointer; text-decoration: underline;">
                        Hapus
                    </button>
                </form>

                <br><br>
            </li>
        @endforeach
    </ul>
@endsection
