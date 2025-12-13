<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('izin_medlicenses', function (Blueprint $table) {
            $table->enum('status_proses', ['ptsp', 'dinkes', 'kepala', 'selesai', 'ditolak'])
                ->default('ptsp')
                ->after('status'); // optional: taruh setelah kolom status
            $table->string('surat_rekomendasi_dinkes')
                ->nullable()
                ->after('surat_izin_profesi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('izin_medlicenses', function (Blueprint $table) {
            $table->dropColumn('status_proses');
        });
    }

};
