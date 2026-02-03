<?php

namespace Database\Seeders;

use App\Models\YoutubeVideo;
use Illuminate\Database\Seeder;

class YoutubeVideoSeeder extends Seeder
{
    public function run(): void
    {
        $videos = [
            [
                'title' => 'Cara Mengajukan KPR untuk Pemula',
                'description' => 'Tutorial lengkap mengajukan KPR dari awal hingga akhir',
                'youtube_id' => 'dQw4w9WgXcQ',
                'thumbnail_url' => 'https://img.youtube.com/vi/dQw4w9WgXcQ/maxresdefault.jpg',
                'category' => 'Tutorial',
                'duration' => 600,
                'is_featured' => true,
            ],
            [
                'title' => 'Tips Meningkatkan Credit Score',
                'description' => 'Strategi efektif untuk meningkatkan skor kredit Anda',
                'youtube_id' => 'dQw4w9WgXcQ',
                'thumbnail_url' => 'https://img.youtube.com/vi/dQw4w9WgXcQ/maxresdefault.jpg',
                'category' => 'Tips Kredit',
                'duration' => 480,
                'is_featured' => false,
            ],
            [
                'title' => 'Memahami Bunga Kredit',
                'description' => 'Penjelasan lengkap tentang bunga kredit dan cara menghitungnya',
                'youtube_id' => 'dQw4w9WgXcQ',
                'thumbnail_url' => 'https://img.youtube.com/vi/dQw4w9WgXcQ/maxresdefault.jpg',
                'category' => 'Edukasi',
                'duration' => 720,
                'is_featured' => true,
            ],
        ];

        foreach ($videos as $video) {
            YoutubeVideo::create($video);
        }
    }
}
