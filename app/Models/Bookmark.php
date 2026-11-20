<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $table = 'bookmark';

    protected $fillable = ['user_id', 'destinasi_id', 'tgl_rencana'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function destinasi()
    {
        return $this->belongsTo(Destinasi::class);
    }
}
