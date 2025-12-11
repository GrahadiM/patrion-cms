<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Program::create([
            'title' => 'Film Cinema - Drama Live Action',
            'slug' => 'film-cinema-drama-live-action',
            'description' => 'Film epik live action yang mengangkat mitologi Nusantara dengan teknologi visual effects terkini.',
            'synopsis' => 'Film ini mengisahkan petualangan epik para Guardian Elements dalam mempertahankan keseimbangan alam semesta PATRION dari ancaman Dark Void. Dengan visual effects mengagumkan dan cerita yang mendalam, film ini menghadirkan pengalaman cinematic yang belum pernah ada sebelumnya di Indonesia.',
            'thumbnail' => 'assets/images/semesta/Thumbnail-Patrion-Movie.png',
            'image' => 'assets/images/semesta/Patrion-Movie-Full.png',
            'trailer' => 'assets/video/trailer-cinema.mp4',
            'platform' => 'cinema',
            'status' => 'upcoming',
            'release_date' => 'Q4 2024',
            'duration' => '120 menit',
            'rating' => 'PG-13',
            'director' => 'Abdurrahman GM',
            'budget' => '$15M',
            'episodes' => 1,
            'views' => 0,
            'characters' => ['kunna', 'wabu', 'asta', 'taran'],
            'platforms' => [
                ['name' => 'Cinema 21', 'type' => 'cinema', 'icon' => 'fas fa-film'],
                ['name' => 'Netflix', 'type' => 'ott', 'icon' => 'fas fa-tv']
            ],
            'production' => [
                'studio' => 'Nusantara Cinema',
                'timeline' => '18 months',
                'locations' => ['Bali', 'Yogyakarta', 'Raja Ampat'],
                'vfx' => 'Industrial Light & Magic'
            ],
            'gallery' => [
                ['src' => 'assets/images/gallery/cinema-1.jpg', 'type' => 'stills', 'caption' => 'Kunna in battle'],
                ['src' => 'assets/images/gallery/cinema-2.jpg', 'type' => 'behind', 'caption' => 'Behind the scenes'],
                ['src' => 'assets/images/gallery/cinema-3.jpg', 'type' => 'concept', 'caption' => 'Concept art']
            ],
            'order' => 1,
        ]);

        // Tambahkan program lain
        Program::create([
            'title' => 'Serial Animasi - Petualangan Guardian',
            'slug' => 'serial-animasi-petualangan-guardian',
            'description' => 'Serial animasi petualangan Guardian Elements di alam semesta Patrion.',
            'platform' => 'streaming',
            'status' => 'ongoing',
            'episodes' => 12,
            'order' => 2,
        ]);
    }
}
