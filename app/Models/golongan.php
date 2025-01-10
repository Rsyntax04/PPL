<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class golongan extends Model
{
    use HasFactory;
    protected $table = 'golongan';

    protected $fillable = [
        'id_golongan',
        'nama_golongan',
    ];

    protected $primaryKey = 'id_golongan';

    public $incrementing =false;
    protected $keyType='string';
}
