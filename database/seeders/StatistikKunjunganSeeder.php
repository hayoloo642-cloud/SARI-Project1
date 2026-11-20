<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StatistikKunjunganSeeder extends Seeder
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
            ['destinasi_slug' => 'jatiluwih-sawah', 'tanggal' => '2026-11-14', 'jumlah' => 3],
            ['destinasi_slug' => 'amed-pantai', 'tanggal' => '2026-11-14', 'jumlah' => 39],
            ['destinasi_slug' => 'tirta-gangga', 'tanggal' => '2026-11-14', 'jumlah' => 2],
            ['destinasi_slug' => 'pura-batukaru', 'tanggal' => '2026-11-14', 'jumlah' => 1],
            ['destinasi_slug' => 'lovina-pantai', 'tanggal' => '2026-11-14', 'jumlah' => 1],
            ['destinasi_slug' => 'pura-lempuyang', 'tanggal' => '2026-11-14', 'jumlah' => 1],
            ['destinasi_slug' => 'amed-pantai', 'tanggal' => '2026-11-19', 'jumlah' => 2],
            ['destinasi_slug' => 'lovina-pantai', 'tanggal' => '2026-11-19', 'jumlah' => 1],
        ];

        foreach ($rows as $row) {
            $row['destinasi_id'] = $destinasiIds[$row['destinasi_slug']];
            unset($row['destinasi_slug']);
            \App\Models\StatistikKunjungan::updateOrCreate([
                'destinasi_id' => $row['destinasi_id'],
                'tanggal' => $row['tanggal'],
            ], $row);
        }
    }
}
