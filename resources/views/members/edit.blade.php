@extends('layouts.app')
@section('title', 'Edit Anggota')

@section('content')
    <h2>Edit Data Anggota</h2>

    <form action="{{ route('members.update', $member->id) }}" method="POST" style="max-width: 500px;">
        @csrf
        @method('PUT')

        <div>
            <label for="member_code"><strong>Kode Anggota:</strong></label><br>
            <input
                type="text"
                name="member_code"
                id="member_code"
                value="{{ old('member_code', $member->member_code) }}"
                required
                style="width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box;"
            >
            @error('member_code')
                <p style="color: red; font-size: 13px; margin: 4px 0 0;">{{ $message }}</p>
            @enderror
        </div>

        <br>

        <div>
            <label for="name"><strong>Nama Lengkap:</strong></label><br>
            <input
                type="text"
                name="name"
                id="name"
                value="{{ old('name', $member->name) }}"
                required
                style="width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box;"
            >
            @error('name')
                <p style="color: red; font-size: 13px; margin: 4px 0 0;">{{ $message }}</p>
            @enderror
        </div>

        <br>

        <div>
            <label for="phone"><strong>No. Telepon / HP:</strong></label><br>
            <input
                type="text"
                name="phone"
                id="phone"
                value="{{ old('phone', $member->phone) }}"
                style="width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box;"
            >
            @error('phone')
                <p style="color: red; font-size: 13px; margin: 4px 0 0;">{{ $message }}</p>
            @enderror
        </div>

        <br>

        <div>
            <label for="address"><strong>Alamat:</strong></label><br>
            <textarea
                name="address"
                id="address"
                rows="3"
                style="width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box;"
            >{{ old('address', $member->address) }}</textarea>
            @error('address')
                <p style="color: red; font-size: 13px; margin: 4px 0 0;">{{ $message }}</p>
            @enderror
        </div>

        <br>
        <button type="submit" style="background-color: #007bff; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer;">
            Update Anggota
        </button>
        <a href="{{ route('members.index') }}" style="margin-left: 10px; color: #666; text-decoration: underline;">
            Kembali
        </a>
    </form>
@endsection
