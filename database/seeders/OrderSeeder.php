<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use Faker\Factory as Faker;


class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 8; $i++) {
            $createdAt = $faker->dateTimeBetween('-30 days', 'now');
            $updatedAt = $faker->dateTimeBetween($createdAt, 'now');
            
            Order::create([
                'customer_name' => $faker->name(),
                'customer_address' => $faker->address(),
                'customer_whatsapp' => '62' . $faker->numerify('8##########'),
                'receipt' => strtoupper($faker->bothify('INV####')),
                'shipping_receipt' => $faker->optional()->bothify('RESI#######'),
                'status' => $faker->randomElement(['Pending', 'Paid', 'Processing', 'Shipped', 'Delivered']),
                'total' => $faker->numberBetween(50000, 200000),
                'paid_date' => $faker->optional()->dateTimeBetween('-5 days', 'now'),
                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
            ]);
        }
    }
}
