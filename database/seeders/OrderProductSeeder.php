<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProduct;

class OrderProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = Order::all();
        $products = Product::all();

        foreach ($orders as $order) {
            $selected = $products->random(rand(1, 3));
            foreach ($selected as $product) {
                OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => rand(1, 5),
                'price' => $product->price,
                ]);
            }
        }
    }
}
