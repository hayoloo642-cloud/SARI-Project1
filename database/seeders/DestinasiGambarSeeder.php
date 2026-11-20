<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DestinasiGambarSeeder extends Seeder
{
    /**
     * Data asli dari database SARI (live per 19 Nov 2026, terbaru).
     * Idempoten: aman dijalankan berkali-kali.
     * Parent id di-resolve dari slug/nama, bukan hardcode id.
     */
    public function run(): void
    {

        $destinasiIds = \App\Models\Destinasi::pluck('id', 'slug');

        $rows = [
            ['destinasi_slug' => 'amed-pantai', 'path' => 'assets/images/amed.jpg', 'alt' => 'Pantai Amed', 'is_utama' => 1, 'kredit' => 'Wikimedia Commons', 'sumber_url' => ''],
            ['destinasi_slug' => 'tirta-gangga', 'path' => 'assets/images/tirta-gangga.jpg', 'alt' => 'Taman Tirta Gangga', 'is_utama' => 1, 'kredit' => 'Wikimedia Commons', 'sumber_url' => ''],
            ['destinasi_slug' => 'pura-lempuyang', 'path' => 'assets/images/lempuyang.jpg', 'alt' => 'Pura Lempuyang', 'is_utama' => 1, 'kredit' => 'Wikimedia Commons', 'sumber_url' => ''],
            ['destinasi_slug' => 'lovina-pantai', 'path' => 'assets/images/lovina.jpg', 'alt' => 'Pantai Lovina', 'is_utama' => 1, 'kredit' => 'Wikimedia Commons', 'sumber_url' => ''],
            ['destinasi_slug' => 'gitgit-airterjun', 'path' => 'assets/images/gitgit.jpg', 'alt' => 'Air Terjun Gitgit', 'is_utama' => 1, 'kredit' => 'Wikimedia Commons', 'sumber_url' => ''],
            ['destinasi_slug' => 'jatiluwih-sawah', 'path' => 'assets/images/jatiluwih.jpg', 'alt' => 'Teras Sawah Jatiluwih', 'is_utama' => 1, 'kredit' => 'Wikimedia Commons', 'sumber_url' => ''],
            ['destinasi_slug' => 'pura-batukaru', 'path' => 'assets/images/batukaru.jpg', 'alt' => 'Pura Luhur Batukaru', 'is_utama' => 1, 'kredit' => 'Wikimedia Commons', 'sumber_url' => ''],
            ['destinasi_slug' => 'sidemen-sawah', 'path' => 'assets/images/sidemen.jpg', 'alt' => 'Desa Sidemen', 'is_utama' => 1, 'kredit' => 'Wikimedia Commons', 'sumber_url' => ''],
            ['destinasi_slug' => 'amed-pantai', 'path' => 'assets/images/galeri/amed-1.jpg', 'alt' => 'Perahu jukung tradisional di pesisir Pantai Amed', 'is_utama' => 0, 'kredit' => 'Wikimedia Commons', 'sumber_url' => ''],
            ['destinasi_slug' => 'amed-pantai', 'path' => 'assets/images/galeri/amed-2.jpg', 'alt' => 'Terumbu karang dan biota bawah laut Amed', 'is_utama' => 0, 'kredit' => 'Wikimedia Commons', 'sumber_url' => ''],
            ['destinasi_slug' => 'amed-pantai', 'path' => 'assets/images/galeri/amed-3.jpg', 'alt' => 'Matahari terbit tenang di atas teluk Amed', 'is_utama' => 0, 'kredit' => 'Wikimedia Commons', 'sumber_url' => ''],
            ['destinasi_slug' => 'tirta-gangga', 'path' => 'assets/images/galeri/tirta-gangga-1.jpg', 'alt' => 'Batu pijakan di atas kolam suci Tirta Gangga', 'is_utama' => 0, 'kredit' => 'Wikimedia Commons', 'sumber_url' => ''],
            ['destinasi_slug' => 'tirta-gangga', 'path' => 'assets/images/galeri/tirta-gangga-2.jpg', 'alt' => 'Ikan mas koi berenang di mata air alami', 'is_utama' => 0, 'kredit' => 'Wikimedia Commons', 'sumber_url' => ''],
            ['destinasi_slug' => 'tirta-gangga', 'path' => 'assets/images/galeri/tirta-gangga-3.jpg', 'alt' => 'Taman air kerajaan dan arsitektur peninggalan Karangasem', 'is_utama' => 0, 'kredit' => 'Wikimedia Commons', 'sumber_url' => ''],
            ['destinasi_slug' => 'pura-lempuyang', 'path' => 'assets/images/galeri/lempuyang-1.jpg', 'alt' => 'Candi Bentar Gerbang Surga dengan latar Gunung Agung', 'is_utama' => 0, 'kredit' => 'Wikimedia Commons', 'sumber_url' => ''],
            ['destinasi_slug' => 'pura-lempuyang', 'path' => 'assets/images/galeri/lempuyang-2.jpg', 'alt' => 'Tangga naga suci menuju pelataran utama pura', 'is_utama' => 0, 'kredit' => 'Wikimedia Commons', 'sumber_url' => ''],
            ['destinasi_slug' => 'pura-lempuyang', 'path' => 'assets/images/galeri/lempuyang-3.jpg', 'alt' => 'Suasana hening di lereng Gunung Lempuyang', 'is_utama' => 0, 'kredit' => 'Wikimedia Commons', 'sumber_url' => ''],
            ['destinasi_slug' => 'lovina-pantai', 'path' => 'assets/images/galeri/lovina-1.jpg', 'alt' => 'Kawanan lumba-lumba liar melompat di laut lepas Lovina', 'is_utama' => 0, 'kredit' => 'Wikimedia Commons', 'sumber_url' => ''],
            ['destinasi_slug' => 'lovina-pantai', 'path' => 'assets/images/galeri/lovina-2.jpg', 'alt' => 'Perahu cadik nelayan menyambut fajar di Bali Utara', 'is_utama' => 0, 'kredit' => 'Wikimedia Commons', 'sumber_url' => ''],
            ['destinasi_slug' => 'lovina-pantai', 'path' => 'assets/images/galeri/lovina-3.jpg', 'alt' => 'Ketenangan pesisir berpasir hitam di Pantai Lovina', 'is_utama' => 0, 'kredit' => 'Wikimedia Commons', 'sumber_url' => ''],
            ['destinasi_slug' => 'gitgit-airterjun', 'path' => 'assets/images/galeri/gitgit-1.jpg', 'alt' => 'Derasnya tirai air terjun Gitgit di tengah ngarai hijau', 'is_utama' => 0, 'kredit' => 'Wikimedia Commons', 'sumber_url' => ''],
            ['destinasi_slug' => 'gitgit-airterjun', 'path' => 'assets/images/galeri/gitgit-2.jpg', 'alt' => 'Hutan hujan tropis rimbun di jalur setapak Gitgit', 'is_utama' => 0, 'kredit' => 'Wikimedia Commons', 'sumber_url' => ''],
            ['destinasi_slug' => 'gitgit-airterjun', 'path' => 'assets/images/galeri/gitgit-3.jpg', 'alt' => 'Kolam alami jernih di bawah air terjun', 'is_utama' => 0, 'kredit' => 'Wikimedia Commons', 'sumber_url' => ''],
            ['destinasi_slug' => 'jatiluwih-sawah', 'path' => 'assets/images/galeri/jatiluwih-1.jpg', 'alt' => 'Lansekap hijau bertingkat warisan dunia UNESCO Jatiluwih', 'is_utama' => 0, 'kredit' => 'Wikimedia Commons', 'sumber_url' => ''],
            ['destinasi_slug' => 'jatiluwih-sawah', 'path' => 'assets/images/galeri/jatiluwih-2.jpg', 'alt' => 'Saluran irigasi tradisional Subak yang terjaga ratusan tahun', 'is_utama' => 0, 'kredit' => 'Wikimedia Commons', 'sumber_url' => ''],
            ['destinasi_slug' => 'jatiluwih-sawah', 'path' => 'assets/images/galeri/jatiluwih-3.jpg', 'alt' => 'Kabut pagi di perbukitan sawah terasering', 'is_utama' => 0, 'kredit' => 'Wikimedia Commons', 'sumber_url' => ''],
            ['destinasi_slug' => 'pura-batukaru', 'path' => 'assets/images/galeri/batukaru-1.jpg', 'alt' => 'Meru bertingkat sakral dinaungi rimbun hutan lereng gunung', 'is_utama' => 0, 'kredit' => 'Wikimedia Commons', 'sumber_url' => ''],
            ['destinasi_slug' => 'pura-batukaru', 'path' => 'assets/images/galeri/batukaru-2.jpg', 'alt' => 'Pelinggih batu berselimut lumut kuno yang damai', 'is_utama' => 0, 'kredit' => 'Wikimedia Commons', 'sumber_url' => ''],
            ['destinasi_slug' => 'pura-batukaru', 'path' => 'assets/images/galeri/batukaru-3.jpg', 'alt' => 'Kanopi hutan lindung suci Gunung Batukaru', 'is_utama' => 0, 'kredit' => 'Wikimedia Commons', 'sumber_url' => ''],
            ['destinasi_slug' => 'sidemen-sawah', 'path' => 'assets/images/galeri/sidemen-1.jpg', 'alt' => 'Pemandangan lembah asri Sidemen menghadap Gunung Agung', 'is_utama' => 0, 'kredit' => 'Wikimedia Commons', 'sumber_url' => ''],
            ['destinasi_slug' => 'sidemen-sawah', 'path' => 'assets/images/galeri/sidemen-2.jpg', 'alt' => 'Pematang sawah alami dan sungai jernih di perbukitan', 'is_utama' => 0, 'kredit' => 'Wikimedia Commons', 'sumber_url' => ''],
            ['destinasi_slug' => 'sidemen-sawah', 'path' => 'assets/images/galeri/sidemen-3.jpg', 'alt' => 'Tradisi tenun kain songket dan endek khas warga desa', 'is_utama' => 0, 'kredit' => 'Wikimedia Commons', 'sumber_url' => ''],
        ];

        foreach ($rows as $row) {
            $row['destinasi_id'] = $destinasiIds[$row['destinasi_slug']];
            unset($row['destinasi_slug']);
            \App\Models\DestinasiGambar::updateOrCreate([
                'destinasi_id' => $row['destinasi_id'],
                'path' => $row['path'],
            ], $row);
        }
    }
}
