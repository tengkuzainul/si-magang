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
        Schema::create('log_books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('magang_id');
            $table->text('deskripsi');
            $table->string('lampiran_foto');
            $table->enum('status', ['Menunggu', 'Disetujui'])->default('Menunggu');
            $table->foreign('magang_id')->references('id')->on('magangs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_books');
    }
};
