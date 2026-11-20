<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DestinasiAktivitasSeeder extends Seeder
{
    /**
     * Data asli dari database SARI (live per 19 Nov 2026, terbaru).
     * Idempoten: aman dijalankan berkali-kali.
     * Parent id di-resolve dari slug/nama, bukan hardcode id.
     */
    public function run(): void
    {

        $destinasiIds = \App\Models\Destinasi::pluck('id', 'slug');
        $aktivitasIds = \App\Models\Aktivitas::pluck('id', 'nama');

        $rows = [
            ['amed-pantai', 'Diving'],
            ['amed-pantai', 'Fotografi'],
            ['amed-pantai', 'Kuliner ikan bakar'],
            ['amed-pantai', 'Matahari terbit'],
            ['amed-pantai', 'Snorkeling'],
            ['tirta-gangga', 'Fotografi'],
            ['tirta-gangga', 'Beri makan koi'],
            ['tirta-gangga', 'Pemandian suci'],
            ['tirta-gangga', 'Trekking ringan'],
            ['pura-lempuyang', 'Fotografi'],
            ['pura-lempuyang', 'Ibadah'],
            ['pura-lempuyang', 'Meditasi'],
            ['pura-lempuyang', 'Trekking'],
            ['lovina-pantai', 'Snorkeling'],
            ['lovina-pantai', 'Pemandian air panas'],
            ['lovina-pantai', 'Perahu nelayan'],
            ['lovina-pantai', 'Tontonan lumba-lumba'],
            ['gitgit-airterjun', 'Fotografi'],
            ['gitgit-airterjun', 'Trekking'],
            ['gitgit-airterjun', 'Berenang'],
            ['gitgit-airterjun', 'Wisata kebun'],
            ['jatiluwih-sawah', 'Fotografi'],
            ['jatiluwih-sawah', 'Bersepeda'],
            ['jatiluwih-sawah', 'Edukasi subak'],
            ['jatiluwih-sawah', 'Kuliner'],
            ['jatiluwih-sawah', 'Trekking sawah'],
            ['pura-batukaru', 'Fotografi'],
            ['pura-batukaru', 'Ibadah'],
            ['pura-batukaru', 'Kuliner desa'],
            ['pura-batukaru', 'Trekking gunung'],
            ['sidemen-sawah', 'Fotografi'],
            ['sidemen-sawah', 'Trekking'],
            ['sidemen-sawah', 'Bersepeda'],
            ['sidemen-sawah', 'Kuliner'],
            ['sidemen-sawah', 'Tenun & kerajinan'],
            ['penglipuran-desa', 'Fotografi'],
            ['penglipuran-desa', 'Trekking bambu'],
            ['penglipuran-desa', 'Belajar adat Bali Aga'],
            ['penglipuran-desa', 'Kuliner lokal'],
            ['penglipuran-desa', 'Beli kerajinan'],
            ['sekumpul-air-terjun', 'Fotografi'],
            ['sekumpul-air-terjun', 'Trekking'],
            ['sekumpul-air-terjun', 'Berenang kolam alami'],
            ['sekumpul-air-terjun', 'Edukasi alam'],
            ['mangrove-pemogan', 'Fotografi'],
            ['mangrove-pemogan', 'Jalan pagi'],
            ['mangrove-pemogan', 'Kano'],
            ['mangrove-pemogan', 'Edukasi mangrove'],
            ['tirta-empul-pura', 'Fotografi'],
            ['tirta-empul-pura', 'Ibadah'],
            ['tirta-empul-pura', 'Melukat (pemandian suci)'],
            ['tirta-empul-pura', 'Sejarah & arkeologi'],
        ];

        $insert = [];
        foreach ($rows as [$dSlug, $aNama]) {
            $insert[] = ['destinasi_id' => $destinasiIds[$dSlug], 'aktivitas_id' => $aktivitasIds[$aNama]];
        }
        \Illuminate\Support\Facades\DB::table('destinasi_aktivitas')->insertOrIgnore($insert);
    }
}
