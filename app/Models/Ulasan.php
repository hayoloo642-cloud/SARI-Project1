<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    protected $table = 'ulasan';

    protected $fillable = ['destinasi_id', 'nama_pengunjung', 'rating', 'komentar', 'status'];

    protected $casts = ['rating' => 'integer'];

    public function destinasi()
    {
        return $this->belongsTo(Destinasi::class);
    }
}
