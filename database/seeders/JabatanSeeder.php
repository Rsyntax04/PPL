<?php

namespace Database\Seeders;

use App\Models\jabatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jabatanData = [
            [
                'id_jabatan' => 'jm1',
                'nama_jabatan' => 'admin marketing',
            ],
            [
                'id_jabatan' => 'jm2',
                'nama_jabatan' => 'manajer marketing',
            ],
            [
                'id_jabatan' => 'jm3',
                'nama_jabatan' => 'karyawan marketing',
            ],
            [
                'id_jabatan' => 'jk1',
                'nama_jabatan' => 'admin keuangan',
            ],
            [
                'id_jabatan' => 'jk2',
                'nama_jabatan' => 'manajer keuangan',
            ],
            [
                'id_jabatan' => 'jk3',
                'nama_jabatan' => 'karyawan keuangan',
            ],
            [
                'id_jabatan' => 'js1',
                'nama_jabatan' => 'admin sales',
            ],
            [
                'id_jabatan' => 'js2',
                'nama_jabatan' => 'manajer sales',
            ],
            [
                'id_jabatan' => 'js3',
                'nama_jabatan' => 'karyawan sales',
            ],
        ];

        foreach ($jabatanData as $key => $val) {
            jabatan::create($val);
        }
    }
}
