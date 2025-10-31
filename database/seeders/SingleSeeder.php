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
            'body' => '<p>Kami adalah toko roti lokal yang berkomitmen menghadirkan roti segar setiap hari untuk pelanggan kami. Setiap roti dibuat dengan bahan pilihan berkualitas tinggi dan diproses dengan penuh ketelitian agar menghasilkan cita rasa yang lezat dan konsisten.&nbsp;</p><p>Lebih dari sekadar toko roti, kami ingin menjadi bagian dari momen hangat di setiap meja keluarga. Dengan pelayanan yang ramah dan suasana yang nyaman, kami percaya bahwa setiap potongan roti adalah wujud dari dedikasi kami terhadap rasa, kualitas, dan kepuasan pelanggan.</p>',
            'accordions' => [],
        ]);

        // FAQ Page
        Single::create([
            'title' => 'FAQ',
            'slug' => 'faq',
            'body' => '<p>Berikut adalah jawaban dari beberapa pertanyaan umum yang mungkin bisa membantu anda. Jika jawaban berikut kurang menjawab, anda bisa bertanya langsung ke kami via WhatsApp. 😄</p>',
            'accordions' => [
                ['title' => 'Apakah roti dibuat setiap hari?', 'body' => 'Ya, semua roti dibuat segar setiap pagi.'],
                ['title' => 'Apakah tersedia layanan antar?', 'body' => 'Ya, kami melayani pengantaran ke wilayah kota.'],
                ['title' => 'Apakah menerima pesanan custom cake?', 'body' => 'Tentu! Silakan hubungi kami via WhatsApp.'],
            ],
        ]);
    }
}
