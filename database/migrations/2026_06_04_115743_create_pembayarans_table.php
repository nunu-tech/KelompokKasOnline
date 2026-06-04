<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();

            // relasi ke siswa
            $table->foreignId('siswa_id')
                ->constrained()
                ->onDelete('cascade');

            // data pembayaran
            $table->integer('jumlah');
            $table->date('tanggal');

            // status pembayaran
            $table->enum('status', ['lunas', 'menunggak'])
                ->default('menunggak');

            $table->string('keterangan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
