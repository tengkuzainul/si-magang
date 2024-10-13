<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogBook extends Model
{
    use HasFactory;

    protected $table = 'log_books';

    protected $guarded = ['id'];

    protected $fillable = [
        'magang_id',
        'deskripsi',
        'lampiran_foto',
        'status',
        'alasan_ditolak',
    ];

    public function magang()
    {
        return $this->belongsTo(Magang::class, 'magang_id');
    }
}
