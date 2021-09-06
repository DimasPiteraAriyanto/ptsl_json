<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempPersetujuanKeluarga extends Model
{
    use HasFactory;
    protected $table = 'temp_persetujuan_keluarga';
    protected $fillable = [
    	'persetujuan_keluarga_id',
    	'session',
    ];

    public function persetujuan_keluarga()
    {
    	return $this->belongsTo(PersetujuanKeluarga::class);
    }
}
