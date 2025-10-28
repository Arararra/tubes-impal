<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'title',
        'image',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_categories');
    }
}
