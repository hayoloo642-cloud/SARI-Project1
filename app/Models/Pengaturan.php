<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    protected $table = 'pengaturan';

    protected $primaryKey = 'key';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['key', 'value'];
}
