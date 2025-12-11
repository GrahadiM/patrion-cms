<?php

namespace Database\Seeders;

use App\Models\Character;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CharacterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Character::create([
            'name' => 'KUNNA',
            'slug' => 'kunna',
            'full_name' => 'Kunna',
            'region' => 'Jawa Tengah',
            'philosophy' => 'Kunanti yang di Tata',
            'height' => '178 cm',
            'weight' => '77 kg',
            'artifact' => 'Topeng',
            'power' => 'Cahaya',
            'island' => 'Jawa',
            'origin' => 'Bantul',
            'dna' => 'Raja Jawa',
            'attitude' => 'Mewakili karakter Jawa',
            'character' => 'Ramah, Santun, Sabar, Ulet, Pintar, Mengutamakan Persatuan dan Adab',
            'colors' => ['#FF6B35', '#8B4513', '#FFD700'],
            'color_names' => ['Jingga', 'Coklat Tua', 'Kuning'],
            'image' => 'assets/images/characters/chara-01.png',
            'thumbnail' => 'assets/images/characters/thumb-chara-01.png',
            'video' => 'assets/video/character/patrion-kunna.mp4',
            'description' => 'KUNNA adalah karakter yang mewakili Jawa Tengah dengan filosofi "Kunanti yang di Tata". Dengan tinggi 178 cm dan berat 77 kg, KUNNA membawa artefak Topeng dan menguasai kekuatan Cahaya. Berasal dari Bantul, Jawa, KUNNA memiliki DNA Raja Jawa dan mewakili karakter Jawa yang ramah, santun, sabar, ulet, pintar, serta mengutamakan persatuan dan adab.',
            'status' => 'published',
            'order' => 1,
        ]);

        // Tambahkan karakter lain sesuai kebutuhan
        Character::create([
            'name' => 'WABU',
            'slug' => 'wabu',
            'full_name' => 'Wabu',
            'region' => 'Sumatera Barat',
            'philosophy' => 'Waris Budaya yang Utuh',
            'height' => '175 cm',
            'weight' => '72 kg',
            'artifact' => 'Keris',
            'power' => 'Angin',
            'island' => 'Sumatera',
            'origin' => 'Bukittinggi',
            'dna' => 'Panglima Minang',
            'attitude' => 'Mewakili karakter Minang',
            'character' => 'Tegas, Berani, Cerdas, Setia, Pantang Menyerah',
            'colors' => ['#2E8B57', '#8B0000', '#DAA520'],
            'color_names' => ['Hijau', 'Merah Tua', 'Emas'],
            'image' => 'assets/images/characters/chara-02.png',
            'thumbnail' => 'assets/images/characters/thumb-chara-02.png',
            'video' => 'assets/video/character/patrion-wabu.mp4',
            'description' => 'WABU adalah karakter yang mewakili Sumatera Barat dengan filosofi "Waris Budaya yang Utuh".',
            'status' => 'published',
            'order' => 2,
        ]);
    }
}
