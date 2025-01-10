<?php

namespace Database\Seeders;

use App\Models\golongan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GolonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $golonganData = [
            [
                'id_golongan' => 'g1',
                'nama_golongan' => 'Non Staff',
            ],
            [
                'id_golongan' => 'g2',
                'nama_golongan' => 'Senior Non Staff',
            ],
            [
                'id_golongan' => 'g3',
                'nama_golongan' => 'Staff',
            ],
            [
                'id_golongan' => 'g4',
                'nama_golongan' => 'Senior Staff',
            ],
            [
                'id_golongan' => 'g5',
                'nama_golongan' => 'Junior Manager',
            ],
            [
                'id_golongan' => 'g6',
                'nama_golongan' => 'Manager',
            ],
            [
                'id_golongan' => 'g7',
                'nama_golongan' => 'Senior Manager',
            ],
            [
                'id_golongan' => 'g8',
                'nama_golongan' => 'General Manager',
            ],
            [
                'id_golongan' => 'g9',
                'nama_golongan' => 'General Manager',
            ],
            [
                'id_golongan' => 'g10',
                'nama_golongan' => 'Director',
            ],
        ];

        foreach ($golonganData as $key => $val) {
            golongan::create($val);
        }
    }
}
