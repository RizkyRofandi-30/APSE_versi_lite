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
        Schema::create('berkas_apotik', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_healthygate')->constrained('izin_healthygates')->onDelete('cascade');
            $table->string('surat_permohonan');
            $table->string('ktp_pemilik');
            $table->string('npwp_pemilik');
            $table->string('nib');

            // Khusus Apotik (semua nullable sesuai permintaan)
            $table->string('sip_apt_jawab');
            $table->string('denah_lokasi');
            $table->string('denah_ruangan');
            $table->string('sip_asisten_apoteker');
            $table->string('daftar_peralatan_apotik');
            $table->string('rekom_puskesmas');
            $table->string('imb_pbg');
            $table->string('pbb_tahun');
            $table->string('sppl');
            $table->string('bpjs_apoteker');
            $table->string('bpjs_asisten');
            $table->string('bpjs_kesehatan_asisten');
            $table->string('pas_foto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berkas_apotik');
    }
};
