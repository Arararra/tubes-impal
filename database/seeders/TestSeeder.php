<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tests')->insert(
            [
                'name' => 'Es ABCD Muthu',
                'description' => 'Es ABCD Muthu adalah minuman segar yang terbuat dari campuran es serut, sirup, susu kental manis, dan durian.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
