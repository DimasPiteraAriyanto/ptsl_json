<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saksi extends Model
{
    use HasFactory;
    protected $table = 'saksi';
    protected $fillable = [
    	'nik',
    	'no_telp',
    	'nama_saksi',
    	'tempat_lahir',
    	'tanggal_lahir',
    	'pekerjaan',
    	'agama',
    	'jenis_kelamin',
    	'desa',
    	'kecamatan',
    	'kabupaten',
    ];

    public function temp_saksi()
    {
        return $this->hasMany(TempSaksi::class);
    }
}
