<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempPenyanggah extends Model
{
    use HasFactory;
    protected $table = 'temp_penyanggah';
    protected $fillable = [
    	'penyanggah_id',
    	'session',
    ];

    public function penyanggah()
    {
    	return $this->belongsTo(Penyanggah::class);
    }
}
