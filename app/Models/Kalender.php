<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kalender extends Model
{
    protected $table = 'kalender';

    protected $fillable = ['nama', 'tanggal_teks', 'tanggal_iso', 'keterangan', 'saran', 'sejarah'];
}
