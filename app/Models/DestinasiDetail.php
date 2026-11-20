<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DestinasiDetail extends Model
{
    protected $table = 'destinasi_detail';

    protected $fillable = ['destinasi_id', 'urutan', 'paragraf'];

    protected $casts = ['urutan' => 'integer'];

    public function destinasi()
    {
        return $this->belongsTo(Destinasi::class);
    }
}
