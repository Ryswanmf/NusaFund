<?php

namespace Database\Seeders;

use App\Models\Support;
use Illuminate\Database\Seeder;

class SupportSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            ['question' => 'Bagaimana cara melakukan donasi?', 'answer' => 'Anda cukup pilih campaign, klik tombol Donasi Sekarang, masukkan nominal dan pilih metode pembayaran.', 'category' => 'Donasi', 'order' => 1],
            ['question' => 'Apakah zakat di NusaFund sah secara syariat?', 'answer' => 'Ya, kami bekerja sama dengan BAZNAS dan lembaga resmi lainnya yang menjamin keabsahan penyaluran zakat.', 'category' => 'Zakat', 'order' => 2],
            ['question' => 'Bagaimana cara mendaftar jadi relawan?', 'answer' => 'Buka menu Event, pilih aksi yang Anda minati, dan klik Daftar Relawan pada halaman detail.', 'category' => 'Event', 'order' => 3],
            ['question' => 'Apakah data saya aman?', 'answer' => 'Kami menggunakan sistem enkripsi standar industri untuk menjamin keamanan data pribadi dan transaksi Anda.', 'category' => 'Akun', 'order' => 4],
        ];

        foreach ($faqs as $faq) {
            Support::create($faq);
        }
    }
}
