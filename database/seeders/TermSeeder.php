<?php

namespace Database\Seeders;

use App\Models\Term;
use Illuminate\Database\Seeder;

class TermSeeder extends Seeder
{
    public function run(): void
    {
        $terms = [
            ['title' => 'Ketentuan Umum', 'content' => 'NusaFund adalah platform yang memfasilitasi penggalangan dana dan donasi secara online. Pengguna wajib memberikan data yang benar.', 'order' => 1],
            ['title' => 'Kewajiban Penggalang Dana', 'content' => 'Penggalang dana wajib melakukan verifikasi identitas (KYC) dan bertanggung jawab penuh atas kebenaran informasi campaign.', 'order' => 2],
            ['title' => 'Ketentuan Donatur', 'content' => 'Donasi yang sudah masuk tidak dapat ditarik kembali kecuali dalam kondisi force majeure yang disetujui platform.', 'order' => 3],
            ['title' => 'Biaya Layanan', 'content' => 'NusaFund mengenakan biaya layanan sebesar 5% untuk setiap donasi yang terkumpul guna pemeliharaan sistem.', 'order' => 4],
        ];

        foreach ($terms as $term) {
            Term::create($term);
        }
    }
}
