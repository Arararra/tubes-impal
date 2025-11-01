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

        $statuses = [
            'Pending' => 0.30,
            'Paid' => 0.20,
            'Processing' => 0.20,
            'Shipped' => 0.15,
            'Delivered' => 0.15,
        ];

        for ($i = 0; $i < 20; $i++) {
            $createdAt = $faker->dateTimeBetween('-30 days', 'now');

            $rand = $faker->randomFloat(2, 0, 1);
            $acc = 0;
            $status = 'Pending';
            foreach ($statuses as $s => $weight) {
                $acc += $weight;
                if ($rand <= $acc) {
                    $status = $s;
                    break;
                }
            }

            $paidDate = null;
            if ($status !== 'Pending') {
                $paidDate = $faker->dateTimeBetween($createdAt, 'now');
            }

            $shippingReceipt = null;
            if (in_array($status, ['Shipped', 'Delivered'], true)) {
                $shippingReceipt = strtoupper($faker->bothify('RESI#######'));
            }

            $minUpdated = $createdAt;
            if ($paidDate !== null && $paidDate > $minUpdated) {
                $minUpdated = $paidDate;
            }
            $updatedAt = $faker->dateTimeBetween($minUpdated, 'now');

            Order::create([
                'customer_name' => $faker->name(),
                'customer_address' => $faker->address(),
                'customer_whatsapp' => '62' . $faker->numerify('8##########'),
                'receipt' => strtoupper($faker->bothify('INV####')),
                'shipping_receipt' => $shippingReceipt,
                'status' => $status,
                'total' => $faker->numberBetween(50000, 200000),
                'paid_date' => $paidDate,
                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
            ]);
        }
    }
}
