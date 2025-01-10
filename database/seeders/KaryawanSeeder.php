<?php

namespace Database\Seeders;

use App\Models\Karyawan;
use Illuminate\Database\Seeder;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // $id = IdGenerator::generate(['table' => 'karyawan', 'field' => 'id_karyawan', 'length' => '10', 'prefix' => 'KAR-']);

        $userData = [
            [
                'id_karyawan' => 'KAR-000001',
                'jabatan' => 'jm1',
                'role' => 'r1',
                'golongan' => 'g7',
                'departemen' => 'd1',
                'alamat' => 'Jl. Surya Sumantri No.01, Sukawarna, Kec. Sukajadi, Kota Bandung, Jawa Barat 40164',
                'nama' => 'Jono',
                'email' => 'jono@gmail.com',
                'password' => bcrypt('Adm12345'),
                'no_telepon' => '082543138132',
            ],
            [
                'id_karyawan' => 'KAR-000002',
                'jabatan' => 'jm2',
                'role' => 'r2',
                'golongan' => 'g5',
                'departemen' => 'd1',
                'alamat' => 'Jl. Surya Sumantri No.02, Sukawarna, Kec. Sukajadi, Kota Bandung, Jawa Barat 40164',
                'nama' => 'Agus',
                'email' => 'agus@gmail.com',
                'password' => bcrypt('Mnj12345'),
                'no_telepon' => '083543138132',
            ],
            [
                'id_karyawan' => 'KAR-000003',
                'jabatan' => 'jm3',
                'role' => 'r3',
                'golongan' => 'g3',
                'departemen' => 'd1',
                'alamat' => 'Jl. Surya Sumantri No.03, Sukawarna, Kec. Sukajadi, Kota Bandung, Jawa Barat 40164',
                'nama' => 'Asep',
                'email' => 'asep@gmail.com',
                'password' => bcrypt('Pgw12345'),
                'no_telepon' => '084543138132',
            ],
        ];

        foreach ($userData as $key => $val) {
            Karyawan::create($val);
        }
    }
}
