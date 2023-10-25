<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataCheckpoint extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_cp',
        'nama_cp',
        'desc_cp',
        'lokasi_cp',
        'status'
    ];
}