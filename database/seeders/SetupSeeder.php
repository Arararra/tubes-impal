<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@impal.com',
            'password' => Hash::make('admin123'),
        ]);
        
        DB::table('tests')->insert([
            'name' => 'Es ABCD Muthu',
            'description' => 'Es ABCD Muthu adalah minuman segar yang terbuat dari campuran es serut, sirup, susu kental manis, dan durian.',
        ]);
    }
}
