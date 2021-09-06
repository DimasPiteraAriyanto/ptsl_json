<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    use HasFactory;
    protected $table = 'proyek';
    protected $fillable = [
        'nama_proyek',
    	'tahun'
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function ajudikasi()
    {
        return $this->hasMany(Ajudikasi::class);
    }

    public function penlok()
    {
        return $this->hasMany(Penlok::class);
    }
}
