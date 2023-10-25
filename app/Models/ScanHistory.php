<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScanHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_cp',
        'nama_cp',
        'lokasi_cp',
        'remark',
        'user'
    ];
}