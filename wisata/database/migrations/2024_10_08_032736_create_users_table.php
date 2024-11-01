<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Primary key, auto-increment
            $table->string('name'); // Nama pengguna
            $table->string('email')->unique(); // Email pengguna, harus unik
            $table->timestamp('email_verified_at')->nullable(); // Tanggal verifikasi email, bisa null
            $table->string('password'); // Password pengguna, akan disimpan sebagai hash
            $table->rememberToken(); // Token untuk "remember me" saat login
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users'); // Menghapus tabel users jika ada
    }
}
