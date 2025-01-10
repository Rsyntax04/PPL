<?php

namespace App\Http\Controllers;

use App\Models\absensi;
use App\Models\Karyawan;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    public function index()
    {
        $data = absensi::all()->sortByDesc('waktu_masuk');
        return view('manajer.index', [
            'absensiAll' => $data
        ]);
    }

    public function create()
    {
        $today = date('Y-m-d');

        // Mengambil karyawan yang belum terdaftar di absensi hari ini
        $karyawans = karyawan::leftJoin('absensi', function ($join) use ($today) {
            $join->on('karyawan.id_karyawan', 'absensi.id_karyawan')
                ->whereDate('absensi.waktu_masuk', $today)
                ->whereDate('absensi.waktu_keluar', $today);
        })
            ->whereNull('absensi.id_karyawan') // Menampilkan karyawan yang tidak memiliki absensi pada hari ini
            ->get(['karyawan.*']);        
        
        return view('manajer.create', [
            'karyawans' => $karyawans
        ]);
        // return view('manajer.create', [
        //     'karyawans' => karyawan::all()
        // ]);
    }


    public function store(Request $request, $id = null)
    {
        $data = $request->validate([
            'attendance' => 'required|array',
            'attendance.*.id_karyawan' => 'required|exists:karyawan,id_karyawan',
            'attendance.*.status' => 'required|in:Hadir,Telat,Absen',
        ], [
            'attendance.required' => 'Data attendance tidak ditemukan',
            'attendance.array' => 'Data attendance harus berupa array',
            'attendance.*.id_karyawan.required' => 'Karyawan belum ada yang terpilih',
            'attendance.*.status.required' => 'Status harus dipilih',
            'attendance.*.status.in' => 'Status tidak valid, pilih antara Hadir, Telat, atau Absen',
        ]);

        // dd($data);

        foreach ($data['attendance'] as $dataAbsen) {
            $absen = absensi::where('id_karyawan', $dataAbsen['id_karyawan'])
                ->whereDate('waktu_masuk', date('Y-m-d'))
                ->first();

            if ($absen) {
                // Jika sudah ada, update waktu_keluar
                DB::table('absensi')
                ->where('id_karyawan', $absen->id_karyawan)
                ->where('waktu_masuk', $absen->waktu_masuk)
                ->update(['waktu_keluar' => date('Y-m-d h:i:s')]);
            } else {
                // Jika belum ada, buat data baru
                $absen = new absensi();
                $absen->id_karyawan = $dataAbsen['id_karyawan'];
                $absen->waktu_masuk = date('Y-m-d H:i:s');
                $absen->jenis_presensi = 'onsite';
                $absen->status = $dataAbsen['status'];
                $absen->approval = 1;
                $absen->save();
            }
        }

        // Redirect dengan pesan sukses
        return redirect()->route('rekapAll');
    }

    public function authenticate(Request $request)
{
    try {
        $request->validate([
            'unique_face_id' => 'required|string',
        ]);

        // Cek apakah unique_face_id ada di database
        $karyawan = Karyawan::where('unique_face_id', $request->unique_face_id)->first();

        if (!$karyawan) {
            return response()->json([
                'success' => false,
                'message' => 'Karyawan tidak ditemukan atau belum terdaftar.'
            ], 404);
        }

        // Cek apakah karyawan sudah melakukan presensi hari ini
        $today = date('Y-m-d');
        $absensi = absensi::where('id_karyawan', $karyawan->id_karyawan)
            ->whereDate('waktu_masuk', $today)
            ->first();

        if ($absensi) {
            // Jika sudah ada, update waktu_keluar
            $absensi->waktu_keluar = now();
            $absensi->save();

            return response()->json([
                'success' => true,
                'message' => 'Absensi keluar berhasil diperbarui.',
                'karyawan' => $karyawan,
            ]);
        } else {
            // Jika belum ada, buat data absensi baru
            $absensi = new absensi();
            $absensi->id_karyawan = $karyawan->id_karyawan;
            $absensi->waktu_masuk = now();
            $absensi->jenis_presensi = 'onsite';
            $absensi->status = 'Hadir';
            $absensi->approval = 1;
            $absensi->save();

            return response()->json([
                'success' => true,
                'message' => 'Absensi masuk berhasil.',
                'karyawan' => $karyawan,
            ]);
        }
    } catch (\Exception $e) {
        \Log::error($e->getMessage()); // Log error untuk debugging
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan pada server.'
        ], 500);
    }
}


    public function update($id_karyawan, $waktu_masuk)
    {
        if (!$id_karyawan && !$waktu_masuk) {
            return redirect()->back()->with('error', 'Data absensi tidak ditemukan.');
        }

        DB::table('absensi')
            ->where('id_karyawan', $id_karyawan)
            ->where('waktu_masuk', $waktu_masuk)
            ->update(['waktu_keluar' => date('Y-m-d h:i:s')]);


        return redirect()->route('rekapAll');
    }
}
