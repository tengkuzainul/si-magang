<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunMagang extends Model
{
    use HasFactory;

    protected $table = 'tahun_magangs';

    protected $guraded = ['id'];

    protected $fillable = [
        'kd_tahun_magang',
        'tahun_magang',
        'tanggal_mulai',
        'tanggal_selesai',
    ];
}
