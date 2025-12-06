<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerkasBidan extends Model
{
    use HasFactory;
    protected $table = 'berkas_bidan';
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
        'rekomendasi_ibi',
        'rekomendasi_puskesmas',
        'foto_tempat_praktik',
    ];

    public function izinMedlicense() {
        return $this->belongsTo(IzinMedlicense::class, 'id_medlicense');
    }
}
