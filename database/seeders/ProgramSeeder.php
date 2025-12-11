<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        $programs = [
            [
                'title' => 'Film Cinema - Drama Live Action',
                'description' => 'Menceritakan background masing-masing patrion dari daerah mereka. Bagaimana mereka bisa menjadi patrion dengan masalah yang dihadapi mereka.',
                'synopsis' => 'Film ini menceritakan asal-usul dan perjalanan masing-masing Patrion dari daerah mereka. Bagaimana mereka menghadapi berbagai masalah dan tantangan sebelum akhirnya menjadi Patrion sejati yang siap melindungi Nusantara.',
                'image' => 'programs/Thumbnail-Patrion-Movie.png',
                'thumbnail' => 'programs/thumbnails/Thumbnail-Patrion-Movie.png',
                'platform' => 'cinema',
                'status' => 'upcoming',
                'release_date' => 'Q4 2024',
                'duration' => '120 menit',
                'rating' => 'PG-13',
                'director' => 'Abdurrahman GM',
                'budget' => '$15M',
                'trailer' => 'programs/trailers/01_Live_action.mp4',
                'episodes' => 1,
                'views' => 0,
                'characters' => ['kunna', 'wabu', 'asta', 'taran', 'sanu', 'kabi'],
                'platforms' => [
                    ['name' => 'CGV Cinemas', 'type' => 'cinema', 'icon' => 'fas fa-film'],
                    ['name' => 'Cinema 21', 'type' => 'cinema', 'icon' => 'fas fa-film'],
                    ['name' => 'Netflix', 'type' => 'ott', 'icon' => 'fas fa-tv']
                ],
                'production' => [
                    'studio' => 'Nusantara Cinema Productions',
                    'timeline' => '24 months',
                    'locations' => ['Yogyakarta', 'Bali', 'Jakarta', 'Bandung'],
                    'vfx' => 'Industrial Light & Magic',
                    'language' => 'Bahasa Indonesia',
                    'format' => '4K Digital'
                ],
                'gallery' => [
                    ['src' => 'programs/gallery/cinema-1.jpg', 'type' => 'stills', 'caption' => 'Kunna in traditional costume'],
                    ['src' => 'programs/gallery/cinema-2.jpg', 'type' => 'behind', 'caption' => 'Behind the scenes - action sequence'],
                    ['src' => 'programs/gallery/cinema-3.jpg', 'type' => 'concept', 'caption' => 'Concept art - Patrion gathering']
                ],
                'order' => 1,
            ],
            [
                'title' => 'Film Cinema - Animation',
                'description' => 'Patrion dengan aksinya dan masalah yang mereka hadapi. Menghadapi musuh dan bagaimana patrion menyelesaikan masalah, menyelamatkan bumi dari penjahat yang mau menghancurkan mereka.',
                'synopsis' => 'Patrion dengan semua aksi dan masalah yang mereka hadapi. Mereka harus menghadapi musuh-musuh kuat yang berusaha menghancurkan Bumi. Teaser menampilkan awal kemunculan Patrion sampai mereka bersatu dan bersama menghadapi masalah utama menyelamatkan Bumi dari kehancuran total.',
                'image' => 'programs/Thumbnail-Animasi-2D.png',
                'thumbnail' => 'programs/thumbnails/Thumbnail-Animasi-2D.png',
                'platform' => 'cinema',
                'status' => 'upcoming',
                'release_date' => 'Q4 2024',
                'duration' => '120 menit',
                'rating' => 'PG-13',
                'director' => 'Abdurrahman GM',
                'budget' => '$15M',
                'trailer' => 'programs/trailers/02-animasi-2d.mp4',
                'episodes' => 1,
                'views' => 0,
                'characters' => ['kunna', 'wabu', 'asta', 'taran', 'arun', 'antis'],
                'platforms' => [
                    ['name' => 'CGV Cinemas', 'type' => 'cinema', 'icon' => 'fas fa-film'],
                    ['name' => 'Cinema 21', 'type' => 'cinema', 'icon' => 'fas fa-film'],
                    ['name' => 'Disney+', 'type' => 'ott', 'icon' => 'fas fa-tv']
                ],
                'production' => [
                    'studio' => 'Nusantara Animation Studio',
                    'timeline' => '30 months',
                    'locations' => ['Jakarta', 'Bandung'],
                    'vfx' => 'Local Animation Team',
                    'animation_style' => '2D Traditional',
                    'frame_rate' => '24 fps'
                ],
                'gallery' => [
                    ['src' => 'programs/gallery/animation-1.jpg', 'type' => 'stills', 'caption' => 'Character design - Kunna'],
                    ['src' => 'programs/gallery/animation-2.jpg', 'type' => 'stills', 'caption' => 'Battle scene'],
                    ['src' => 'programs/gallery/animation-3.jpg', 'type' => 'concept', 'caption' => 'Storyboard']
                ],
                'order' => 2,
            ],
            [
                'title' => 'Animasi 3D',
                'description' => 'Tayangan animasi anak yang menceritakan tentang para patrion dari wilayah masing-masing. Bagaimana mereka berpetualang untuk menyelesaikan persoalan yang terjadi di Nusantara.',
                'synopsis' => 'Serial animasi 3D untuk anak-anak yang menceritakan petualangan para Patrion dari berbagai wilayah Nusantara. Setiap episode, mereka menghadapi dan menyelesaikan masalah yang terjadi di daerah masing-masing, sambil mengajarkan nilai-nilai budaya dan kearifan lokal.',
                'image' => 'programs/Thumbnail-Animasi-3D.png',
                'thumbnail' => 'programs/thumbnails/Thumbnail-Animasi-3D.png',
                'platform' => 'ott',
                'status' => 'released',
                'release_date' => 'Q3 2024',
                'duration' => '22 menit/episode',
                'rating' => 'PG',
                'director' => 'Siti Nurhaliza',
                'budget' => '$8M',
                'trailer' => 'programs/trailers/03-animasi-3d.mp4',
                'episodes' => 24,
                'views' => 2500000,
                'characters' => ['kunna', 'wabu', 'asta', 'taran', 'sanu', 'kabi', 'arun'],
                'platforms' => [
                    ['name' => 'Netflix', 'type' => 'ott', 'icon' => 'fas fa-tv'],
                    ['name' => 'Vidio', 'type' => 'ott', 'icon' => 'fas fa-play-circle'],
                    ['name' => 'YouTube Kids', 'type' => 'digital', 'icon' => 'fab fa-youtube']
                ],
                'production' => [
                    'studio' => '3D Nusantara Studio',
                    'timeline' => '18 months',
                    'locations' => ['Jakarta', 'Surabaya'],
                    'vfx' => 'Blender Studio',
                    'animation_style' => '3D CGI',
                    'render_engine' => 'Cycles'
                ],
                'gallery' => [
                    ['src' => 'programs/gallery/3d-1.jpg', 'type' => 'stills', 'caption' => '3D Character model'],
                    ['src' => 'programs/gallery/3d-2.jpg', 'type' => 'stills', 'caption' => 'Environment design'],
                    ['src' => 'programs/gallery/3d-3.jpg', 'type' => 'behind', 'caption' => 'Voice recording session']
                ],
                'order' => 3,
            ],
            [
                'title' => 'Kunna Bercerita',
                'description' => 'Event Patrion Goes to school Kunna Bercerita.',
                'synopsis' => 'Program khusus di mana Kunna mengunjungi sekolah-sekolah untuk bercerita tentang budaya Jawa Tengah, nilai-nilai kehidupan, dan pentingnya melestarikan warisan budaya Nusantara. Program interaktif dengan partisipasi aktif dari siswa.',
                'image' => 'programs/Thumbnail-Kunna-Bercerita.png',
                'thumbnail' => 'programs/thumbnails/Thumbnail-Kunna-Bercerita.png',
                'platform' => 'digital',
                'status' => 'released',
                'release_date' => 'Q2 2024',
                'duration' => '10-15 menit',
                'rating' => 'G',
                'director' => 'Budi Santoso',
                'budget' => '$500K',
                'trailer' => 'programs/trailers/04-kunna-bercerita.mp4',
                'episodes' => 36,
                'views' => 1200000,
                'characters' => ['kunna'],
                'platforms' => [
                    ['name' => 'YouTube', 'type' => 'digital', 'icon' => 'fab fa-youtube'],
                    ['name' => 'Instagram', 'type' => 'digital', 'icon' => 'fab fa-instagram'],
                    ['name' => 'TikTok', 'type' => 'digital', 'icon' => 'fab fa-tiktok']
                ],
                'production' => [
                    'studio' => 'Patrion Edu Studio',
                    'timeline' => '6 months',
                    'locations' => ['Jawa Tengah Schools'],
                    'format' => 'Live Action + Animation',
                    'target_audience' => 'Children 5-12 years'
                ],
                'gallery' => [
                    ['src' => 'programs/gallery/kunna-1.jpg', 'type' => 'stills', 'caption' => 'Kunna at school'],
                    ['src' => 'programs/gallery/kunna-2.jpg', 'type' => 'stills', 'caption' => 'Interactive session with kids'],
                    ['src' => 'programs/gallery/kunna-3.jpg', 'type' => 'behind', 'caption' => 'Preparation']
                ],
                'order' => 4,
            ],
            [
                'title' => 'Travel Show',
                'description' => 'Program yang fokus pada destinasi wisata, budaya, kuliner dan memberikan panduan serta tips perjalanan. Ada host bersama dengan salah satu Patrion yang memandu perjalanan.',
                'synopsis' => 'Program travel show yang mengeksplorasi berbagai destinasi wisata di Nusantara. Setiap episode menampilkan satu Patrion sebagai pemandu yang memperkenalkan budaya, kuliner, dan keunikan daerah asalnya, memberikan tips perjalanan yang berguna bagi penonton.',
                'image' => 'programs/Thumbnail-Travel-Show.png',
                'thumbnail' => 'programs/thumbnails/Thumbnail-Travel-Show.png',
                'platform' => 'tv',
                'status' => 'production',
                'release_date' => 'Q1 2025',
                'duration' => '45 menit',
                'rating' => 'PG',
                'director' => 'Ahmad Rizki',
                'budget' => '$3M',
                'trailer' => 'programs/trailers/05-travel-show.mp4',
                'episodes' => 12,
                'views' => 0,
                'characters' => ['kunna', 'wabu', 'asta', 'taran', 'sanu', 'kabi', 'arun'],
                'platforms' => [
                    ['name' => 'Trans TV', 'type' => 'tv', 'icon' => 'fas fa-tv'],
                    ['name' => 'NET TV', 'type' => 'tv', 'icon' => 'fas fa-tv'],
                    ['name' => 'Vidio', 'type' => 'ott', 'icon' => 'fas fa-play-circle']
                ],
                'production' => [
                    'studio' => 'Travel Nusantara Productions',
                    'timeline' => '12 months',
                    'locations' => ['Bali', 'Yogyakarta', 'Sumatera', 'Sulawesi', 'Papua'],
                    'format' => '4K HDR',
                    'crew_size' => '15 people'
                ],
                'gallery' => [
                    ['src' => 'programs/gallery/travel-1.jpg', 'type' => 'stills', 'caption' => 'Shooting in Bali'],
                    ['src' => 'programs/gallery/travel-2.jpg', 'type' => 'stills', 'caption' => 'Local cuisine tasting'],
                    ['src' => 'programs/gallery/travel-3.jpg', 'type' => 'behind', 'caption' => 'Camera setup']
                ],
                'order' => 5,
            ],
            [
                'title' => 'Filler Value',
                'description' => 'Membuat cerita tentang seseorang yang punya jiwa nusantara dan cara hidupnya memiliki jiwa nasionalisme. Humanis.',
                'synopsis' => 'Serial pendek yang menampilkan cerita-cerita humanis tentang orang-orang biasa yang memiliki jiwa Nusantara dan nasionalisme dalam kehidupan sehari-hari mereka. Setiap episode mengangkat nilai-nilai kehidupan yang positif dan menginspirasi.',
                'image' => 'programs/Thumbnail-Filler.png',
                'thumbnail' => 'programs/thumbnails/Thumbnail-Filler.png',
                'platform' => 'ott',
                'status' => 'released',
                'release_date' => 'Q3 2024',
                'duration' => '5-8 menit',
                'rating' => 'PG',
                'director' => 'Dewi Lestari',
                'budget' => '$1.2M',
                'trailer' => 'programs/trailers/06-filler-value.mp4',
                'episodes' => 48,
                'views' => 800000,
                'characters' => ['kunna', 'wabu'],
                'platforms' => [
                    ['name' => 'YouTube', 'type' => 'digital', 'icon' => 'fab fa-youtube'],
                    ['name' => 'Instagram Reels', 'type' => 'digital', 'icon' => 'fab fa-instagram'],
                    ['name' => 'Vidio', 'type' => 'ott', 'icon' => 'fas fa-play-circle']
                ],
                'production' => [
                    'studio' => 'Human Story Studio',
                    'timeline' => '8 months',
                    'locations' => ['Various locations in Indonesia'],
                    'format' => 'Vertical Video',
                    'target_platform' => 'Social Media'
                ],
                'gallery' => [
                    ['src' => 'programs/gallery/filler-1.jpg', 'type' => 'stills', 'caption' => 'Human interest story'],
                    ['src' => 'programs/gallery/filler-2.jpg', 'type' => 'stills', 'caption' => 'Daily life moment'],
                    ['src' => 'programs/gallery/filler-3.jpg', 'type' => 'behind', 'caption' => 'Interview session']
                ],
                'order' => 6,
            ],
            [
                'title' => 'Motiongraphic 2D',
                'description' => 'Penjelasan/edukasi tentang nusantara. Video graphic real yang menceritakan tentang info nusantara dengan narasi. Dan disampaikan dengan gaya edukasi versi patrion. Yang cepat dan mudah dimengerti.',
                'synopsis' => 'Seri video edukasi menggunakan motion graphic 2D yang menjelaskan berbagai aspek Nusantara - dari sejarah, budaya, geografi, hingga ilmu pengetahuan. Disampaikan dengan gaya yang menarik dan mudah dipahami, cocok untuk semua usia.',
                'image' => 'programs/Thumbnail-Motion-Graphics-2d.png',
                'thumbnail' => 'programs/thumbnails/Thumbnail-Motion-Graphics-2d.png',
                'platform' => 'digital',
                'status' => 'released',
                'release_date' => 'Q2 2024',
                'duration' => '3-5 menit',
                'rating' => 'G',
                'director' => 'Citra Kirana',
                'budget' => '$300K',
                'trailer' => 'programs/trailers/07-motiongraphic-2d.mp4',
                'episodes' => 24,
                'views' => 500000,
                'characters' => ['kunna', 'wabu', 'asta'],
                'platforms' => [
                    ['name' => 'YouTube', 'type' => 'digital', 'icon' => 'fab fa-youtube'],
                    ['name' => 'Instagram', 'type' => 'digital', 'icon' => 'fab fa-instagram'],
                    ['name' => 'TikTok', 'type' => 'digital', 'icon' => 'fab fa-tiktok']
                ],
                'production' => [
                    'studio' => 'EduMotion Studio',
                    'timeline' => '4 months',
                    'locations' => ['Jakarta Studio'],
                    'software' => 'Adobe After Effects',
                    'animation_style' => '2D Motion Graphics'
                ],
                'gallery' => [
                    ['src' => 'programs/gallery/motion-1.jpg', 'type' => 'stills', 'caption' => 'Animation frame'],
                    ['src' => 'programs/gallery/motion-2.jpg', 'type' => 'stills', 'caption' => 'Infographic design'],
                    ['src' => 'programs/gallery/motion-3.jpg', 'type' => 'behind', 'caption' => 'Design process']
                ],
                'order' => 7,
            ],
            [
                'title' => 'Podcast Patronia',
                'description' => 'Penjelasan/edukasi tentang nusantara. Video graphic real yang menceritakan tentang info nusantara dengan narasi. Dan disampaikan dengan gaya edukasi versi patrion. Yang cepat dan mudah dimengerti.',
                'synopsis' => 'Podcast yang membahas berbagai topik tentang Nusantara dengan mendalam. Menghadirkan narasumber dari berbagai bidang, dibawakan dengan gaya santai namun informatif. Tersedia dalam format audio dan video.',
                'image' => 'programs/Thumbnail-Podcast-Patrionia.png',
                'thumbnail' => 'programs/thumbnails/Thumbnail-Podcast-Patrionia.png',
                'platform' => 'digital',
                'status' => 'released',
                'release_date' => 'Q1 2024',
                'duration' => '60-90 menit',
                'rating' => 'PG-13',
                'director' => 'Rizky Febian',
                'budget' => '$200K',
                'trailer' => 'programs/trailers/08-patrionia-podcast.mp4',
                'episodes' => 52,
                'views' => 300000,
                'characters' => ['kunna', 'wabu'],
                'platforms' => [
                    ['name' => 'Spotify', 'type' => 'podcast', 'icon' => 'fab fa-spotify'],
                    ['name' => 'Apple Podcasts', 'type' => 'podcast', 'icon' => 'fas fa-podcast'],
                    ['name' => 'YouTube', 'type' => 'digital', 'icon' => 'fab fa-youtube']
                ],
                'production' => [
                    'studio' => 'Podcast Nusantara Studio',
                    'timeline' => 'Ongoing',
                    'locations' => ['Jakarta Studio'],
                    'equipment' => 'Professional audio setup',
                    'recording_schedule' => 'Weekly'
                ],
                'gallery' => [
                    ['src' => 'programs/gallery/podcast-1.jpg', 'type' => 'stills', 'caption' => 'Recording session'],
                    ['src' => 'programs/gallery/podcast-2.jpg', 'type' => 'stills', 'caption' => 'Guest interview'],
                    ['src' => 'programs/gallery/podcast-3.jpg', 'type' => 'behind', 'caption' => 'Audio editing']
                ],
                'order' => 8,
            ],
            [
                'title' => 'Motion Comic',
                'description' => 'Komik Patrion yang menjelaskan perjalanan Patrion dengan superheronya. Format Concept komk yang dibuat versi video untuk market anak-anak dan dewasa. Level-level patrion ada di sini seiring petualangan tokoh Patrion.',
                'synopsis' => 'Adaptasi komik Patrion ke dalam format motion comic. Menceritakan perjalanan Patrion dengan kekuatan super mereka. Setiap episode menampilkan level dan perkembangan karakter yang berbeda, cocok untuk pasar anak-anak dan dewasa.',
                'image' => 'programs/Thumbnail-Motion-Comics.png',
                'thumbnail' => 'programs/thumbnails/Thumbnail-Motion-Comics.png',
                'platform' => 'digital',
                'status' => 'production',
                'release_date' => 'Q4 2024',
                'duration' => '15-20 menit',
                'rating' => 'PG',
                'director' => 'Eko Sutrisno',
                'budget' => '$750K',
                'trailer' => 'programs/trailers/09-motion-comic.mp4',
                'episodes' => 18,
                'views' => 0,
                'characters' => ['kunna', 'wabu', 'asta', 'taran', 'sanu', 'kabi', 'arun', 'antis'],
                'platforms' => [
                    ['name' => 'YouTube', 'type' => 'digital', 'icon' => 'fab fa-youtube'],
                    ['name' => 'Vidio', 'type' => 'ott', 'icon' => 'fas fa-play-circle'],
                    ['name' => 'LINE Webtoon', 'type' => 'comic', 'icon' => 'fas fa-book']
                ],
                'production' => [
                    'studio' => 'Comic Motion Studio',
                    'timeline' => '10 months',
                    'locations' => ['Bandung Studio'],
                    'technique' => 'Pan & Scan Animation',
                    'source_material' => 'Original Patrion Comics'
                ],
                'gallery' => [
                    ['src' => 'programs/gallery/comic-1.jpg', 'type' => 'stills', 'caption' => 'Comic panel'],
                    ['src' => 'programs/gallery/comic-2.jpg', 'type' => 'stills', 'caption' => 'Motion effect'],
                    ['src' => 'programs/gallery/comic-3.jpg', 'type' => 'behind', 'caption' => 'Voice acting']
                ],
                'order' => 9,
            ],
        ];

        foreach ($programs as $data) {
            // Generate slug dari title
            $slug = Str::slug($data['title']);

            // Check if program already exists
            $existing = Program::where('slug', $slug)->first();

            if (!$existing) {
                Program::create(array_merge($data, ['slug' => $slug]));
                $this->command->info("Program '{$data['title']}' created successfully.");
            } else {
                // Update existing program
                $existing->update($data);
                $this->command->info("Program '{$data['title']}' updated successfully.");
            }
        }

        $this->command->info('Total programs seeded: ' . count($programs));

        // Update view counts with some randomness for released programs
        $releasedPrograms = Program::where('status', 'released')->get();
        foreach ($releasedPrograms as $program) {
            // Add some randomness to view counts
            $randomFactor = rand(80, 120) / 100; // 80% to 120% of original
            $newViews = (int)($program->views * $randomFactor);
            $program->update(['views' => $newViews]);
        }

        $this->command->info('View counts updated for released programs.');
    }
}
