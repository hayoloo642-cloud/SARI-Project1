<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destinasi extends Model
{
    protected $table = 'destinasi';

    protected $fillable = [
        'slug',
        'wilayah_id',
        'nama',
        'kategori',
        'deskripsi',
        'waktu_terbaik',
        'jam_buka',
        'tarif',
        'cara_masuk',
        'etika',
        'whatsapp',
        'kontak',
        'rating_awal',
        'gambar',
        'is_unggulan',
        'status',
        'latitude',
        'longitude',
        'maps_url',
        'user_id',
    ];

    protected $casts = [
        'rating_awal' => 'float',
        'latitude' => 'float',
        'longitude' => 'float',
        'is_unggulan' => 'boolean',
    ];

    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class);
    }

    public function pengguna()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
