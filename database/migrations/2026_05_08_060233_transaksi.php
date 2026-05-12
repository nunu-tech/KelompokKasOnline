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
        Schema::create('transaksis', function (Blueprint $table) {

            $table->id('id_transaksi');

            // Bendahara
            $table->foreignId('id_bendahara')
                  ->constrained('users', 'id')
                  ->onDelete('cascade');

            // Siswa
            $table->foreignId('id_user')
                  ->nullable()
                  ->constrained('users', 'id')
                  ->onDelete('cascade');

            $table->enum('jenis', ['Masuk', 'Keluar']);
            $table->decimal('nominal', 12, 2);
            $table->string('keterangan');
            $table->date('tanggal');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};