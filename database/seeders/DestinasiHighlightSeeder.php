<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DestinasiHighlightSeeder extends Seeder
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
            ['destinasi_slug' => 'amed-pantai', 'urutan' => 0, 'teks' => 'Snorkeling dan diving dengan visibilitas yang jernih'],
            ['destinasi_slug' => 'amed-pantai', 'urutan' => 1, 'teks' => 'Matahari terbit dari perahu jukung bersama nelayan lokal'],
            ['destinasi_slug' => 'amed-pantai', 'urutan' => 2, 'teks' => 'Bukit Amed di Cemeluk untuk panorama pantai dari ketinggian'],
            ['destinasi_slug' => 'amed-pantai', 'urutan' => 3, 'teks' => 'Warung ikan bakar jukut masih di tepi pantai'],
            ['destinasi_slug' => 'tirta-gangga', 'urutan' => 0, 'teks' => 'Beri makan ikan koi dari batu pijakan di kolam utama'],
            ['destinasi_slug' => 'tirta-gangga', 'urutan' => 1, 'teks' => 'Pemandian suci dengan sumber air pegunungan'],
            ['destinasi_slug' => 'tirta-gangga', 'urutan' => 2, 'teks' => 'Taman patung dan arca bergaya khas Karangasem'],
            ['destinasi_slug' => 'tirta-gangga', 'urutan' => 3, 'teks' => 'Trekking Bukit Asah di dekatnya untuk panorama timur Bali'],
            ['destinasi_slug' => 'pura-lempuyang', 'urutan' => 0, 'teks' => 'Fenomena "Gates of Heaven" dengan latar Gunung Agung'],
            ['destinasi_slug' => 'pura-lempuyang', 'urutan' => 1, 'teks' => 'Jalur trek hutan ke tujuh pura di lereng (3–4 jam)'],
            ['destinasi_slug' => 'pura-lempuyang', 'urutan' => 2, 'teks' => 'Suasana berkabut yang misterius di pagi hari'],
            ['destinasi_slug' => 'pura-lempuyang', 'urutan' => 3, 'teks' => 'Pemandangan seluruh timur Bali dari puncak'],
            ['destinasi_slug' => 'lovina-pantai', 'urutan' => 0, 'teks' => 'Menyaksikan lumba-lumba liar dari perahu tradisional'],
            ['destinasi_slug' => 'lovina-pantai', 'urutan' => 1, 'teks' => 'Snorkeling di perairan tenang dengan karang tropis'],
            ['destinasi_slug' => 'lovina-pantai', 'urutan' => 2, 'teks' => 'Pemandian air panas Banjar Tega di dekatnya'],
            ['destinasi_slug' => 'lovina-pantai', 'urutan' => 3, 'teks' => 'Pantai berpasir hitam yang hening, jauh dari keramaian'],
            ['destinasi_slug' => 'gitgit-airterjun', 'urutan' => 0, 'teks' => 'Air terjun 45 meter yang masih alami'],
            ['destinasi_slug' => 'gitgit-airterjun', 'urutan' => 1, 'teks' => 'Trekking ringan melalui kebun cengkeh dan kopi'],
            ['destinasi_slug' => 'gitgit-airterjun', 'urutan' => 2, 'teks' => 'Kolam alami untuk berenang (waspada saat debit tinggi)'],
            ['destinasi_slug' => 'gitgit-airterjun', 'urutan' => 3, 'teks' => 'Warung kecil dan parkir yang dikelola warga'],
            ['destinasi_slug' => 'jatiluwih-sawah', 'urutan' => 0, 'teks' => 'Panorama terasering sawah subak seluas 600 hektar'],
            ['destinasi_slug' => 'jatiluwih-sawah', 'urutan' => 1, 'teks' => 'Jalur setapak di tengah sawah untuk jalan santai'],
            ['destinasi_slug' => 'jatiluwih-sawah', 'urutan' => 2, 'teks' => 'Warung kuliner lokal dengan pemandangan terbuka'],
            ['destinasi_slug' => 'jatiluwih-sawah', 'urutan' => 3, 'teks' => 'Wisata edukasi sistem irigasi subak'],
            ['destinasi_slug' => 'pura-batukaru', 'urutan' => 0, 'teks' => 'Suasana mistis di tengah hutan berkabut'],
            ['destinasi_slug' => 'pura-batukaru', 'urutan' => 1, 'teks' => 'Pura Sad Kahyangan dengan arsitektur lereng gunung'],
            ['destinasi_slug' => 'pura-batukaru', 'urutan' => 2, 'teks' => 'Trekking Gunung Batukaru untuk pendaki berpengalaman'],
            ['destinasi_slug' => 'pura-batukaru', 'urutan' => 3, 'teks' => 'Dekat kebun teh dan cengkeh milik warga'],
            ['destinasi_slug' => 'sidemen-sawah', 'urutan' => 0, 'teks' => 'Panorama sawah dengan latar Gunung Agung'],
            ['destinasi_slug' => 'sidemen-sawah', 'urutan' => 1, 'teks' => 'Wisata tenun endek dan songket kerja tangan warga'],
            ['destinasi_slug' => 'sidemen-sawah', 'urutan' => 2, 'teks' => 'Trekking ringan lembah dan desa'],
            ['destinasi_slug' => 'sidemen-sawah', 'urutan' => 3, 'teks' => 'Kuliner khas Karangasem'],
            ['destinasi_slug' => 'penglipuran-desa', 'urutan' => 1, 'teks' => 'Peringkat desa terbersih Asia Tenggara versi media internasional'],
            ['destinasi_slug' => 'penglipuran-desa', 'urutan' => 2, 'teks' => 'Arsitektur rumah adat Bali Aga seragam sepanjang jalan utama'],
            ['destinasi_slug' => 'penglipuran-desa', 'urutan' => 3, 'teks' => 'Bamboo forest (bambu kuning) di ujung desa untuk trekking ringan'],
            ['destinasi_slug' => 'penglipuran-desa', 'urutan' => 4, 'teks' => 'Kuliner sate lembar dan cendol khas desa'],
            ['destinasi_slug' => 'sekumpul-air-terjun', 'urutan' => 1, 'teks' => '7 air terjun dalam satu lembah, panorama 360°'],
            ['destinasi_slug' => 'sekumpul-air-terjun', 'urutan' => 2, 'teks' => 'Jalur trekking hutan tropis ±30 menit turun'],
            ['destinasi_slug' => 'sekumpul-air-terjun', 'urutan' => 3, 'teks' => 'Kolam alami untuk berendam (musim kemarau)'],
            ['destinasi_slug' => 'sekumpul-air-terjun', 'urutan' => 4, 'teks' => 'Wajib guide lokal — termasuk gerbang tiket dan pendampingan'],
            ['destinasi_slug' => 'mangrove-pemogan', 'urutan' => 1, 'teks' => 'Jembatan kanopi mangrove ±2 km untuk jalan pagi/sore'],
            ['destinasi_slug' => 'mangrove-pemogan', 'urutan' => 2, 'teks' => 'Kanopi & budidaya mangrove binaan warga'],
            ['destinasi_slug' => 'mangrove-pemogan', 'urutan' => 3, 'teks' => 'Habitat burung air dan satwa bakau langka'],
            ['destinasi_slug' => 'mangrove-pemogan', 'urutan' => 4, 'teks' => 'Kanal kano menembus hutan'],
            ['destinasi_slug' => 'tirta-empul-pura', 'urutan' => 1, 'teks' => 'Melukat di 30 pancuran air suci bersejarah'],
            ['destinasi_slug' => 'tirta-empul-pura', 'urutan' => 2, 'teks' => 'Pura peninggalan abad ke-10 di lereng Tampaksiring'],
            ['destinasi_slug' => 'tirta-empul-pura', 'urutan' => 3, 'teks' => 'Kolam petirtaan dengan tiga kolam utama'],
            ['destinasi_slug' => 'tirta-empul-pura', 'urutan' => 4, 'teks' => 'Museum & taman istana Raja Tampaksiring di seberang jalan'],
        ];

        foreach ($rows as $row) {
            $row['destinasi_id'] = $destinasiIds[$row['destinasi_slug']];
            unset($row['destinasi_slug']);
            \App\Models\DestinasiHighlight::updateOrCreate([
                'destinasi_id' => $row['destinasi_id'],
                'urutan' => $row['urutan'],
            ], $row);
        }
    }
}
