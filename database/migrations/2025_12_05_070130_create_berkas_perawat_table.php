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
        Schema::create('berkas_perawat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_medlicense')->constrained('izin_medlicenses')->onDelete('cascade');
            
            // Dokumen wajib umum
            $table->string('surat_permohonan');
            $table->string('ktp');
            $table->string('str');
            $table->string('ijazah');
            $table->string('surat_sehat');
            $table->string('pas_foto');
            $table->string('npwp');
            $table->string('bpjs_ketenagakerjaan');
            $table->string('bpjs_kesehatan');
            
            // Dokumen spesifik perawat
            $table->string('rekomendasi_ppni');
            $table->string('rekomendasi_puskesmas');
            $table->string('foto_tempat_praktik');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berkas_perawat');
    }
};
