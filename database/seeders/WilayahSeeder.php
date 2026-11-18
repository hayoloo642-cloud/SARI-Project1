<?php

namespace Database\Seeders;

use App\Models\Wilayah;
use Illuminate\Database\Seeder;

class WilayahSeeder extends Seeder
{
    /**
     * Data asli dari database SARI (live per 14 Nov 2026).
     * Idempoten: aman dijalankan berkali-kali.
     */
    public function run(): void
    {
        $wilayah = [
            ['slug' => 'karangasem', 'nama' => 'Karangasem', 'deskripsi' => 'Gunung, pura tua, dan pantai tenang di timur Bali.'],
            ['slug' => 'buleleng', 'nama' => 'Buleleng', 'deskripsi' => 'Pantai hitam, lumba-lumba, dan air terjun di utara Bali.'],
            ['slug' => 'tabanan', 'nama' => 'Tabanan', 'deskripsi' => 'Teras sawah UNESCO, sistem subak, dan pura di lereng gunung.'],
            ['slug' => 'klungkung', 'nama' => 'Klungkung', 'deskripsi' => 'Pusat kerajaan klasik, seni, dan gerbang menuju Nusa Penida.'],
            ['slug' => 'bangli', 'nama' => 'Bangli', 'deskripsi' => 'Danau Batur, udara sejuk pegunungan, dan adat yang masih hidup.'],
            ['slug' => 'gianyar', 'nama' => 'Gianyar', 'deskripsi' => 'Jantung seni dan kerajinan Bali dengan pasar-pasar tradisional.'],
        ];

        foreach ($wilayah as $row) {
            Wilayah::updateOrCreate(['slug' => $row['slug']], $row);
        }
    }
}
