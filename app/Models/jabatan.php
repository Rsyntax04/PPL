<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jabatan extends Model
{
    use HasFactory;

    protected $table = 'jabatan';

    protected $fillable = [
        'id_jabatan',
        'nama_jabatan',
    ];

    protected $primaryKey='id_jabatan';
    
    public $incrementing =false;
    protected $keyType='string';
}
