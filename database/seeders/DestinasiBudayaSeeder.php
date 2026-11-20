<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DestinasiBudayaSeeder extends Seeder
{
    /**
     * Data asli dari database SARI (live per 19 Nov 2026, terbaru).
     * Idempoten: aman dijalankan berkali-kali.
     * Parent id di-resolve dari slug/nama, bukan hardcode id.
     */
    public function run(): void
    {

        $destinasiIds = \App\Models\Destinasi::pluck('id', 'slug');
        $budayaIds = \App\Models\Budaya::pluck('id', 'slug');

        $rows = [
            ['amed-pantai', 'adat-laut'],
            ['amed-pantai', 'pantang-larang-desa'],
            ['tirta-gangga', 'busana-pura'],
            ['tirta-gangga', 'canang-sari'],
            ['pura-lempuyang', 'busana-pura'],
            ['pura-lempuyang', 'canang-sari'],
            ['lovina-pantai', 'adat-laut'],
            ['lovina-pantai', 'pantang-larang-desa'],
            ['gitgit-airterjun', 'pantang-larang-desa'],
            ['jatiluwih-sawah', 'pantang-larang-desa'],
            ['pura-batukaru', 'busana-pura'],
            ['pura-batukaru', 'canang-sari'],
            ['sidemen-sawah', 'pantang-larang-desa'],
            ['penglipuran-desa', 'busana-pura'],
            ['penglipuran-desa', 'pantang-larang-desa'],
            ['sekumpul-air-terjun', 'adat-laut'],
            ['sekumpul-air-terjun', 'pantang-larang-desa'],
            ['mangrove-pemogan', 'adat-laut'],
            ['mangrove-pemogan', 'pantang-larang-desa'],
            ['tirta-empul-pura', 'busana-pura'],
            ['tirta-empul-pura', 'canang-sari'],
            ['tirta-empul-pura', 'pantang-larang-desa'],
        ];

        $insert = [];
        foreach ($rows as [$dSlug, $bSlug]) {
            $insert[] = ['destinasi_id' => $destinasiIds[$dSlug], 'budaya_id' => $budayaIds[$bSlug]];
        }
        \Illuminate\Support\Facades\DB::table('destinasi_budaya')->insertOrIgnore($insert);
    }
}
