<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use Faker\Factory as Faker;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $orders = Order::inRandomOrder()->take(5)->get();
        $products = Product::all();

        foreach ($orders as $order) {
            $product = $products->random();
            Review::create([
                'title' => 'Ulasan untuk ' . $product->title,
                'body' => $faker->paragraph(),
                'rating' => rand(4, 5),
                'order_id' => $order->id,
                'product_id' => $product->id,
            ]);
        }
    }
}
