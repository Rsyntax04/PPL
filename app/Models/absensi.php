<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class absensi extends Model
{
    use HasFactory;
    protected $table = 'absensi';

    protected $fillable = [
        'absensi_id',
        'id_karyawan',
        'waktu_masuk',
        'waktu_keluar',
        'jenis_presensi',
        'status',
        'approval'
    ];

    protected $primaryKey = 'absensi_id';

    public $incrementing =false;
    protected $keyType='string';

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan', 'id_karyawan');
    }
}
