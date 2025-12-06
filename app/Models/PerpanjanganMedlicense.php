<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PerpanjanganMedlicense extends Model
{
    use HasFactory;

    protected $table = 'perpanjangan_medlicense';

    protected $fillable = [
        'id_medlicense',
        'izin_profesi_terbit'
    ];

    public function perpanjanganMedlicense() {
        return $this->belongsTo(IzinMedlicense::class, 'id_medlicense');
    }
}
