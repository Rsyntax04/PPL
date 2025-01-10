<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class departemen extends Model
{
    use HasFactory;
    protected $table = 'departemen';

    protected $fillable = [
        'id_departemen',
        'nama_departemen',
    ];

    protected $primaryKey = 'id_departemen';

    public $incrementing =false;
    protected $keyType='string';
}
