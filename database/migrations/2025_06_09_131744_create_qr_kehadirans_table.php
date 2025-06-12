<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('qr_kehadiran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('qr_jadwal_pelajaran_id');
            $table->timestamp('waktu_scan')->nullable();
            $table->enum('status_kehadiran', ['hadir', 'tidak hadir'])->default('hadir');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('qr_jadwal_pelajaran_id')->references('id')->on('qr_jadwal_pelajaran')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('qr_kehadiran');
    }
};
