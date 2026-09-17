@extends('layouts.app')
@section('title', 'Daftar Buku')
@section('content')
    <h2>Daftar Buku</h2>
    <ul>
        @foreach($books as $book)
            <li>
                <a href="/books/{{ $book['id'] }}">{{ $book['title'] }}</a> - {{ $book['author'] }}
                @if($book['stock'] > 0)
                    (Stok tersedia: {{ $book['stock'] }})
                @else
                    (Stok habis)
                @endif
            </li>
        @endforeach
    </ul>
@endsection