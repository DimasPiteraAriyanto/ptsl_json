<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PihakPertama extends Model
{
    use HasFactory;
    protected $dates = [
        'tanggal_lahir'
    ];
    protected $table = 'pihak_pertama';
    protected $fillable = [
    	'nik',
    	'no_telp',
    	'nama_pihak_pertama',
    	'tempat_lahir',
    	'tanggal_lahir',
    	'pekerjaan',
    	'agama',
    	'jenis_kelamin',
    	'desa',
    	'kecamatan',
    	'kabupaten',
    ];

    public function temp_pihak_pertama()
    {
        return $this->hasMany(TempPihakPertama::class);
    }
}
