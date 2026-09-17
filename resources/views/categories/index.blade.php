@extends('layouts.app')
@section('title', 'Daftar Kategori')
@section('content')
    <h2>Daftar Kategori</h2>
    <ul>
        @foreach($categories as $category)
            <li>{{ $category }}</li>
        @endforeach
    </ul>
@endsection