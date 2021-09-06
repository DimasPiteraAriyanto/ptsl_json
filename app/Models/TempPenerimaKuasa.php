<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempPenerimaKuasa extends Model
{
    use HasFactory;
    protected $table = 'temp_penerima_kuasa';
    protected $fillable = [
    	'penerima_kuasa_id',
    	'session',
    ];

    public function penerima_kuasa()
    {
    	return $this->belongsTo(PenerimaKuasa::class);
    }
}
