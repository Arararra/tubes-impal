<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['title' => 'Roti Manis', 'image' => 'categories/roti-manis.jpg'],
            ['title' => 'Roti Tawar', 'image' => 'categories/roti-tawar.jpg'],
            ['title' => 'Kue Kering', 'image' => 'categories/kue-kering.jpg'],
            ['title' => 'Donat', 'image' => 'categories/donat.jpg'],
            ['title' => 'Pastry', 'image' => 'categories/pastry.jpg'],
        ];

        foreach ($categories as $c) {
            Category::create($c);
        }
    }
}
