<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kas', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel siswa
            $table->foreignId('siswa_id')
                  ->constrained('siswas')
                  ->onDelete('cascade');

            // Tanggal pembayaran
            $table->date('tanggal');

            // Nominal kas
            $table->integer('jumlah');

            // Status pembayaran
            $table->enum('status', ['lunas', 'belum'])
                  ->default('belum');

            // Keterangan
            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kas');
    }
};