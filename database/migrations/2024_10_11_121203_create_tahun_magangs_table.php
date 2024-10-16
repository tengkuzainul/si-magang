<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tahun_magangs', function (Blueprint $table) {
            $table->id();
            $table->string('kd_tahun_magang')->unique();
            $table->string('tahun_magang');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->enum('status_logbook', ['Aktif', 'Tutup']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tahun_magangs');
    }
};
