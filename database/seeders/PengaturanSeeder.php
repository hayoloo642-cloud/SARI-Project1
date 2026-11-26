<?php

namespace Database\Seeders;

use App\Models\Pengaturan;
use Illuminate\Database\Seeder;

class PengaturanSeeder extends Seeder
{
    /**
     * Data asli dari database SARI (live per 14 Nov 2026).
     * Idempoten: aman dijalankan berkali-kali.
     */
    public function run(): void
    {
        $rows = [
            ['key' => 'nama_situs', 'value' => 'Jejak Bali'],
            ['key' => 'tagline', 'value' => 'Inti seni, adat, dan rasa Bali untuk wisatawan bijak'],
            ['key' => 'whatsapp_pusat', 'value' => '6281234567890'],
        ];

        foreach ($rows as $row) {
            Pengaturan::updateOrCreate(['key' => $row['key']], $row);
        }
    }
}
