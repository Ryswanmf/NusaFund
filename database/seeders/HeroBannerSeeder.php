<?php

namespace Database\Seeders;

use App\Models\HeroBanner;
use Illuminate\Database\Seeder;

class HeroBannerSeeder extends Seeder
{
    public function run(): void
    {
        $banners = [
            [
                'tag' => '#IndonesiaBerbagi',
                'title' => 'Wujudkan <span class=\'text-amber-400\'>Perubahan</span> Lewat Kebaikan Anda',
                'description' => 'Gabung bersama 12.000+ donatur lainnya untuk membantu sesama melalui donasi, zakat, dan aksi sosial yang transparan.',
                'image' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=1470&auto=format&fit=crop',
                'cta_text' => 'Mulai Berdonasi',
                'cta_link' => '/donasi',
                'order' => 1
            ],
            [
                'tag' => '#PendidikanUntukSemua',
                'title' => 'Bantu <span class=\'text-amber-400\'>Anak Bangsa</span> Meraih Cita-Cita',
                'description' => 'Ribuan anak di pelosok negeri menanti uluran tangan Anda untuk mendapatkan fasilitas pendidikan yang layak.',
                'image' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?q=80&w=1470&auto=format&fit=crop',
                'cta_text' => 'Lihat Program',
                'cta_link' => '/donasi',
                'order' => 2
            ],
            [
                'tag' => '#RelawanNusantara',
                'title' => 'Jadilah <span class=\'text-amber-400\'>Relawan</span> Aksi Sosial Nyata',
                'description' => 'Jangan hanya berdonasi, terjun langsung ke lapangan dan rasakan kebahagiaan saat membantu sesama.',
                'image' => 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?q=80&w=1473&auto=format&fit=crop',
                'cta_text' => 'Ikuti Event',
                'cta_link' => '/event',
                'order' => 3
            ]
        ];

        foreach ($banners as $b) {
            HeroBanner::create($b);
        }
    }
}
