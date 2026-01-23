<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pemohon',
        'nama_merek',
        'jenis',
        'tahun',
        'status',
        'keterangan',
    ];
}