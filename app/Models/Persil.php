<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persil extends Model
{
    use HasFactory;
    protected $table = 'persil';
    protected $fillable = [
        'pemohon_id',
        'penlok_id',
        'ajudikasi_id',
        'alas_hak_id',
        'nub',
        'doc',
        'tanda_batas',
        'luas_pengukuran',
        'penggunaan_tanah',
        'no_pbt',
        'no_gu',
        'no_berkas_fisik',
        'nib',
    ];

    public function penlok()
    {
        return $this->belongsTo(Penlok::class);
    }

    public function pemohon()
    {
        return $this->belongsTo(Pemohon::class);
    }

    public function alas_hak()
    {
        return $this->hasMany(AlasHak::class);
    }

    public function ajudikasi()
    {
        return $this->belongsTo(Ajudikasi::class);
    }
}
