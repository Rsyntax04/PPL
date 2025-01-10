<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QrCode;
use SimpleSoftwareIO\QrCode\Facades\QrCode as QRCodeGenerator;
use App\Models\absensi;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class QRCodeController extends Controller
{
    public function generate()
    {
        $uniqueCode = uniqid(); // Generate unique QR code
        $expiredAt = Carbon::now()->addMinutes(10); // Expiry time: 10 minutes

        // Save QR code to database
        QrCode::create([
            'code' => $uniqueCode,
            'expired_at' => $expiredAt,
        ]);

        // Generate QR Code
        $qrCode = QRCodeGenerator::size(300)->generate($uniqueCode);

        return view('manajer.generate', compact('qrCode', 'expiredAt'));
    }

    public function scan()
    {
        return view('karyawan.scan');
    }

    public function presensiqr(Request $request, $code){
        $qrCode = QrCode::where('code', $code)->first();

        if (!$qrCode || now()->greaterThan($qrCode->expired_at)) {
            return response()->json(['message' => 'QR Code sudah expired atau tidak valid'], 400);
        }

        $karyawan = auth()->user();

         $absen = absensi::where('id_karyawan', $karyawan->id_karyawan)
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
                $absen->id_karyawan = $karyawan->id_karyawan;
                $absen->waktu_masuk = date('Y-m-d H:i:s');
                $absen->jenis_presensi = 'onsite';
                $absen->status = 'Masuk';
                $absen->approval = 1;
                $absen->save();
            }

        return response()->json(['message' => 'Presensi berhasil dicatat'], 200);
    }
}
