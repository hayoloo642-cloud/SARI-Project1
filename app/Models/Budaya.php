<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Budaya extends Model
{
    protected $table = 'budaya';

    protected $fillable = ['slug', 'judul', 'ringkas', 'detail'];

    public function destinasi()
    {
        return $this->belongsToMany(Destinasi::class, 'destinasi_budaya');
    }
}
