<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatistikKunjungan extends Model
{
    protected $table = 'statistik_kunjungan';

    protected $fillable = ['destinasi_id', 'tanggal', 'jumlah'];

    protected $casts = ['jumlah' => 'integer', 'tanggal' => 'date'];

    public function destinasi()
    {
        return $this->belongsTo(Destinasi::class);
    }
}
