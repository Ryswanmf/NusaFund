<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::create([
            'facebook' => 'https://facebook.com/nusafund',
            'instagram' => 'https://instagram.com/nusafund',
            'youtube' => 'https://youtube.com/nusafund',
            'twitter' => 'https://twitter.com/nusafund',
            'whatsapp' => '081234567890',
            'email' => 'kontak@nusafund.id',
            'address' => 'Tebet, Jakarta Selatan, 12810',
            'copyright' => '2026 NusaFund Indonesia. Terdaftar Kemensos RI.'
        ]);
    }
}
