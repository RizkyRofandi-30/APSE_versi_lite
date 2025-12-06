<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\MockObject\Stub\ReturnReference;

class IzinHealthygate extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_user',
        'jenis_izin',
        'jenis_usaha',
        'tanggal_pengajuan',
        'status',
        'surat_izin_usaha'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function berkasKlinik()
    {
        return $this->hasOne(BerkasKlinik::class, 'id_healthygate');
    }

    // Relationship dengan berkas apotik
    public function berkasApotik()
    {
        return $this->hasOne(BerkasApotik::class, 'id_healthygate');
    }

    public function berkasPerpanjangan(){
        return $this->hasOne( PerpanjanganHealthygate::class,'id_healthygate');
    }
}
