<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OnPremiseController extends Controller
{
    // Menampilkan halaman kosong
    public function create()
    {
        return view('karyawan.absen-onpremise');
    }
}
