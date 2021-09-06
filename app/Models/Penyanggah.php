<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyanggah extends Model
{
    use HasFactory;
    protected $table = 'penyanggah';
    protected $fillable = [
    	'nik',
    	'no_telp',
    	'nama_penyanggah',
    	'tempat_lahir',
    	'tanggal_lahir',
    	'pekerjaan',
    	'agama',
    	'jenis_kelamin',
    	'desa',
    	'kecamatan',
    	'kabupaten',
    ];

    public function temp_penyanggah()
    {
        return $this->hasMany(TempPenyanggah::class);
    }
}
