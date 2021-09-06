<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisAlasHak extends Model
{
    use HasFactory;
    protected $table = 'jenis_alas_hak';
    protected $fillable = [
    	'nama_jenis_alas_hak',
    ];

    public function alas_hak()
    {
    	return $this->hasMany(AlasHak::class);
    }
}
