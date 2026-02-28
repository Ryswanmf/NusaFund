<?php

namespace Database\Seeders;

use App\Models\PrivacyPolicy;
use Illuminate\Database\Seeder;

class PrivacyPolicySeeder extends Seeder
{
    public function run(): void
    {
        $policies = [
            ['title' => 'Informasi yang Kami Kumpulkan', 'content' => 'Kami mengumpulkan informasi identitas pribadi seperti nama, alamat email, dan nomor telepon saat Anda mendaftar atau berdonasi untuk keperluan verifikasi dan laporan.', 'order' => 1],
            ['title' => 'Penggunaan Informasi', 'content' => 'Informasi yang Anda berikan digunakan untuk memproses transaksi donasi, memberikan update campaign, dan meningkatkan layanan platform kami.', 'order' => 2],
            ['title' => 'Keamanan Data', 'content' => 'NusaFund berkomitmen menjaga keamanan data Anda dengan menggunakan teknologi enkripsi SSL dan prosedur keamanan berlapis untuk mencegah akses tidak sah.', 'order' => 3],
            ['title' => 'Berbagi Informasi dengan Pihak Ketiga', 'content' => 'Kami tidak menjual atau menyewakan informasi pribadi Anda. Data hanya dibagikan kepada lembaga penyalur atau payment gateway untuk kepentingan transaksi donasi.', 'order' => 4],
        ];

        foreach ($policies as $policy) {
            PrivacyPolicy::create($policy);
        }
    }
}
