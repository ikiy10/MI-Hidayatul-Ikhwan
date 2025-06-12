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
            $table->id();
            $table->string('nama_lengkap');
            $table->string('email')->unique()->nullable();
            $table->string('no_hp')->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'user']);
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->text('alamat')->nullable();
            $table->timestamps();
        });

        Schema::create('jadwal_pelajaran', function (Blueprint $table) {
            $table->id(); // sama seperti id bigint
            $table->string('mata_pelajaran', 500);
            $table->string('ruangan', 500);
            $table->string('hari', 50);
            $table->string('nama_guru', 500);
            $table->time('mulai');
            $table->time('berakhir');
            $table->string('kelas', 50);
            $table->timestamps(); // otomatis buat kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
