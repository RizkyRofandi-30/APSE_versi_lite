<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerkasApoteker extends Model
{
    use HasFactory;

    protected $table = 'berkas_apoteker';

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
        'rekomendasi_iai',
        'surat_tempat_kerja',
    ];

    public function izinMedlicense() {
        return $this->belongsTo(IzinMedlicense::class, 'id_medlicense');
    }
}
