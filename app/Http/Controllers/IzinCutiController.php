<?php

namespace App\Http\Controllers;

use App\Models\IzinCuti;
use Illuminate\Http\Request;

class IzinCutiController extends Controller
{
    /**
     * Menampilkan formulir pengajuan izin cuti.
     */
    public function create()
    {
        return view('izin_cuti.create');
    }

    /**
     * Menyimpan pengajuan izin cuti ke database.
     */
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'department' => 'required|string|max:255',
        'position' => 'required|string|max:255',
        'alasan_izin' => 'required|string',
        'tanggal_awal' => 'required|date',
        'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        'berkas' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
    ]);

    $data = $request->only(['name', 'department', 'position', 'alasan_izin', 'tanggal_awal', 'tanggal_akhir']);

    if ($request->hasFile('berkas')) {
        $data['berkas'] = $request->file('berkas')->store('berkas');
    }

    IzinCuti::create($data);

    // Set flash message
    return redirect()->route('izin_cuti.create')->with('success', 'Pengajuan izin cuti berhasil diajukan.');
}

}
