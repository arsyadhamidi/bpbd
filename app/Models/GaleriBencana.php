<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriBencana extends Model
{
    use HasFactory;

    protected $table = "galeri_bencanas";
    protected $guarded = [];
    public $timestamps = false;

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'lokasi_id');
    }
}
