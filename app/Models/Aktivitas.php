<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aktivitas extends Model
{
    protected $table = 'aktivitas';

    protected $fillable = [
        'nama',
    ];

    public function destinasi()
    {
        return $this->belongsToMany(Destinasi::class, 'destinasi_aktivitas');
    }
}
