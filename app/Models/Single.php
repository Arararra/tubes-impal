<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Single extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'image',
        'body',
        'accordions',
    ];

    protected $casts = [
        'accordions' => 'array',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
