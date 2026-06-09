<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tagihan', function (Blueprint $table) {
            $table->id('id_tagihan'); // Primary key khusus tagihan
            $table->unsignedBigInteger('id_user'); // ID siswa yang ditagih
            $table->integer('nominal');
            $table->string('keterangan');
            $table->date('jatuh_tempo');
            $table->string('status')->default('Belum Bayar'); // Default awal pasti belum bayar
            $table->timestamps();

            // Relasi ke tabel users (karena primary key users kamu adalah id_user)
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihans');
    }
};
