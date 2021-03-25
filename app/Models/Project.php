<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = "projects";

    protected $fillable = [
        'title', 'avatar', 'desc', 'like'
    ];

    public function getCreatedAtFormattedAttribute()
    {
        return $this->created_at->format('H:i d, M Y');
    }



    public function getUpdatedAtFormattedAttribute()
    {
        return $this->updated_at->format('H:i d, M Y');
    }


    // public $timestamps = false;
}
