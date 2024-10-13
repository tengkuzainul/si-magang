<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magang extends Model
{
    use HasFactory;

    protected $table = 'magangs';

    protected $guarded = ['id'];

    protected $fillable = [
        'siswa_id',
        'guru_id',
        'tahun_magang_id',
        'tempat_magang',
        'surat_magang',
        'surat_balasan',
    ];

    public function siswa()
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }

    public function guruPembimbing()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunMagang::class, 'tahun_magang_id');
    }

    public function logbooks()
    {
        return $this->hasMany(Logbook::class, 'magang_id');
    }
}
