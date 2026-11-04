@extends('layouts.app')
@section('title', 'Kelola Pengguna')

@section('content')
    <h2>Kelola Pengguna</h2>

    @if (session('success'))
        <p style="color: green; font-weight: bold;">{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p style="color: red; font-weight: bold;">{{ session('error') }}</p>
    @endif

    <table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 600px;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <strong style="color: {{ $user->role === 'admin' ? 'blue' : 'green' }};">
                            {{ ucfirst($user->role) }}
                        </strong>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

