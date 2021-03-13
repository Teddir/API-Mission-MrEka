<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Cart extends Model
{
    protected $table = "carts";

    protected $fillable = [
        'id', 'barang', 'barcode', 'qty', 'subtotal', 'barang_id',
    ];

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])
            ->translatedFormat('1, d F Y');
    }

    // public $timestamps = false;

    public function barangs()
    {
        return $this->hasMany(Barang::class, 'id', 'barang_id');
    }
}
