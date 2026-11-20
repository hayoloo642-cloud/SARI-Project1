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
        'pengelola_nama',
        'pengelola_wa',
        'pengelola_foto',
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

    public function detail()
    {
        return $this->hasMany(DestinasiDetail::class)->orderBy('urutan');
    }

    public function galeri()
    {
        return $this->hasMany(DestinasiGambar::class)->orderByDesc('is_utama');
    }

    public function highlight()
    {
        return $this->hasMany(DestinasiHighlight::class)->orderBy('urutan');
    }

    public function aktivitas()
    {
        return $this->belongsToMany(Aktivitas::class, 'destinasi_aktivitas');
    }

    public function budaya()
    {
        return $this->belongsToMany(Budaya::class, 'destinasi_budaya');
    }

    public function ulasan()
    {
        return $this->hasMany(Ulasan::class);
    }
}
