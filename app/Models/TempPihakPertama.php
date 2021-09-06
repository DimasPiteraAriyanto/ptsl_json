<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempPihakPertama extends Model
{
    use HasFactory;
    protected $table = 'temp_pihak_pertama';
    protected $fillable = [
    	'pihak_pertama_id',
    	'session',
    ];

    public function pihak_pertama()
    {
    	return $this->belongsTo(PihakPertama::class);
    }
}
