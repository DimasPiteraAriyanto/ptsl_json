<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersetujuanKeluarga extends Model
{
    use HasFactory;
    protected $table = 'persetujuan_keluarga';
    protected $fillable = [
    	'nik',
    	'no_telp',
    	'nama_persetujuan_keluarga',
    	'tempat_lahir',
    	'tanggal_lahir',
    	'pekerjaan',
    	'agama',
    	'jenis_kelamin',
    	'desa',
    	'kecamatan',
    	'kabupaten',
    ];

    public function temp_persetujuan_keluarga()
    {
        return $this->hasMany(TempPersetujuanKeluarga::class);
    }
}
