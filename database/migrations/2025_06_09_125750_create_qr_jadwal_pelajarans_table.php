<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('qr_jadwal_pelajaran', function (Blueprint $table) {
            $table->id();
            $table->string('kelas');
            $table->string('ruangan');
            $table->string('hari');
            $table->string('mata_pelajaran');
            $table->string('nama_guru');
            $table->time('mulai');
            $table->time('berakhir');
            $table->string('kode_unik')->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('qr_jadwal_pelajaran');
    }
};
