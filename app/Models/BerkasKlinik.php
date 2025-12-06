<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerkasKlinik extends Model
{
    use HasFactory;

    protected $table = 'berkas_klinik';

    protected $fillable = [
        'id_healthygate', // Ganti izin_healthygate_id dengan id_healthygate
        'surat_permohonan',
        'ktp_pemilik',
        'npwp_pemilik',
        'nib',
        'bpjs_pemilik',
        'daftar_obat',
        'surat_izin_tenaga_kesehatan',
        'perjanjian_limbah_b3',
        'deskripsi_pengorganisasian',
        'lokasi_bangunan',
        'prasarana_ketenagaan',
        'peralatan_kesehatan',
        'kefarmasian',
        'laboratorium'
    ];

    // Perbaikan relationship
    public function izinHealthygate() {
        return $this->belongsTo(IzinHealthygate::class, 'id_healthygate');
    }
}