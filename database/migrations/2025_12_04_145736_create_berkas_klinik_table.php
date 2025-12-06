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
        Schema::create('berkas_klinik', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_healthygate')->constrained('izin_healthygates')->onDelete('cascade');
            $table->string('surat_permohonan');
            $table->string('ktp_pemilik');
            $table->string('npwp_pemilik');
            $table->string('nib');

            $table->string('bpjs_pemilik');
            $table->string('daftar_obat');
            $table->string('surat_izin_tenaga_kesehatan');
            $table->string('perjanjian_limbah_b3');
            $table->string('deskripsi_pengorganisasian');
            $table->string('lokasi_bangunan');
            $table->string('prasarana_ketenagaan');
            $table->string('peralatan_kesehatan');
            $table->string('kefarmasian');
            $table->string('laboratorium');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berkas_klinik');
    }
};
