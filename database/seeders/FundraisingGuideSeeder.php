<?php

namespace Database\Seeders;

use App\Models\FundraisingStep;
use App\Models\FundraisingFaq;
use Illuminate\Database\Seeder;

class FundraisingGuideSeeder extends Seeder
{
    public function run(): void
    {
        // Steps
        $steps = [
            ['step_number' => 1, 'title' => 'Buat Akun & Profil', 'description' => 'Daftar sebagai individu atau organisasi. Lengkapi profil Anda dengan identitas yang valid untuk membangun kepercayaan donatur.'],
            ['step_number' => 2, 'title' => 'Ajukan Campaign', 'description' => 'Klik tombol "Mulai Galang Dana", isi detail campaign seperti judul, target dana, deskripsi, dan unggah foto pendukung yang menarik.'],
            ['step_number' => 3, 'title' => 'Verifikasi Admin', 'description' => 'Tim NusaFund akan melakukan verifikasi kelayakan campaign Anda dalam waktu maksimal 2x24 jam untuk memastikan keamanan donatur.'],
            ['step_number' => 4, 'title' => 'Sebarkan Kebaikan', 'description' => 'Setelah disetujui, campaign Anda aktif! Sebarkan link campaign ke media sosial untuk mulai mengumpulkan dukungan.'],
        ];

        foreach ($steps as $step) {
            FundraisingStep::create($step);
        }

        // FAQs
        $faqs = [
            ['question' => 'Berapa lama dana bisa dicairkan?', 'answer' => 'Dana dapat dicairkan kapan saja setelah mencapai minimal Rp 50.000 dan proses verifikasi pencairan memakan waktu 1-3 hari kerja.', 'order' => 1],
            ['question' => 'Apakah ada potongan biaya?', 'answer' => 'NusaFund mengenakan biaya operasional platform sebesar 5% untuk pemeliharaan sistem dan biaya transaksi perbankan (gratis untuk kategori bencana alam).', 'order' => 2],
        ];

        foreach ($faqs as $faq) {
            FundraisingFaq::create($faq);
        }
    }
}
