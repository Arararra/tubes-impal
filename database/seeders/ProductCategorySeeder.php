<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductCategory;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $map = [
            'Roti Manis' => ['Roti Coklat Lumer', 'Roti Keju Susu'],
            'Roti Tawar' => ['Roti Tawar Gandum', 'Roti Tawar Putih'],
            'Kue Kering' => ['Kastengel', 'Nastar Keju'],
            'Donat' => ['Donat Gula', 'Donat Coklat'],
            'Pastry' => ['Croissant Mentega', 'Apple Pie Mini'],
        ];

        foreach ($map as $categoryName => $productTitles) {
            $category = Category::where('title', $categoryName)->first();

            foreach ($productTitles as $title) {
                $product = Product::where('title', $title)->first();

                if ($product && $category) {
                    ProductCategory::create([
                        'product_id' => $product->id,
                        'category_id' => $category->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
