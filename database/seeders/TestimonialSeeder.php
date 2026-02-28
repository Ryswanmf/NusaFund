<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name' => 'Budi Santoso',
                'role' => 'Donatur Rutin',
                'message' => 'NusaFund memberikan harapan baru bagi sekolah kami. Transparansinya luar biasa.',
            ],
            [
                'name' => 'Siti Rahma',
                'role' => 'Penerima Manfaat',
                'message' => 'Terima kasih donatur NusaFund, bantuan kalian menyelamatkan nyawa anak saya.',
            ]
        ];

        foreach ($data as $t) {
            Testimonial::create($t);
        }
    }
}
