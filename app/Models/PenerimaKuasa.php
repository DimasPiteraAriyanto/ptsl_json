<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenerimaKuasa extends Model
{
    use HasFactory;
    protected $table = 'penerima_kuasa';
    protected $fillable = [
    	'nik',
    	'no_telp',
    	'nama_penerima_kuasa',
    	'tempat_lahir',
    	'tanggal_lahir',
    	'pekerjaan',
    	'agama',
    	'jenis_kelamin',
    	'desa',
    	'kecamatan',
    	'kabupaten',
    ];

    public function temp_penerima_kuasa()
    {
        return $this->hasMany(TempPenerimaKuasa::class);
    }
}
