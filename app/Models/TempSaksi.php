<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempSaksi extends Model
{
    use HasFactory;
    protected $table = 'temp_saksi';
    protected $fillable = [
    	'saksi_id',
    	'session',
    ];

    public function saksi()
    {
    	return $this->belongsTo(Saksi::class);
    }
}
