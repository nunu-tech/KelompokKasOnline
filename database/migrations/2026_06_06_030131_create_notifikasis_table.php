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
        Schema::create('notifikasis', function (Blueprint $table) {
            $table->id();
            
            // MENGUBAH HUBUNGAN: Dipaksa mencari kolom 'id_user' di tabel 'users' agar tidak error 3734
            $table->unsignedBigInteger('siswa_id');
            $table->foreign('siswa_id')->references('id_user')->on('users')->onDelete('cascade');
            
            // Isi pesan tagihan (misal: "Kamu memiliki tunggakan kas sebesar...")
            $table->text('pesan');
            
            // Status apakah notifikasi sudah dibaca oleh siswa (0 = Belum dibaca, 1 = Sudah dibaca)
            $table->boolean('is_read')->default(0); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasis');
    }
};