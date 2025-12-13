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
        Schema::table('izin_healthygates', function (Blueprint $table) {
            $table->enum('status_proses', ['ptsp', 'dinkes', 'kepala', 'selesai', 'ditolak'])
                ->default('ptsp')
                ->after('status');
            $table->string('surat_rekomendasi_dinkes')
                ->nullable()
                ->after('surat_izin_usaha');  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('izin_healthygates', function (Blueprint $table) {
            $table->dropColumn('status_proses');
            $table->dropColumn('surat_rekomendasi_dinkes');
        });
    }
};
