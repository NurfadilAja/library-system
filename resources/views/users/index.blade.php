@extends('layouts.app')
@section('title', 'Kelola Pengguna')

@section('content')
    <h2>Kelola Pengguna Sistem</h2>

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

    {{-- Form Tambah Pengguna Baru (Collapsible) --}}
    <details style="margin-bottom: 20px; border: 1px solid #ccc; padding: 12px; border-radius: 4px; max-width: 650px;">
        <summary style="cursor: pointer; font-weight: bold; color: blue;">[+ Tambah Pengguna Baru]</summary>
        <form action="{{ route('users.store') }}" method="POST" style="margin-top: 15px;">
            @csrf
            <div>
                <label>Nama Lengkap:</label><br>
                <input type="text" name="name" value="{{ old('name') }}" required style="width: 100%; padding: 6px; margin-top: 4px; box-sizing: border-box;">
                @error('name') <p style="color: red; font-size: 13px;">{{ $message }}</p> @enderror
            </div>
            <br>
            <div>
                <label>Email:</label><br>
                <input type="email" name="email" value="{{ old('email') }}" required style="width: 100%; padding: 6px; margin-top: 4px; box-sizing: border-box;">
                @error('email') <p style="color: red; font-size: 13px;">{{ $message }}</p> @enderror
            </div>
            <br>
            <div>
                <label>Password:</label><br>
                <input type="password" name="password" required minlength="6" style="width: 100%; padding: 6px; margin-top: 4px; box-sizing: border-box;">
                @error('password') <p style="color: red; font-size: 13px;">{{ $message }}</p> @enderror
            </div>
            <br>
            <div>
                <label>Role:</label><br>
                <select name="role" required style="width: 100%; padding: 6px; margin-top: 4px;">
                    <option value="petugas" @selected(old('role') === 'petugas')>Petugas</option>
                    <option value="admin" @selected(old('role') === 'admin')>Admin</option>
                </select>
                @error('role') <p style="color: red; font-size: 13px;">{{ $message }}</p> @enderror
            </div>
            <br>
            <button type="submit" style="padding: 6px 14px; cursor: pointer;">Simpan Pengguna</button>
        </form>
    </details>

    {{-- Tabel Pengguna --}}
    <table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 750px;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th style="width: 40px; text-align: center;">No</th>
                <th>Nama</th>
                <th>Email</th>
                <th style="text-align: center; width: 100px;">Role</th>
                <th style="text-align: center; width: 140px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $index => $user)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td>
                        {{ $user->name }}
                        @if (auth()->id() === $user->id)
                            <small style="color: #666; font-style: italic;">(Anda)</small>
                        @endif
                    </td>
                    <td>{{ $user->email }}</td>
                    <td style="text-align: center;">
                        <strong style="color: {{ $user->role === 'admin' ? 'blue' : 'green' }};">
                            {{ ucfirst($user->role) }}
                        </strong>
                    </td>
                    <td style="text-align: center;">
                        <a href="{{ route('users.edit', $user->id) }}" style="color: blue;">Edit</a>
                        @if (auth()->id() !== $user->id)
                            |
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun pengguna {{ $user->name }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: none; border: none; color: red; cursor: pointer; text-decoration: underline; padding: 0;">
                                    Hapus
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
