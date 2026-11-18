<?php

namespace Database\Seeders;

use App\Models\Aktivitas;
use Illuminate\Database\Seeder;

class AktivitasSeeder extends Seeder
{
    /**
     * Data asli dari database SARI (live per 14 Nov 2026).
     * Idempoten: aman dijalankan berkali-kali.
     */
    public function run(): void
    {
        $aktivitas = [
            'Diving',
            'Fotografi',
            'Kuliner ikan bakar',
            'Matahari terbit',
            'Snorkeling',
            'Beri makan koi',
            'Pemandian suci',
            'Trekking ringan',
            'Ibadah',
            'Meditasi',
            'Trekking',
            'Pemandian air panas',
            'Perahu nelayan',
            'Tontonan lumba-lumba',
            'Berenang',
            'Wisata kebun',
            'Bersepeda',
            'Edukasi subak',
            'Kuliner',
            'Trekking sawah',
            'Kuliner desa',
            'Trekking gunung',
            'Tenun & kerajinan',
            'Renang',
        ];

        foreach ($aktivitas as $nama) {
            Aktivitas::updateOrCreate(['nama' => $nama], ['nama' => $nama]);
        }
    }
}
