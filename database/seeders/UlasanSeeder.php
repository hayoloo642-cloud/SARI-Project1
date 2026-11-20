<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UlasanSeeder extends Seeder
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
            ['destinasi_slug' => 'amed-pantai', 'nama_pengunjung' => 'I Wayan Sukadana', 'rating' => 5, 'komentar' => 'Suasana pagi hari sangat hening, air laut jernih sekali sampai terumbu karang kelihatan dari perahu jukung nelayan lokal.', 'status' => 'disetujui'],
            ['destinasi_slug' => 'amed-pantai', 'nama_pengunjung' => 'Sarah Jenkins', 'rating' => 5, 'komentar' => 'Amazing snorkeling spot away from the crowded south. Local boatmen were incredibly friendly and respectful.', 'status' => 'disetujui'],
            ['destinasi_slug' => 'tirta-gangga', 'nama_pengunjung' => 'Ni Kadek Ayu', 'rating' => 5, 'komentar' => 'Airnya segar dan sangat terawat. Jangan lupa bawa pakan ikan untuk memberi makan ikan koi besar di kolam utama.', 'status' => 'disetujui'],
            ['destinasi_slug' => 'tirta-gangga', 'nama_pengunjung' => 'Michael Schmidt', 'rating' => 4, 'komentar' => 'A truly peaceful royal garden. Visiting early morning before 9 AM gave us the whole place to ourselves.', 'status' => 'disetujui'],
            ['destinasi_slug' => 'pura-lempuyang', 'nama_pengunjung' => 'Ketut Dharma', 'rating' => 5, 'komentar' => 'Tempat ibadah yang sangat disakralkan. Pemandangan Gunung Agung dari Gerbang Surga saat cuaca cerah betul-betul magis.', 'status' => 'disetujui'],
            ['destinasi_slug' => 'pura-lempuyang', 'nama_pengunjung' => 'Elena Rostova', 'rating' => 5, 'komentar' => 'Breathtaking spiritual site. Make sure to wear respectful temple attire (sarong provided). The energy here is sublime.', 'status' => 'disetujui'],
            ['destinasi_slug' => 'lovina-pantai', 'nama_pengunjung' => 'Putu Artha', 'rating' => 5, 'komentar' => 'Melihat lumba-lumba berenang bebas di habitat aslinya adalah pengalaman tak terlupakan untuk anak-anak.', 'status' => 'disetujui'],
            ['destinasi_slug' => 'lovina-pantai', 'nama_pengunjung' => 'Liam O\'Connor', 'rating' => 4, 'komentar' => 'Gentle morning boat ride with dolphins breaching near sunrise. Calm waters and authentic local captains.', 'status' => 'disetujui'],
            ['destinasi_slug' => 'gitgit-airterjun', 'nama_pengunjung' => 'Gede Wira', 'rating' => 5, 'komentar' => 'Air terjun tertinggi dan udara di sekitarnya sangat sejuk. Jalur tangga menurun cukup menguras tenaga tapi terbayar lunas.', 'status' => 'disetujui'],
            ['destinasi_slug' => 'gitgit-airterjun', 'nama_pengunjung' => 'Claire Dubois', 'rating' => 5, 'komentar' => 'Lush tropical trail filled with clove and coffee trees. The waterfall mist is so refreshing after the hike.', 'status' => 'disetujui'],
            ['destinasi_slug' => 'jatiluwih-sawah', 'nama_pengunjung' => 'Made Sudarma', 'rating' => 5, 'komentar' => 'Sistem irigasi Subak di sini adalah mahakarya leluhur. Jalan kaki di jalur trekking sawah sangat menenangkan pikiran.', 'status' => 'disetujui'],
            ['destinasi_slug' => 'jatiluwih-sawah', 'nama_pengunjung' => 'David Miller', 'rating' => 5, 'komentar' => 'The vast green rice terraces seem to go on forever. Unforgettable UNESCO heritage without tourist circus.', 'status' => 'disetujui'],
            ['destinasi_slug' => 'pura-batukaru', 'nama_pengunjung' => 'Wayan Sujana', 'rating' => 5, 'komentar' => 'Pura di tengah hutan belantara kaki gunung. Hawanya sejuk berkabut, sangat hening untuk menenangkan batin dan berdoa.', 'status' => 'disetujui'],
            ['destinasi_slug' => 'pura-batukaru', 'nama_pengunjung' => 'Sophie Martin', 'rating' => 5, 'komentar' => 'Deeply spiritual and untouched temple surrounded by primordial rainforest. Far more meaningful than crowded tourist spots.', 'status' => 'disetujui'],
            ['destinasi_slug' => 'sidemen-sawah', 'nama_pengunjung' => 'Nyoman Kartika', 'rating' => 5, 'komentar' => 'Desa yang masih sangat asri dengan panorama lembah dan kain tenun tradisional. Penginapan lokalnya ramah dan otentik.', 'status' => 'disetujui'],
            ['destinasi_slug' => 'sidemen-sawah', 'nama_pengunjung' => 'Tom van Dijk', 'rating' => 5, 'komentar' => 'Sidemen reminds me of Bali decades ago. Peaceful valley walks, friendly villagers, and stunning vistas of Mount Agung.', 'status' => 'disetujui'],
            ['destinasi_slug' => 'amed-pantai', 'nama_pengunjung' => 'Budi Santoso', 'rating' => 5, 'komentar' => 'Snorkeling di Amed sangat tenang, banyak terumbu karang indah dan warga lokal sangat ramah.', 'status' => 'disetujui'],
            ['destinasi_slug' => 'amed-pantai', 'nama_pengunjung' => 'dimas', 'rating' => 5, 'komentar' => 'bagus sekali', 'status' => 'ditolak'],
            ['destinasi_slug' => 'amed-pantai', 'nama_pengunjung' => 'Test Reviewer', 'rating' => 5, 'komentar' => 'Test review comment - great place!', 'status' => 'disetujui'],
            ['destinasi_slug' => 'amed-pantai', 'nama_pengunjung' => 'Test Reviewer', 'rating' => 5, 'komentar' => 'Test review comment - great place!', 'status' => 'disetujui'],
        ];

        foreach ($rows as $row) {
            $row['destinasi_id'] = $destinasiIds[$row['destinasi_slug']];
            unset($row['destinasi_slug']);
            \App\Models\Ulasan::firstOrCreate($row);
        }
    }
}
