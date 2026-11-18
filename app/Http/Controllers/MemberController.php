<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        // Auto-seed data anggota default jika tabel masih kosong
        if (Member::count() === 0) {
            $defaults = [
                ['member_code' => 'M001', 'name' => 'Nurfadil',  'phone' => '081234567890', 'address' => 'Jl. Merdeka No. 1, Karawang'],
                ['member_code' => 'M002', 'name' => 'Ihsan',     'phone' => '081234567891', 'address' => 'Jl. Diponegoro No. 12, Bandung'],
                ['member_code' => 'M003', 'name' => 'Abel',      'phone' => '081234567892', 'address' => 'Jl. Sudirman No. 45, Jakarta'],
                ['member_code' => 'M004', 'name' => 'Annastia',  'phone' => '081234567893', 'address' => 'Jl. Ahmad Yani No. 88, Bekasi'],
                ['member_code' => 'M005', 'name' => 'Bibit',     'phone' => '081234567894', 'address' => 'Jl. Pajajaran No. 23, Bogor'],
            ];
            foreach ($defaults as $member) {
                Member::create($member);
            }
        }

        $members = Member::orderBy('member_code')->get();

        return view('members.index', compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_code' => 'required|string|max:50|unique:members,member_code',
            'name'        => 'required|string|min:2|max:255',
            'phone'       => 'nullable|string|max:20',
            'address'     => 'nullable|string',
        ], [
            'member_code.required' => 'Kode anggota wajib diisi.',
            'member_code.unique'   => 'Kode anggota sudah digunakan.',
            'name.required'        => 'Nama anggota wajib diisi.',
        ]);

        Member::create($validated);

        return redirect()->route('members.index')
            ->with('success', 'Data anggota berhasil ditambahkan.');
    }
}
