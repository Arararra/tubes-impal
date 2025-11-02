<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_name', 
        'customer_city',
        'customer_postcode',
        'customer_address',
        'customer_whatsapp',
        'receipt', 
        'shipping_receipt', 
        'status', 
        'total', 
        'paid_date',
        'xendit_id',
        'xendit_url'
    ];

    protected static function booted()
    {
        static::creating(function ($order) {
            // Generate resi (INV0001, INV0002, dst)
            if (empty($order->receipt)) {
                $lastId = static::max('id') ?? 0;
                $order->receipt = 'INV' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);
            }

            // Default status
            if (empty($order->status)) {
                $order->status = 'pending';
            }
        });

        static::saving(function ($order) {
            // Constraint 1: jika status bukan pending, paid_date wajib ada
            if ($order->status !== 'pending' && empty($order->paid_date)) {
                $order->paid_date = now();
            }

            // Constraint 2: jika shipping_receipt terisi, status harus shipped atau delivered
            if (!empty($order->shipping_receipt) && !in_array($order->status, ['shipped', 'delivered'])) {
                throw new \Exception('Status harus shipped atau delivered jika shipping_receipt terisi.');
            }
        });
    }

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
