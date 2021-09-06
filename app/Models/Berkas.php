<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berkas extends Model
{
    use HasFactory;
    protected $table = 'berkas';
    protected $fillable = [
        'penlok_id',
        'no_berkas',
    ];

    public function penlok()
    {
        return $this->belongsTo(Penlok::class);
    }

    public function alas_hak()
    {
        return $this->hasMany(AlasHak::class);
    }
}
