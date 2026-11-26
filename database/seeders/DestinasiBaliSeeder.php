<?php

namespace Database\Seeders;

use App\Models\Destinasi;
use App\Models\Wilayah;
use Illuminate\Database\Seeder;

class DestinasiBaliSeeder extends Seeder
{
    /**
     * Melengkapi destinasi untuk tiga wilayah yang belum ada di SARI:
     * Badung, Denpasar, dan Jembrana.
     *
     * Fokus Badung adalah pantai-pantai ikonik Bali selatan, Denpasar
     * mengangkat wisata kota, dan Jembrana melengkapi Bali barat.
     *
     * Idempoten: aman dijalankan berkali-kali (updateOrCreate per slug).
     */
    public function run(): void
    {
        $wilayahIds = Wilayah::pluck('id', 'slug');

        foreach (self::rows() as $row) {
            $wilayahId = $wilayahIds[$row['wilayah_slug']] ?? null;

            if (! $wilayahId) {
                $this->command?->warn("Wilayah {$row['wilayah_slug']} tidak ditemukan, {$row['slug']} dilewati.");

                continue;
            }

            $row['wilayah_id'] = $wilayahId;
            unset($row['wilayah_slug']);

            Destinasi::updateOrCreate(['slug' => $row['slug']], $row);
        }
    }

    public static function rows(): array
    {
        return array_map(fn (array $r) => self::normalisasi($r), self::data());
    }

    private static function normalisasi(array $r): array
    {
        $lat = $r['lat'];
        $lng = $r['lng'];

        return [
            'slug' => $r['slug'],
            'nama' => $r['nama'],
            'kategori' => $r['kategori'],
            'deskripsi' => $r['deskripsi'],
            'waktu_terbaik' => $r['waktu'],
            'jam_buka' => $r['jam'],
            'tarif' => $r['tarif'],
            'cara_masuk' => $r['cara'],
            'etika' => $r['etika'],
            'whatsapp' => null,
            'kontak' => '-',
            'rating_awal' => $r['rating'] ?? 4.6,
            'gambar' => '',
            'is_unggulan' => 0,
            'status' => 'aktif',
            'latitude' => $lat,
            'longitude' => $lng,
            'maps_url' => "https://maps.google.com/?q={$lat},{$lng}",
            'user_id' => null,
            'pengelola_nama' => $r['pengelola'],
            'pengelola_wa' => '',
            'pengelola_foto' => '',
            'wilayah_slug' => $r['wilayah'],
        ];
    }

    private static function data(): array
    {
        return [
            // ---------------------------------------------------------------
            // BADUNG (16 destinasi)
            // ---------------------------------------------------------------
            [
                'slug' => 'pantai-kuta', 'nama' => 'Pantai Kuta', 'kategori' => 'Pantai & Surf',
                'wilayah' => 'badung', 'lat' => -8.7185, 'lng' => 115.1686, 'rating' => 4.6,
                'deskripsi' => 'Pantai berpasir panjang yang menjadi wajah pariwisata Bali, terkenal dengan ombak selancar dan matahari terbenamnya.',
                'waktu' => 'Sore menjelang matahari terbenam', 'jam' => '24 jam',
                'tarif' => 'Gratis; parkir ± Rp 5.000',
                'cara' => 'Dari Bandara Ngurah Rai sekitar 15 menit ke utara.',
                'etika' => 'Berenang hanya di area yang diawasi penjaga pantai karena arus bisa kuat. Jangan memarkir kendaraan di badan jalan dan bawa turun sampah Anda.',
                'pengelola' => 'Desa Adat Kuta',
            ],
            [
                'slug' => 'pantai-legian', 'nama' => 'Pantai Legian', 'kategori' => 'Pantai & Surf',
                'wilayah' => 'badung', 'lat' => -8.6950, 'lng' => 115.1650, 'rating' => 4.5,
                'deskripsi' => 'Kelanjutan Pantai Kuta yang sedikit lebih tenang, dengan deretan kafe, toko, dan akses langsung ke jalan Legian.',
                'waktu' => 'Sore', 'jam' => '24 jam',
                'tarif' => 'Gratis',
                'cara' => 'Berada di ujung utara Jalan Legian, Kuta.',
                'etika' => 'Hormati area upacara di pantai dan jangan mengganggu pemancing. Jangan meninggalkan sampah plastik di pasir.',
                'pengelola' => 'Desa Adat Legian',
            ],
            [
                'slug' => 'pantai-seminyak', 'nama' => 'Pantai Seminyak', 'kategori' => 'Pantai & Sunset',
                'wilayah' => 'badung', 'lat' => -8.6913, 'lng' => 115.1571, 'rating' => 4.6,
                'deskripsi' => 'Pantai favorit untuk menikmati matahari terbenam, dengan beach club dan restoran di sepanjang garis pantai.',
                'waktu' => 'Sore 17.00 – 18.30', 'jam' => '24 jam',
                'tarif' => 'Gratis',
                'cara' => 'Dari Kuta sekitar 10 menit ke utara via Jalan Camplung Tanduk.',
                'etika' => 'Jangan berdiri di area upacara atau melangkahi sesajen. Jika memotret orang, minta izin lebih dulu.',
                'pengelola' => 'Desa Adat Seminyak',
            ],
            [
                'slug' => 'pantai-double-six', 'nama' => 'Pantai Double Six', 'kategori' => 'Pantai & Surf',
                'wilayah' => 'badung', 'lat' => -8.6836, 'lng' => 115.1553, 'rating' => 4.5,
                'deskripsi' => 'Pantai di ujung Legian yang populer untuk berselancar dan menonton sunset, dekat dengan Jalan Double Six.',
                'waktu' => 'Pagi untuk surf, sore untuk sunset', 'jam' => '24 jam',
                'tarif' => 'Gratis',
                'cara' => 'Dari Legian sekitar 5 menit ke arah utara.',
                'etika' => 'Patuhi jalur peselancar dan jangan berenang di area ombak pecah. Jangan memarkir kendaraan di trotoar.',
                'pengelola' => 'Desa Adat Legian',
            ],
            [
                'slug' => 'pantai-echo-beach', 'nama' => 'Pantai Echo Beach', 'kategori' => 'Pantai & Surf',
                'wilayah' => 'badung', 'lat' => -8.6553, 'lng' => 115.1280, 'rating' => 4.6,
                'deskripsi' => 'Pantai berbatu di Canggu dengan ombak konsisten, warung seafood, dan pemandangan pura di tepi laut.',
                'waktu' => 'Pagi untuk surf, sore untuk makan malam', 'jam' => '06:00 – 22:00',
                'tarif' => 'Gratis',
                'cara' => 'Dari Seminyak sekitar 20 menit ke utara via Jalan Pantai Batu Bolong.',
                'etika' => 'Arus balik bisa kuat — jangan berenang jauh. Hormati peselancar lokal dan jangan memotret upacara tanpa izin.',
                'pengelola' => 'Desa Adat Canggu',
            ],
            [
                'slug' => 'pantai-jimbaran', 'nama' => 'Pantai Jimbaran', 'kategori' => 'Pantai & Kuliner',
                'wilayah' => 'badung', 'lat' => -8.7906, 'lng' => 115.1653, 'rating' => 4.6,
                'deskripsi' => 'Teluk berpasir putih dengan deretan warung ikan bakar di pasir, terkenal untuk makan malam sambil menikmati sunset.',
                'waktu' => 'Sore sampai malam', 'jam' => '24 jam; warung 16.00 – 23.00',
                'tarif' => 'Gratis',
                'cara' => 'Dari Bandara Ngurah Rai sekitar 15 menit ke selatan.',
                'etika' => 'Tawar harga seafood dengan sopan dan pastikan berat ditimbang di depan Anda. Jangan mengganggu nelayan yang membongkar hasil tangkapan.',
                'pengelola' => 'Desa Adat Jimbaran',
            ],
            [
                'slug' => 'pantai-nusa-dua', 'nama' => 'Pantai Nusa Dua', 'kategori' => 'Pantai & Resort',
                'wilayah' => 'badung', 'lat' => -8.7950, 'lng' => 115.2280, 'rating' => 4.7,
                'deskripsi' => 'Pantai berpasir putih dengan air tenang di kawasan resor, cocok untuk berenang dan olahraga air keluarga.',
                'waktu' => 'Pagi sampai sore', 'jam' => '06:00 – 19:00',
                'tarif' => 'Gratis; parkir ± Rp 5.000',
                'cara' => 'Dari Bandara Ngurah Rai sekitar 20 menit ke timur.',
                'etika' => 'Beberapa bagian pantai berada di area resor — hormati akses tamu. Jangan menyentuh atau berdiri di atas karang.',
                'pengelola' => 'Bali Tourism Development Corporation',
            ],
            [
                'slug' => 'pantai-pandawa', 'nama' => 'Pantai Pandawa', 'kategori' => 'Pantai & Tebing',
                'wilayah' => 'badung', 'lat' => -8.8506, 'lng' => 115.1875, 'rating' => 4.7,
                'deskripsi' => 'Pantai berpasir putih di balik tebing kapur, dengan deretan patung Pandawa dan air laut yang tenang.',
                'waktu' => 'Pagi sebelum panas', 'jam' => '07:00 – 19:00',
                'tarif' => 'Rp 15.000; parkir ± Rp 5.000',
                'cara' => 'Dari Kuta sekitar 30 menit ke selatan via Jalan Raya Uluwatu.',
                'etika' => 'Jangan memanjat tebing atau menyentuh patung. Berenang hanya di area yang ditandai karena bagian lain berbatu.',
                'pengelola' => 'Desa Adat Kutuh',
            ],
            [
                'slug' => 'pantai-melasti', 'nama' => 'Pantai Melasti', 'kategori' => 'Pantai & Tebing',
                'wilayah' => 'badung', 'lat' => -8.8476, 'lng' => 115.1947, 'rating' => 4.7,
                'deskripsi' => 'Pantai berpasir putih dengan tebing kapur dan jalan pesisir yang rapi, populer untuk berfoto dan berenang.',
                'waktu' => 'Pagi', 'jam' => '07:00 – 19:00',
                'tarif' => 'Rp 15.000',
                'cara' => 'Dari Pandawa sekitar 5 menit ke timur.',
                'etika' => 'Jangan berdiri di tepi tebing untuk berfoto. Bawa turun sampah dan hindari berenang saat gelombang tinggi.',
                'pengelola' => 'Desa Adat Ungasan',
            ],
            [
                'slug' => 'pantai-padang-padang', 'nama' => 'Pantai Padang Padang', 'kategori' => 'Pantai & Surf',
                'wilayah' => 'badung', 'lat' => -8.8103, 'lng' => 115.1039, 'rating' => 4.7,
                'deskripsi' => 'Pantai kecil di celah karang yang terkenal lewat film Eat Pray Love, dengan ombak kelas dunia.',
                'waktu' => 'Pagi', 'jam' => '07:00 – 19:00',
                'tarif' => 'Rp 10.000',
                'cara' => 'Dari Uluwatu sekitar 10 menit ke utara.',
                'etika' => 'Jalur tangga sempit — jangan berhenti berlama-lama. Arus kuat, jadi berenang hanya di area yang aman.',
                'pengelola' => 'Desa Adat Pecatu',
            ],
            [
                'slug' => 'pantai-bingin', 'nama' => 'Pantai Bingin', 'kategori' => 'Pantai & Surf',
                'wilayah' => 'badung', 'lat' => -8.8069, 'lng' => 115.1158, 'rating' => 4.6,
                'deskripsi' => 'Pantai di bawah tebing dengan pasir putih, ombak selancar, dan penginapan kecil yang menghadap laut.',
                'waktu' => 'Pagi atau sore', 'jam' => '07:00 – 19:00',
                'tarif' => 'Rp 10.000',
                'cara' => 'Dari Uluwatu sekitar 10 menit ke utara via Jalan Bingin.',
                'etika' => 'Turuni tangga dengan hati-hati dan jangan memblokir jalur warga. Hormati tamu penginapan dan jaga ketenangan.',
                'pengelola' => 'Desa Adat Pecatu',
            ],
            [
                'slug' => 'pantai-balangan', 'nama' => 'Pantai Balangan', 'kategori' => 'Pantai & Surf',
                'wilayah' => 'badung', 'lat' => -8.7903, 'lng' => 115.1225, 'rating' => 4.7,
                'deskripsi' => 'Pantai panjang berpasir putih dengan ombak selancar dan deretan warung di bawah tebing.',
                'waktu' => 'Pagi', 'jam' => '07:00 – 19:00',
                'tarif' => 'Rp 10.000; parkir ± Rp 5.000',
                'cara' => 'Dari Uluwatu sekitar 15 menit ke utara.',
                'etika' => 'Ombak untuk peselancar berpengalaman. Jangan berenang di area arus balik dan jangan memarkir kendaraan di jalan sempit.',
                'pengelola' => 'Desa Adat Ungasan',
            ],
            [
                'slug' => 'pantai-suluban', 'nama' => 'Pantai Suluban', 'kategori' => 'Pantai & Surf',
                'wilayah' => 'badung', 'lat' => -8.8143, 'lng' => 115.0883, 'rating' => 4.7,
                'deskripsi' => 'Pantai di bawah Pura Uluwatu dengan gua karang dan ombak terkenal, dikenal juga sebagai Blue Point.',
                'waktu' => 'Pagi untuk surf', 'jam' => '07:00 – 19:00',
                'tarif' => 'Rp 10.000',
                'cara' => 'Dari Uluwatu sekitar 5 menit ke arah pantai.',
                'etika' => 'Tangga curam dan licin. Hormati area pura di atas tebing dan jangan memotret pemuja dari dekat.',
                'pengelola' => 'Desa Adat Pecatu',
            ],
            [
                'slug' => 'pantai-nyang-nyang', 'nama' => 'Pantai Nyang Nyang', 'kategori' => 'Pantai & Trekking',
                'wilayah' => 'badung', 'lat' => -8.8444, 'lng' => 115.0944, 'rating' => 4.6,
                'deskripsi' => 'Pantai panjang yang masih sepi di balik bukit, dicapai lewat trekking dan populer untuk camping serta sunset.',
                'waktu' => 'Sore', 'jam' => '07:00 – 19:00',
                'tarif' => 'Gratis; parkir ± Rp 5.000',
                'cara' => 'Dari Uluwatu sekitar 10 menit, lalu trekking ±20 menit.',
                'etika' => 'Jalur trekking panas dan minim fasilitas — bawa air serta bawa turun sampah. Jangan turun setelah gelap tanpa penerangan.',
                'pengelola' => 'Desa Adat Pecatu',
            ],
            [
                'slug' => 'pantai-dreamland', 'nama' => 'Pantai Dreamland', 'kategori' => 'Pantai & Surf',
                'wilayah' => 'badung', 'lat' => -8.8000, 'lng' => 115.1050, 'rating' => 4.6,
                'deskripsi' => 'Pantai berpasir putih di kawasan Pecatu dengan ombak selancar dan tebing karang di kedua sisinya.',
                'waktu' => 'Sore', 'jam' => '07:00 – 19:00',
                'tarif' => 'Gratis; parkir ± Rp 5.000',
                'cara' => 'Dari Uluwatu sekitar 10 menit ke utara.',
                'etika' => 'Arus bisa kuat saat pasang. Jangan memanjat karang dan jangan meninggalkan sampah di pantai.',
                'pengelola' => 'Desa Adat Pecatu',
            ],
            [
                'slug' => 'pantai-kedonganan', 'nama' => 'Pantai Kedonganan', 'kategori' => 'Pantai & Kuliner',
                'wilayah' => 'badung', 'lat' => -8.7667, 'lng' => 115.1667, 'rating' => 4.5,
                'deskripsi' => 'Pantai nelayan di teluk Jimbaran dengan pasar ikan dan warung seafood, lebih lokal daripada pantai resor.',
                'waktu' => 'Sore', 'jam' => '05:00 – 22:00',
                'tarif' => 'Gratis',
                'cara' => 'Dari Bandara Ngurah Rai sekitar 10 menit ke selatan.',
                'etika' => 'Jangan menghalangi nelayan yang bekerja. Tawar harga dengan sopan dan hindari membeli karang atau satwa laut yang dilindungi.',
                'pengelola' => 'Desa Adat Kedonganan',
            ],

            // ---------------------------------------------------------------
            // DENPASAR (10 destinasi)
            // ---------------------------------------------------------------
            [
                'slug' => 'pantai-sanur', 'nama' => 'Pantai Sanur', 'kategori' => 'Pantai & Sunrise',
                'wilayah' => 'denpasar', 'lat' => -8.6870, 'lng' => 115.2620, 'rating' => 4.7,
                'deskripsi' => 'Pantai timur Denpasar dengan air tenang dan jalur sepeda di tepi laut, terkenal untuk matahari terbit.',
                'waktu' => 'Pagi 05.30 – 07.00', 'jam' => '24 jam',
                'tarif' => 'Gratis',
                'cara' => 'Dari pusat Denpasar sekitar 15 menit ke timur.',
                'etika' => 'Berenang hanya di area yang ditandai karena ada karang. Jangan mengganggu upacara di pura tepi pantai.',
                'pengelola' => 'Desa Adat Sanur',
            ],
            [
                'slug' => 'pantai-matahari-terbit', 'nama' => 'Pantai Matahari Terbit', 'kategori' => 'Pantai & Sunrise',
                'wilayah' => 'denpasar', 'lat' => -8.6719, 'lng' => 115.2639, 'rating' => 4.6,
                'deskripsi' => 'Pantai di utara Sanur yang menghadap langsung ke timur, spot favorit untuk menonton matahari terbit.',
                'waktu' => 'Pagi', 'jam' => '24 jam',
                'tarif' => 'Gratis',
                'cara' => 'Dari Sanur sekitar 5 menit ke utara via Jalan Hang Tuah.',
                'etika' => 'Jangan berdiri di area nelayan menurunkan perahu. Bawa jaket karena angin pagi cukup dingin.',
                'pengelola' => 'Desa Adat Sanur',
            ],
            [
                'slug' => 'pantai-mertasari', 'nama' => 'Pantai Mertasari', 'kategori' => 'Pantai & Layang-layang',
                'wilayah' => 'denpasar', 'lat' => -8.7030, 'lng' => 115.2560, 'rating' => 4.5,
                'deskripsi' => 'Pantai berpasir di Sanur yang menjadi lokasi Festival Layang-layang Bali dan tempat bermain keluarga.',
                'waktu' => 'Sore', 'jam' => '24 jam',
                'tarif' => 'Gratis',
                'cara' => 'Dari Sanur sekitar 5 menit ke selatan.',
                'etika' => 'Jangan menerbangkan layang-layang di dekat pura atau jalur pesawat. Bawa turun sampah dan awasi anak di air.',
                'pengelola' => 'Desa Adat Sanur',
            ],
            [
                'slug' => 'pantai-padang-galak', 'nama' => 'Pantai Padang Galak', 'kategori' => 'Pantai & Layang-layang',
                'wilayah' => 'denpasar', 'lat' => -8.6503, 'lng' => 115.2439, 'rating' => 4.4,
                'deskripsi' => 'Pantai berpasir hitam di utara Sanur yang dikenal sebagai lokasi festival layang-layang tradisional.',
                'waktu' => 'Sore', 'jam' => '24 jam',
                'tarif' => 'Gratis',
                'cara' => 'Dari Sanur sekitar 10 menit ke utara via Jalan Padang Galak.',
                'etika' => 'Hindari berenang karena arus dan dasar berbatu. Jangan memarkir kendaraan di pematang atau area upacara.',
                'pengelola' => 'Desa Adat Kesiman',
            ],
            [
                'slug' => 'pura-sakenan-serangan', 'nama' => 'Pura Sakenan & Pantai Serangan', 'kategori' => 'Pura & Pantai',
                'wilayah' => 'denpasar', 'lat' => -8.7189, 'lng' => 115.2447, 'rating' => 4.6,
                'deskripsi' => 'Pura di Pulau Serangan yang dikelilingi laut, ramai saat piodalan dan dikunjungi bersama pantai pasir putihnya.',
                'waktu' => 'Pagi', 'jam' => '07:00 – 18:00',
                'tarif' => 'Donasi',
                'cara' => 'Dari Sanur sekitar 15 menit via Jalan Tukad Punggawa.',
                'etika' => 'Wajib memakai kamen dan sopan. Saat piodalan, jangan memotret prosesi tanpa izin dan jangan menghalangi umat.',
                'pengelola' => 'Bendesa Adat Serangan',
            ],
            [
                'slug' => 'museum-bali', 'nama' => 'Museum Bali', 'kategori' => 'Museum & Budaya',
                'wilayah' => 'denpasar', 'lat' => -8.6581, 'lng' => 115.2196, 'rating' => 4.5,
                'deskripsi' => 'Museum arkeologi dan budaya Bali di Denpasar dengan koleksi prasasti, arca, dan arsitektur tradisional.',
                'waktu' => 'Pagi', 'jam' => '08:00 – 16:00 (Senin tutup)',
                'tarif' => 'Rp 20.000',
                'cara' => 'Berada di Jalan Mayor Wisnu, Denpasar Timur.',
                'etika' => 'Jangan menyentuh koleksi dan jaga ketenangan ruang pamer. Minta izin sebelum memotret benda tertentu.',
                'pengelola' => 'Dinas Kebudayaan Provinsi Bali',
            ],
            [
                'slug' => 'pasar-badung', 'nama' => 'Pasar Badung', 'kategori' => 'Pasar Tradisional',
                'wilayah' => 'denpasar', 'lat' => -8.6569, 'lng' => 115.2130, 'rating' => 4.5,
                'deskripsi' => 'Pasar induk terbesar di Bali yang menjual sayur, buah, rempah, dan kebutuhan upacara sejak pagi buta.',
                'waktu' => 'Pagi 05.00 – 09.00', 'jam' => '04:00 – 17:00',
                'tarif' => 'Gratis',
                'cara' => 'Berada di pusat Kota Denpasar, dekat Pasar Kumbasari.',
                'etika' => 'Jangan menghalangi jalur pedagang dan jangan memotret wajah tanpa izin. Tawar harga dengan sopan.',
                'pengelola' => 'PD Pasar Kota Denpasar',
            ],
            [
                'slug' => 'pura-jagatnatha', 'nama' => 'Pura Agung Jagatnatha', 'kategori' => 'Pura',
                'wilayah' => 'denpasar', 'lat' => -8.6569, 'lng' => 115.2164, 'rating' => 4.6,
                'deskripsi' => 'Pura kota terbesar di Denpasar dengan arsitektur megah dan taman yang menjadi ruang publik umat Hindu.',
                'waktu' => 'Pagi atau sore', 'jam' => '07:00 – 20:00',
                'tarif' => 'Gratis',
                'cara' => 'Berada di Jalan Mayor Wisnu, sebelah timur Lapangan Puputan Badung.',
                'etika' => 'Wajib memakai kamen dan berpakaian sopan. Jangan masuk area dalam saat upacara dan jangan memotret pemuja dari dekat.',
                'pengelola' => 'Bendesa Adat Denpasar',
            ],
            [
                'slug' => 'bajra-sandhi', 'nama' => 'Monumen Bajra Sandhi', 'kategori' => 'Monumen & Sejarah',
                'wilayah' => 'denpasar', 'lat' => -8.6710, 'lng' => 115.2260, 'rating' => 4.6,
                'deskripsi' => 'Monumen perjuangan rakyat Bali di Lapangan Puputan Renon, dengan diorama sejarah dan panorama kota dari atas.',
                'waktu' => 'Pagi atau sore', 'jam' => '08:00 – 18:00',
                'tarif' => 'Rp 25.000',
                'cara' => 'Berada di kawasan Renon, Denpasar Selatan.',
                'etika' => 'Jangan memanjat bangunan atau duduk di tangga utama. Jaga ketenangan karena monumen juga menjadi ruang upacara.',
                'pengelola' => 'Dinas Kebudayaan Kota Denpasar',
            ],
            [
                'slug' => 'taman-werdhi-budaya', 'nama' => 'Taman Werdhi Budaya Art Centre', 'kategori' => 'Budaya & Seni',
                'wilayah' => 'denpasar', 'lat' => -8.6660, 'lng' => 115.2260, 'rating' => 4.5,
                'deskripsi' => 'Pusat seni dan budaya Bali di Denpasar dengan panggung pertunjukan, galeri, dan arsitektur tradisional.',
                'waktu' => 'Sore untuk pertunjukan', 'jam' => '08:00 – 22:00',
                'tarif' => 'Gratis; pertunjukan berbayar',
                'cara' => 'Berada di Jalan Nusa Indah, Denpasar Timur.',
                'etika' => 'Jangan masuk ke panggung tanpa izin dan matikan suara ponsel saat pertunjukan. Jangan memotret dengan flash.',
                'pengelola' => 'Dinas Kebudayaan Provinsi Bali',
            ],

            // ---------------------------------------------------------------
            // JEMBRANA (10 destinasi)
            // ---------------------------------------------------------------
            [
                'slug' => 'pantai-medewi', 'nama' => 'Pantai Medewi', 'kategori' => 'Pantai & Surf',
                'wilayah' => 'jembrana', 'lat' => -8.4239, 'lng' => 114.7550, 'rating' => 4.6,
                'deskripsi' => 'Pantai berpasir hitam di Bali barat dengan ombak selancar panjang, jauh dari keramaian Bali selatan.',
                'waktu' => 'Pagi untuk surf, sore untuk sunset', 'jam' => '06:00 – 19:00',
                'tarif' => 'Gratis; parkir ± Rp 5.000',
                'cara' => 'Dari Denpasar sekitar 2 jam via Jalan Raya Denpasar–Gilimanuk.',
                'etika' => 'Arus bisa kuat, berenang hanya di area aman. Hormati peselancar lokal dan jangan memarkir kendaraan di pematang sawah.',
                'pengelola' => 'Desa Adat Medewi',
            ],
            [
                'slug' => 'pantai-perancak', 'nama' => 'Pantai Perancak', 'kategori' => 'Pantai & Budaya',
                'wilayah' => 'jembrana', 'lat' => -8.3833, 'lng' => 114.6333, 'rating' => 4.5,
                'deskripsi' => 'Pantai nelayan di muara Sungai Perancak dengan perahu warna-warni dan suasana desa yang tenang.',
                'waktu' => 'Sore', 'jam' => '06:00 – 18:00',
                'tarif' => 'Gratis',
                'cara' => 'Dari Negara sekitar 20 menit ke selatan.',
                'etika' => 'Jangan menghalangi nelayan yang bekerja dan jangan memotret tanpa izin. Bawa turun sampah karena fasilitas terbatas.',
                'pengelola' => 'Desa Adat Perancak',
            ],
            [
                'slug' => 'pura-rambut-siwi', 'nama' => 'Pura Rambut Siwi', 'kategori' => 'Pura',
                'wilayah' => 'jembrana', 'lat' => -8.4333, 'lng' => 114.7667, 'rating' => 4.7,
                'deskripsi' => 'Pura di atas tebing menghadap Samudra Hindia, salah satu pura penting di jalur barat Bali.',
                'waktu' => 'Pagi atau sore', 'jam' => '07:00 – 18:00',
                'tarif' => 'Donasi',
                'cara' => 'Dari Negara sekitar 30 menit ke barat via Jalan Raya Gilimanuk.',
                'etika' => 'Wajib memakai kamen dan sopan. Jangan memotret pemuja atau prosesi tanpa izin, dan jangan berdiri di tepi tebing.',
                'pengelola' => 'Bendesa Adat Yeh Embang',
            ],
            [
                'slug' => 'taman-nasional-bali-barat', 'nama' => 'Taman Nasional Bali Barat', 'kategori' => 'Taman Nasional',
                'wilayah' => 'jembrana', 'lat' => -8.1667, 'lng' => 114.4833, 'rating' => 4.7,
                'deskripsi' => 'Kawasan konservasi di ujung barat Bali dengan hutan musim, savana, dan habitat jalak bali yang dilindungi.',
                'waktu' => 'Pagi saat satwa aktif', 'jam' => '07:00 – 17:00',
                'tarif' => 'Rp 25.000 + guide',
                'cara' => 'Dari Gilimanuk sekitar 20 menit ke arah Labuhan Lalang.',
                'etika' => 'Wajib didampingi pemandu resmi. Jangan memberi makan satwa, membuat suara keras, atau membawa keluar apa pun dari kawasan.',
                'pengelola' => 'Balai Taman Nasional Bali Barat',
            ],
            [
                'slug' => 'pelabuhan-gilimanuk', 'nama' => 'Pelabuhan Gilimanuk', 'kategori' => 'Pelabuhan & Sejarah',
                'wilayah' => 'jembrana', 'lat' => -8.1667, 'lng' => 114.4333, 'rating' => 4.3,
                'deskripsi' => 'Gerbang laut Bali ke Jawa, dengan ferry penyeberangan dan panorama Selat Bali saat matahari terbenam.',
                'waktu' => 'Sore', 'jam' => '24 jam',
                'tarif' => 'Gratis (tiket ferry terpisah)',
                'cara' => 'Berada di ujung barat Jalan Raya Denpasar–Gilimanuk.',
                'etika' => 'Ikuti aturan pelabuhan dan jangan memotret area pemeriksaan. Jaga barang bawaan dan jangan memberi uang kepada peminta di jalan.',
                'pengelola' => 'ASDP Indonesia Ferry',
            ],
            [
                'slug' => 'pelabuhan-pengambengan', 'nama' => 'Pelabuhan Perikanan Pengambengan', 'kategori' => 'Pelabuhan & Kuliner',
                'wilayah' => 'jembrana', 'lat' => -8.3833, 'lng' => 114.5833, 'rating' => 4.4,
                'deskripsi' => 'Pelabuhan ikan terbesar di Bali barat, ramai saat kapal bersandar dan tempat membeli hasil laut segar.',
                'waktu' => 'Pagi saat kapal bersandar', 'jam' => '04:00 – 17:00',
                'tarif' => 'Gratis',
                'cara' => 'Dari Negara sekitar 15 menit ke selatan.',
                'etika' => 'Jangan menghalangi jalur bongkar muat. Tawar harga dengan sopan dan jangan membeli satwa laut yang dilindungi.',
                'pengelola' => 'Pelabuhan Perikanan Nusantara Pengambengan',
            ],
            [
                'slug' => 'desa-blimbingsari', 'nama' => 'Desa Blimbingsari', 'kategori' => 'Desa & Budaya',
                'wilayah' => 'jembrana', 'lat' => -8.3667, 'lng' => 114.5667, 'rating' => 4.4,
                'deskripsi' => 'Desa Bali dengan komunitas Kristen yang hidup berdampingan dengan adat Bali, dikenal dengan gereja bergaya arsitektur Bali.',
                'waktu' => 'Pagi', 'jam' => '08:00 – 17:00',
                'tarif' => 'Donasi',
                'cara' => 'Dari Negara sekitar 20 menit ke selatan.',
                'etika' => 'Hormati tempat ibadah dan jangan memotret jemaat saat beribadah. Berpakaian sopan dan minta izin sebelum masuk area gereja.',
                'pengelola' => 'Desa Adat Blimbingsari',
            ],
            [
                'slug' => 'bunut-bolong', 'nama' => 'Bunut Bolong', 'kategori' => 'Alam & Budaya',
                'wilayah' => 'jembrana', 'lat' => -8.3500, 'lng' => 114.8167, 'rating' => 4.4,
                'deskripsi' => 'Pohon bunut tua yang batangnya berlubang membentuk terowongan alami di atas jalan, dianggap keramat oleh warga.',
                'waktu' => 'Pagi', 'jam' => '07:00 – 18:00',
                'tarif' => 'Donasi',
                'cara' => 'Dari Negara sekitar 30 menit ke utara via Pekutatan.',
                'etika' => 'Jangan menyentuh atau melukai batang pohon. Hormati area persembahan dan jangan memarkir kendaraan di bawah pohon.',
                'pengelola' => 'Desa Adat Manggissari',
            ],
            [
                'slug' => 'pantai-pulukan', 'nama' => 'Pantai Pulukan', 'kategori' => 'Pantai',
                'wilayah' => 'jembrana', 'lat' => -8.4000, 'lng' => 114.8000, 'rating' => 4.3,
                'deskripsi' => 'Pantai berpasir hitam di pesisir Pekutatan dengan ombak besar dan suasana desa yang masih sepi.',
                'waktu' => 'Sore', 'jam' => '06:00 – 18:00',
                'tarif' => 'Gratis',
                'cara' => 'Dari Medewi sekitar 15 menit ke timur.',
                'etika' => 'Arus sangat kuat — jangan berenang. Jangan memarkir kendaraan di jalan sempit dan bawa turun sampah.',
                'pengelola' => 'Desa Adat Pulukan',
            ],
            [
                'slug' => 'air-terjun-juwuk-manis', 'nama' => 'Air Terjun Juwuk Manis', 'kategori' => 'Air Terjun',
                'wilayah' => 'jembrana', 'lat' => -8.3667, 'lng' => 114.7333, 'rating' => 4.4,
                'deskripsi' => 'Air terjun di lembah hutan Jembrana dengan kolam alami, sering dikunjungi dalam perjalanan menuju Medewi.',
                'waktu' => 'Pagi', 'jam' => '08:00 – 17:00',
                'tarif' => 'Rp 10.000',
                'cara' => 'Dari Negara sekitar 30 menit ke barat via Pekutatan.',
                'etika' => 'Jalur licin setelah hujan — gunakan alas kaki aman. Jangan berenang saat debit tinggi dan bawa turun sampah.',
                'pengelola' => 'Kelompok Sadar Wisata Juwuk Manis',
            ],
        ];
    }
}
