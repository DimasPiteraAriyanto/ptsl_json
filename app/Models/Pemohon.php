<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemohon extends Model
{
    use HasFactory;
    protected $dates = [
        'tanggal_lahir'
    ];
    protected $table = 'pemohon';
    protected $fillable = [
    	'penlok_id',
    	'nob',
    	'doc',
    	'nik',
    	'no_telp',
    	'nama_pemohon',
    	'tempat_lahir',
    	'tanggal_lahir',
    	'pekerjaan',
    	'agama',
    	'jenis_kelamin',
    	'desa',
    	'kecamatan',
    	'kabupaten',
    	'jenis_pemohon',
    ];

    public function penlok()
    {
    	return $this->belongsTo(Penlok::class);
    }

    public function alas_hak()
    {
        return $this->hasMany(AlasHak::class);
    }
}
