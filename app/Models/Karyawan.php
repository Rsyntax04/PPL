<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Authenticatable
{
    use HasFactory;
    protected $table = 'karyawan';

    protected $fillable = [
        'id_karyawan',
        'departemen',
        'jabatan',
        'role',
        'golongan',
        'nama',
        'alamat',
        'email',
        'password',
        'no_telepon',
        'unique_face_id'
    ];

    protected $primaryKey = 'id_karyawan';

    public $incrementing =false;
    protected $keyType='string';

    public function cariRole()
    {
        return $this->belongsTo(Role::class, 'role', 'id_role');
    }
    public function cariDepartemen()
    {
        return $this->belongsTo(Departemen::class, 'departemen', 'id_departemen');
    }
    public function cariJabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan', 'id_jabatan');
    }
    public function cariGolongan()
    {
        return $this->belongsTo(Golongan::class, 'golongan', 'id_golongan');
    }
}
