@extends('layouts.app')
@section('title', 'Edit Pengguna')

@section('content')
    <h2>Edit Data Pengguna</h2>

    <form action="{{ route('users.update', $user->id) }}" method="POST" style="max-width: 500px;">
        @csrf
        @method('PUT')

        {{-- Nama --}}
        <div>
            <label for="name"><strong>Nama Lengkap:</strong></label><br>
            <input
                type="text"
                name="name"
                id="name"
                value="{{ old('name', $user->name) }}"
                required
                style="width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box;"
            >
            @error('name')
                <p style="color: red; font-size: 13px; margin: 4px 0 0;">{{ $message }}</p>
            @enderror
        </div>

        <br>

        {{-- Email --}}
        <div>
            <label for="email"><strong>Email:</strong></label><br>
            <input
                type="email"
                name="email"
                id="email"
                value="{{ old('email', $user->email) }}"
                required
                style="width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box;"
            >
            @error('email')
                <p style="color: red; font-size: 13px; margin: 4px 0 0;">{{ $message }}</p>
            @enderror
        </div>

        <br>

        {{-- Role --}}
        <div>
            <label for="role"><strong>Role Akses:</strong></label><br>
            <select name="role" id="role" required style="width: 100%; padding: 8px; margin-top: 5px;">
                <option value="petugas" @selected(old('role', $user->role) === 'petugas')>Petugas</option>
                <option value="admin" @selected(old('role', $user->role) === 'admin')>Admin</option>
            </select>
            @error('role')
                <p style="color: red; font-size: 13px; margin: 4px 0 0;">{{ $message }}</p>
            @enderror
        </div>

        <br>

        {{-- Password Baru (Opsional) --}}
        <div>
            <label for="password"><strong>Password Baru:</strong> <small style="color: #666;">(Kosongkan jika tidak ingin mengubah password)</small></label><br>
            <input
                type="password"
                name="password"
                id="password"
                minlength="6"
                placeholder="Masukkan password baru..."
                style="width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box;"
            >
            @error('password')
                <p style="color: red; font-size: 13px; margin: 4px 0 0;">{{ $message }}</p>
            @enderror
        </div>

        <br>
        <button type="submit" style="background-color: #007bff; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer;">
            Update Pengguna
        </button>
        <a href="{{ route('users.index') }}" style="margin-left: 10px; color: #666; text-decoration: underline;">
            Kembali
        </a>
    </form>
@endsection
