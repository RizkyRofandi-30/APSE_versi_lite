<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerkasDokter extends Model
{
    use HasFactory;

    protected $table = 'berkas_dokter';

    protected $fillable = [
        'id_medlicense',
        'surat_permohonan',
        'ktp',
        'str',
        'ijazah',
        'surat_sehat',
        'pas_foto',
        'npwp',
        'bpjs_ketenagakerjaan',
        'bpjs_kesehatan',

        // Dokumen dokter
        'sip_dokter',
        'rekomendasi_idi',
        'foto_tempat_praktik',
        'rekomendasi_puskesmas',
    ];

    public function izinMedlicense() {
        return $this->belongsTo(IzinMedlicense::class, 'id_medlicense');
    }

}
