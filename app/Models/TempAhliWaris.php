<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempAhliWaris extends Model
{
    use HasFactory;
    protected $table = 'temp_ahli_waris';
    protected $fillable = [
    	'ahli_waris_id',
    	'session',
    ];

    public function ahli_waris()
    {
    	return $this->belongsTo(AhliWaris::class);
    }
}
