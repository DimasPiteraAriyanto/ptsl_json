<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    use HasFactory;
    protected $table = 'desa';
    protected $fillable = [
    	'kecamatan_id',
    	'kode_desa',
        'nama_desa',
    	'reje_kampung',
    	'nama_camat',
    	'nip',
    	'alamat',
    	'kode_pos',
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function penlok()
    {
        return $this->hasMany(Penlok::class);
    }
}
