<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Single extends Model
{
    use HasFactory;
    
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
