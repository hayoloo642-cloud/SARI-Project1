<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DestinasiGambar extends Model
{
    protected $table = 'destinasi_gambar';

    protected $fillable = ['destinasi_id', 'path', 'alt', 'is_utama', 'kredit', 'sumber_url'];

    protected $casts = ['is_utama' => 'boolean'];

    public function destinasi()
    {
        return $this->belongsTo(Destinasi::class);
    }
}
