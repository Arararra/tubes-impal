<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 
        'image', 
        'body', 
        'price', 
        'stock'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
