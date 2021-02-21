<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    //
    
    protected $fillable = [
        'name','out','alamat','phone_number',
    ];

    protected $guarded = [];

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])
            ->translatedFormat('1, d F Y');
    }

}
