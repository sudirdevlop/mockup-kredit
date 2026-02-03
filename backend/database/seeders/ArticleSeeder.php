<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'author_id' => 1,
                'title' => 'Tips Memilih KPR yang Tepat untuk Anda',
                'slug' => 'tips-memilih-kpr-yang-tepat-untuk-anda',
                'excerpt' => 'Panduan lengkap memilih KPR yang sesuai dengan kondisi keuangan Anda',
                'content' => 'Memilih KPR yang tepat adalah keputusan penting dalam hidup. Berikut adalah beberapa tips yang perlu Anda perhatikan...',
                'status' => 'published',
                'published_at' => now()->subDays(5),
            ],
            [
                'author_id' => 1,
                'title' => '5 Kesalahan Umum dalam Mengajukan Kredit',
                'slug' => '5-kesalahan-umum-dalam-mengajukan-kredit',
                'excerpt' => 'Hindari kesalahan-kesalahan ini agar pengajuan kredit Anda disetujui',
                'content' => 'Banyak orang melakukan kesalahan saat mengajukan kredit yang membuat pengajuan mereka ditolak. Berikut adalah 5 kesalahan yang harus dihindari...',
                'status' => 'published',
                'published_at' => now()->subDays(3),
            ],
            [
                'author_id' => 1,
                'title' => 'Cara Meningkatkan Credit Score Anda',
                'slug' => 'cara-meningkatkan-credit-score-anda',
                'excerpt' => 'Tips praktis untuk meningkatkan skor kredit Anda',
                'content' => 'Credit score yang baik sangat penting untuk mendapatkan persetujuan kredit. Berikut cara-cara meningkatkannya...',
                'status' => 'published',
                'published_at' => now()->subDays(1),
            ],
        ];

        foreach ($articles as $article) {
            Article::create($article);
        }
    }
}
