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
        Schema::create('users', function (Blueprint $table) {
            // Sesuai dengan ERD
            $table->id('id_user');
            $table->unsignedBigInteger('id_kelas')->nullable(); // Foreign key ke tabel kelas (jika ada)
            $table->string('nama_lengkap'); // Menggantikan 'name'
            $table->string('kelamin'); // tambahan
            $table->string('username')->unique(); // Tambahan username
            $table->string('password');
            $table->string('email')->unique();
            $table->unsignedBigInteger('id_role')->nullable(); // Untuk membedakan Admin dan Siswa
            
            // Bawaan keamanan Laravel (Sebaiknya dibiarkan)
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index(); // Biarkan default
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};