<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_name', 
        'customer_address', 
        'customer_whatsapp',
        'receipt', 
        'shipping_receipt', 
        'status', 
        'total', 
        'paid_date'
    ];

    protected $casts = [
        'paid_date' => 'datetime',
    ];

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getRouteKeyName()
    {
        return 'receipt';
    }
}
