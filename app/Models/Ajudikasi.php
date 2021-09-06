<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ajudikasi extends Model
{
    use HasFactory;
    protected $table = 'ajudikasi';
    protected $fillable = [
    	'proyek_id',
    	'nip',
    	'nama_pegawai',
    	'golongan',
    	'jabatan_ajudikasi',
    ];

    public function proyek()
    {
    	return $this->belongsTo(Proyek::class);
    }
}
