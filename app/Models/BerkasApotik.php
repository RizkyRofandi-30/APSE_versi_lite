<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerkasApotik extends Model
{
    use HasFactory;

    protected $table = 'berkas_apotik';

    protected $fillable = [
        'id_healthygate',
        'surat_permohonan',
        'ktp_pemilik',
        'npwp_pemilik',
        'nib',
        'sip_apt_jawab',
        'denah_lokasi',
        'denah_ruangan',
        'sip_asisten_apoteker',
        'daftar_peralatan_apotik',
        'rekom_puskesmas',
        'imb_pbg',
        'pbb_tahun',
        'sppl',
        'bpjs_apoteker',
        'bpjs_asisten',
        'bpjs_kesehatan_asisten',
        'pas_foto'
    ];

    public function izinHealthygate() {
        return $this->belongsTo(IzinHealthygate::class);
    }
}
