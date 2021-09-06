<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlasHak extends Model
{
    use HasFactory;
    protected $dates = [
        'tanggal_meninggal'
    ];
    protected $table = 'alas_hak';
    protected $fillable = [
    	'penlok_id',
    	'jenis_alas_hak_id',
    	'pemohon_id',
    	'nob',
    	'klaster',
    	'status_surat',
    	'jenis_hak',
    	'nama_alas_hak',
    	'no_alas_hak',
    	'tanggal_alas_hak',
    	'pembuat_alas_hak',
    	'luas_yang_dimohon',
    	'utara',
    	'timur',
    	'selatan',
    	'barat',
    	'harga',
    	'nama_almarhum',
    	'tanggal_meninggal',
    	'desa_meninggal',
    	'kecamatan_meninggal',
    	'kabupaten_meninggal',
    	'desa_tinggal',
    	'kecamatan_tinggal',
    	'kabupaten_tinggal',
    	'perkawinan_dengan',
    	'session',
    ];

    public function pemohon()
    {
    	return $this->belongsTo(Pemohon::class);
    }

    public function jenis_alas_hak()
    {
    	return $this->belongsTo(JenisAlasHak::class);
    }

    public function penlok()
    {
        return $this->belongsTo(Penlok::class);
    }
}
