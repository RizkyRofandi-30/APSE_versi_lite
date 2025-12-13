<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\MockObject\Stub\ReturnReference;

class IzinMedlicense extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'jenis_izin',
        'jenis_profesi',
        'tanggal_pengajuan',
        'status',
        'surat_izin_profesi',
        'keterangan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function berkasDokter()
    {
        return $this->hasOne(BerkasDokter::class, 'id_medlicense');
    }

    public function berkasPerawat()
    {
        return $this->hasOne(BerkasPerawat::class, 'id_medlicense');
    }

    public function berkasBidan()
    {
        return $this->hasOne(BerkasBidan::class, 'id_medlicense');
    }

    public function berkasApoteker()
    {
        return $this->hasOne(BerkasApoteker::class, 'id_medlicense');
    }

    public function berkasPerpanjangan(){
        return $this->hasOne(PerpanjanganMedlicense::class, 'id_medlicense');
    }
}
