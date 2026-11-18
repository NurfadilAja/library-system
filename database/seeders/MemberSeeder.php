<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Member;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        $members = [
            [
                'member_code' => 'M001',
                'name'        => 'Nurfadil',
                'phone'       => '081234567890',
                'address'     => 'Jl. Merdeka No. 1, Karawang',
            ],
            [
                'member_code' => 'M002',
                'name'        => 'Ihsan',
                'phone'       => '081234567891',
                'address'     => 'Jl. Diponegoro No. 12, Bandung',
            ],
            [
                'member_code' => 'M003',
                'name'        => 'Abel',
                'phone'       => '081234567892',
                'address'     => 'Jl. Sudirman No. 45, Jakarta',
            ],
            [
                'member_code' => 'M004',
                'name'        => 'Annastia',
                'phone'       => '081234567893',
                'address'     => 'Jl. Ahmad Yani No. 88, Bekasi',
            ],
            [
                'member_code' => 'M005',
                'name'        => 'Bibit',
                'phone'       => '081234567894',
                'address'     => 'Jl. Pajajaran No. 23, Bogor',
            ],
        ];

        foreach ($members as $member) {
            Member::updateOrCreate(
                ['member_code' => $member['member_code']],
                $member
            );
        }
    }
}
