<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'KPR (Kredit Pemilikan Rumah)',
                'slug' => 'kpr-kredit-pemilikan-rumah',
                'description' => 'Kredit untuk pembelian rumah atau properti',
                'icon' => 'home',
            ],
            [
                'name' => 'KTA (Kredit Tanpa Agunan)',
                'slug' => 'kta-kredit-tanpa-agunan',
                'description' => 'Kredit tanpa jaminan untuk berbagai kebutuhan',
                'icon' => 'cash',
            ],
            [
                'name' => 'Kartu Kredit',
                'slug' => 'kartu-kredit',
                'description' => 'Kartu kredit untuk transaksi dan cicilan',
                'icon' => 'credit-card',
            ],
            [
                'name' => 'Kredit Kendaraan',
                'slug' => 'kredit-kendaraan',
                'description' => 'Kredit untuk pembelian mobil atau motor',
                'icon' => 'car',
            ],
            [
                'name' => 'Kredit Multiguna',
                'slug' => 'kredit-multiguna',
                'description' => 'Kredit untuk berbagai keperluan dengan agunan',
                'icon' => 'wallet',
            ],
        ];

        foreach ($categories as $category) {
            ProductCategory::create($category);
        }
    }
}
