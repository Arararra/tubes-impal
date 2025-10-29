<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['title' => 'Roti Coklat Lumer', 'price' => 15000, 'stock' => 30, 'image' => 'products/roti-coklat.jpg'],
            ['title' => 'Roti Keju Susu', 'price' => 17000, 'stock' => 25, 'image' => 'products/roti-keju.jpg'],
            ['title' => 'Nastar Keju', 'price' => 32000, 'stock' => 45, 'image' => 'products/nastar.jpg'],
            ['title' => 'Roti Tawar Gandum', 'price' => 20000, 'stock' => 40, 'image' => 'products/roti-gandum.jpg'],
            ['title' => 'Roti Tawar Putih', 'price' => 18000, 'stock' => 50, 'image' => 'products/roti-putih.jpg'],
            ['title' => 'Kastengel', 'price' => 30000, 'stock' => 60, 'image' => 'products/kastengel.jpg'],
            ['title' => 'Donat Gula', 'price' => 10000, 'stock' => 100, 'image' => 'products/donat-gula.jpg'],
            ['title' => 'Donat Coklat', 'price' => 12000, 'stock' => 80, 'image' => 'products/donat-coklat.jpg'],
            ['title' => 'Croissant Mentega', 'price' => 25000, 'stock' => 35, 'image' => 'products/croissant.jpg'],
            ['title' => 'Apple Pie Mini', 'price' => 28000, 'stock' => 40, 'image' => 'products/apple-pie.jpg'],
        ];

        foreach ($products as $item) {
            Product::create([
                ...$item,
                'body' => 'Lezat dan dibuat dari bahan-bahan berkualitas tinggi.',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
