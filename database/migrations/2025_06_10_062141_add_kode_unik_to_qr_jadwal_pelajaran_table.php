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
        // Schema::table('qr_jadwal_pelajaran', function (Blueprint $table) {
        //     $table->string('kode_unik')->unique()->nullable();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('qr_jadwal_pelajaran', function (Blueprint $table) {
            //
        });
    }
};
