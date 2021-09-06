<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AhliWaris extends Model
{
    use HasFactory;
    protected $table = 'ahli_waris';
    protected $fillable = [
    	'nik',
    	'no_telp',
    	'nama_ahli_waris',
    	'tempat_lahir',
    	'tanggal_lahir',
    	'pekerjaan',
    	'agama',
    	'jenis_kelamin',
    	'desa',
    	'kecamatan',
    	'kabupaten',
    ];

    public function temp_ahli_waris()
    {
        return $this->hasMany(TempAhliWaris::class);
    }
}
