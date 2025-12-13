<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerpanjanganHealthygate extends Model
{
    use HasFactory;

    protected $table = 'perpanjangan_healthygate';

    protected $fillable = [
        'id_healthygate',
        'izin_usaha_terbit'
    ];

    public function izinHealthygate() {
        return $this->belongsTo(IzinHealthygate::class, 'id_healthygate');
    }


}
