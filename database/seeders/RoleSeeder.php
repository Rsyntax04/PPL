<?php

namespace Database\Seeders;

use App\Models\role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleData = [
            [
                'id_role' => 'r1',
                'nama_role' => 'admin',
            ],
            [
                'id_role' => 'r2',
                'nama_role' => 'manajer',
            ],
            [
                'id_role' => 'r3',
                'nama_role' => 'karyawan',
            ],
        ];

        foreach ($roleData as $key => $val) {
            role::create($val);
        }
    }
}
