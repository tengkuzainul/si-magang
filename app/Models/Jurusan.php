<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusans';

    protected $guarded = ['id'];

    protected $fillable = ['kd_jurusan', 'nama_jurusan'];

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'jurusan_id');
    }
}
