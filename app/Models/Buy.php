<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class Buy extends Model
{
    //

    protected $fillable = [
        'supplier', 'barang', 'harga_barang', 'tbarang', 'tbayar'
    ];

    protected $guarded = [];

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])
            ->translatedFormat('1, d F Y');
    }
}
