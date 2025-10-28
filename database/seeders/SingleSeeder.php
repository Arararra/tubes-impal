<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Single;

class SingleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // About Page
        Single::create([
            'title' => 'About Us',
            'slug' => 'about',
            'body' => 'Kami adalah toko roti lokal yang menyajikan roti segar setiap hari. Mengutamakan rasa, kualitas, dan pelayanan terbaik.',
            'accordions' => [],
        ]);

        // FAQ Page
        Single::create([
            'title' => 'FAQ',
            'slug' => 'faq',
            'accordions' => [
                ['title' => 'Apakah roti dibuat setiap hari?', 'body' => 'Ya, semua roti dibuat segar setiap pagi.'],
                ['title' => 'Apakah tersedia layanan antar?', 'body' => 'Ya, kami melayani pengantaran ke wilayah kota.'],
                ['title' => 'Apakah menerima pesanan custom cake?', 'body' => 'Tentu! Silakan hubungi kami via WhatsApp.'],
            ],
        ]);
    }
}
