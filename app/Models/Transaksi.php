<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    //
    
    protected $fillable = [
        'user_id', 'barang_id', 'name_barang', 'jb', 'ht', 'change', 'pay', 'diskon', 'kode_member', 'pin_kasir'
    ];

    protected $guarded = [];

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])
            ->translatedFormat('1, d F Y');
    }

}
