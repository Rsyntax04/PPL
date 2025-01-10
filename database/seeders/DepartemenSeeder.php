<?php

namespace Database\Seeders;

use App\Models\departemen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartemenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departemenData = [
            [
                'id_departemen' => 'd1',
                'nama_departemen' => 'Marketing',
            ],
            [
                'id_departemen' => 'd2',
                'nama_departemen' => 'Keuangan',
            ],
            [
                'id_departemen' => 'd3',
                'nama_departemen' => 'Sales',
            ],
        ];

        foreach ($departemenData as $key => $val) {
            departemen::create($val);
        }
    }
}
