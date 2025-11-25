<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Tensimeter Digital',
            'description' => 'Alat ukur tekanan darah digital untuk penggunaan rumahan.',
            'price' => 350000,
            'stock' => 20,
        ]);

        Product::create([
            'name' => 'Masker Medis 3 Ply (Box 50 pcs)',
            'description' => 'Masker medis sekali pakai isi 50 pcs.',
            'price' => 45000,
            'stock' => 100,
        ]);

        Product::create([
            'name' => 'Hand Sanitizer 500 ml',
            'description' => 'Hand sanitizer alkohol 70% botol 500 ml.',
            'price' => 25000,
            'stock' => 50,
        ]);

        Product::create([
            'name' => 'Tensimeter Digital',
            'description' => 'Alat ukur tekanan darah digital untuk penggunaan rumahan.',
            'price' => 350000,
            'stock' => 20,
        ]);

        Product::create([
            'name' => 'Sarung Tangan Medis Latex (Box 100)',
            'description' => 'Sarung tangan medis sekali pakai untuk kebutuhan klinis.',
            'price' => 75000,
            'stock' => 40,
        ]);

        Product::create([
            'name' => 'Alat Cek Gula Darah',
            'description' => 'Glucometer praktis untuk memantau kadar gula darah di rumah.',
            'price' => 420000,
            'stock' => 15,
        ]);

        Product::create([
            'name' => 'Alat Cek Kolesterol',
            'description' => 'Alat cek kolesterol portabel dengan hasil cepat.',
            'price' => 480000,
            'stock' => 10,
        ]);

        Product::create([
            'name' => 'Korset Penyangga Punggung',
            'description' => 'Korset penyangga untuk membantu mengurangi nyeri punggung.',
            'price' => 230000,
            'stock' => 18,
        ]);

        Product::create([
            'name' => 'Kursi Roda Lipat',
            'description' => 'Kursi roda lipat yang ringan dan mudah dibawa.',
            'price' => 1500000,
            'stock' => 5,
        ]);
    }
}
