<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    public function run(): void
    {
        About::create([
            'title' => 'Mendekatkan Kebaikan ke Seluruh Nusantara',
            'hero_description' => 'NusaFund hadir sebagai jembatan kepercayaan antara para dermawan dengan mereka yang membutuhkan bantuan melalui teknologi yang transparan dan akuntabel.',
            'vision' => 'Menjadi platform filantropi paling transparan dan berdampak luas di Indonesia.',
            'mission_1' => 'Setiap rupiah terlacak dari donatur hingga tangan penerima melalui laporan digital realtime.',
            'mission_2' => 'Fokus pada program jangka panjang seperti beasiswa pendidikan dan modal usaha UMKM.',
            'mission_3' => 'Mempermudah siapa saja untuk berbagi hanya dengan beberapa klik melalui perangkat apa pun.',
            'founded_year' => '2024'
        ]);
    }
}
