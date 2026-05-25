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
        Schema::table('transaksis', function (Blueprint $table) {
            // Menambahkan kolom status (default pending) dan kolom foto bukti transfer
            $table->string('status')->default('Disetujui')->after('jenis'); // 'Pending', 'Disetujui', atau 'Ditolak'
            $table->string('bukti_transfer')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            // Menghapus kembali kolom yang ditambahkan jika migration di-rollback
            $table->dropColumn(['status', 'bukti_transfer']);
        });
    }
};