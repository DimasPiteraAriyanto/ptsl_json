<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penlok extends Model
{
    use HasFactory;
    protected $dates = ['tanggal_sk_penlok'];
    protected $table = 'penlok';
    protected $fillable = [
    	'proyek_id',
    	'desa_id',
    	'jumlah_persil',
    	'no_sk_penlok',
    	'tanggal_sk_penlok',
    ];

    public function proyek()
    {
    	return $this->belongsTo(Proyek::class);
    }

    public function desa()
    {
    	return $this->belongsTo(Desa::class);
    }

    public function pemohon()
    {
        return $this->hasMany(Pemohon::class);
    }

    public function alas_hak()
    {
        return $this->hasMany(AlasHak::class);
    }
}
