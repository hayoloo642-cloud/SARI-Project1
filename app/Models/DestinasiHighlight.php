<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DestinasiHighlight extends Model
{
    protected $table = 'destinasi_highlight';

    protected $fillable = ['destinasi_id', 'urutan', 'teks'];

    protected $casts = ['urutan' => 'integer'];

    public function destinasi()
    {
        return $this->belongsTo(Destinasi::class);
    }
}
