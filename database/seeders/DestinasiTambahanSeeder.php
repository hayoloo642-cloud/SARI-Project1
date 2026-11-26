<?php

namespace Database\Seeders;

use App\Models\Destinasi;
use App\Models\Wilayah;
use Illuminate\Database\Seeder;

class DestinasiTambahanSeeder extends Seeder
{
    /**
     * Melengkapi minimal 10 destinasi per wilayah yang sudah ada di SARI.
     *
     * Data disusun dari informasi publik (situs pengelola, dinas pariwisata,
     * peta OpenStreetMap). Tarif, jam buka, dan kontak dapat berubah —
     * verifikasi ulang sebelum dipakai untuk transaksi.
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

    /**
     * Data mentah destinasi tambahan.
     *
     * Dipakai juga oleh scripts/generate-destinasi-docs.php agar dokumentasi
     * selalu sinkron dengan data yang di-seed.
     */
    public static function rows(): array
    {
        return array_map(
            fn (array $r) => self::normalisasi($r),
            self::data()
        );
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
            // KARANGASEM (4 destinasi lama + 6 baru)
            // ---------------------------------------------------------------
            [
                'slug' => 'pantai-jemeluk', 'nama' => 'Pantai Jemeluk', 'kategori' => 'Pantai & Snorkeling',
                'wilayah' => 'karangasem', 'lat' => -8.3369, 'lng' => 115.6637, 'rating' => 4.7,
                'deskripsi' => 'Teluk kecil berpasir hitam di Amed dengan terumbu karang dangkal yang bisa dijangkau langsung dari bibir pantai.',
                'waktu' => 'April – Oktober (air paling jernih)', 'jam' => '06:00 – 18:00',
                'tarif' => 'Gratis; sewa alat snorkel ± Rp 50.000',
                'cara' => 'Dari Amlapura sekitar 1 jam ke arah Amed, lalu ikuti petunjuk Jemeluk.',
                'etika' => 'Jangan berdiri atau menyentuh terumbu karang, termasuk saat mengambil foto. Gunakan tabir surya ramah terumbu dan jangan memberi makan ikan.',
                'pengelola' => 'Kelompok Nelayan Jemeluk',
            ],
            [
                'slug' => 'pura-agung-besakih', 'nama' => 'Pura Agung Besakih', 'kategori' => 'Pura',
                'wilayah' => 'karangasem', 'lat' => -8.3739, 'lng' => 115.4504, 'rating' => 4.8,
                'deskripsi' => 'Pura induk Sad Kahyangan di lereng Gunung Agung, kompleks terbesar di Bali dengan puluhan pura pengiring.',
                'waktu' => 'Pagi 06.00 – 09.00 sebelum bus rombongan', 'jam' => '07:00 – 17:00',
                'tarif' => 'Donasi; sewa kamen ± Rp 25.000',
                'cara' => 'Dari Denpasar sekitar 2 jam via Rendang, atau 1 jam dari Amlapura.',
                'etika' => 'Wajib memakai kamen dan sopan. Saat upacara, wisatawan tidak boleh masuk ke area dalam — ikuti arahan pemandu dan jangan memotret pemuja dari dekat.',
                'pengelola' => 'Bendesa Adat Besakih',
            ],
            [
                'slug' => 'desa-tenganan', 'nama' => 'Desa Tenganan Pegringsingan', 'kategori' => 'Desa Adat',
                'wilayah' => 'karangasem', 'lat' => -8.4522, 'lng' => 115.6078, 'rating' => 4.7,
                'deskripsi' => 'Desa Bali Aga dengan tata ruang kuno dan kain gringsing tenun ikat ganda, salah satu warisan tekstil tertua di Bali.',
                'waktu' => 'Pagi, hindari tengah hari', 'jam' => '08:00 – 17:00',
                'tarif' => 'Donasi masuk desa',
                'cara' => 'Dari Amlapura sekitar 15 menit ke arah Candidasa, belok di Tenganan.',
                'etika' => 'Jangan memotret warga atau rumah tanpa izin. Beli tenun langsung dari perajin dan tawar dengan sopan; jangan menyentuh alat tenun tanpa dipersilakan.',
                'pengelola' => 'Bendesa Adat Tenganan',
            ],
            [
                'slug' => 'pantai-tulamben', 'nama' => 'Pantai Tulamben', 'kategori' => 'Pantai & Diving',
                'wilayah' => 'karangasem', 'lat' => -8.2745, 'lng' => 115.5932, 'rating' => 4.8,
                'deskripsi' => 'Pantai berbatu tempat bangkai kapal Liberty tahun 1942 menjadi salah satu spot diving paling terkenal di Bali.',
                'waktu' => 'April – Oktober; pagi untuk visibilitas terbaik', 'jam' => '06:00 – 18:00',
                'tarif' => 'Gratis; diving ± Rp 350.000 ke atas',
                'cara' => 'Dari Amlapura sekitar 45 menit ke utara via Kubu.',
                'etika' => 'Jangan menyentuh bangkai kapal atau karang. Gunakan operator diving bersertifikat dan patuhi batas kedalaman serta waktu menyelam.',
                'pengelola' => 'Kelompok Sadar Wisata Tulamben',
            ],
            [
                'slug' => 'bukit-asah-bugbug', 'nama' => 'Bukit Asah Bugbug', 'kategori' => 'Bukit & Camping',
                'wilayah' => 'karangasem', 'lat' => -8.4547, 'lng' => 115.6019, 'rating' => 4.6,
                'deskripsi' => 'Padang rumput di atas tebing yang menghadap Selat Lombok, populer untuk camping dan menikmati matahari terbit.',
                'waktu' => 'Sore untuk matahari terbenam atau pagi untuk camping', 'jam' => '07:00 – 19:00',
                'tarif' => 'Rp 10.000; camping tambahan',
                'cara' => 'Dari Amlapura sekitar 20 menit ke arah Bugbug.',
                'etika' => 'Bawa turun semua sampah dan jangan menyalakan api di luar area yang disediakan. Hormati warga desa dan jangan merusak padang rumput.',
                'pengelola' => 'Desa Adat Bugbug',
            ],
            [
                'slug' => 'pantai-bias-tugel', 'nama' => 'Pantai Bias Tugel', 'kategori' => 'Pantai',
                'wilayah' => 'karangasem', 'lat' => -8.4189, 'lng' => 115.5926, 'rating' => 4.6,
                'deskripsi' => 'Pantai berpasir putih tersembunyi di balik tebing dekat Padang Bai, dengan air tenang dan cocok untuk berenang.',
                'waktu' => 'Pagi sebelum ramai', 'jam' => '07:00 – 18:00',
                'tarif' => 'Rp 10.000',
                'cara' => 'Dari Padang Bai sekitar 10 menit, lalu turun lewat tangga.',
                'etika' => 'Jalur tangga sempit — jangan berhenti berlama-lama di tengah jalur. Bawa kembali sampah Anda karena tempat sampah terbatas.',
                'pengelola' => 'Kelompok Pengelola Pantai Bias Tugel',
            ],

            // ---------------------------------------------------------------
            // BULELENG (3 destinasi lama + 7 baru)
            // ---------------------------------------------------------------
            [
                'slug' => 'danau-tamblingan', 'nama' => 'Danau Tamblingan', 'kategori' => 'Danau & Hutan',
                'wilayah' => 'buleleng', 'lat' => -8.2725, 'lng' => 115.0897, 'rating' => 4.8,
                'deskripsi' => 'Danau vulkanik paling sunyi di Bali, dikelilingi hutan hujan dan kabut pagi di kawasan Munduk.',
                'waktu' => 'Pagi 07.00 – 10.00 saat kabut masih turun', 'jam' => '07:00 – 17:00',
                'tarif' => 'Rp 20.000',
                'cara' => 'Dari Singaraja sekitar 45 menit via Munduk.',
                'etika' => 'Danau dianggap suci — jangan membuat suara keras atau berenang tanpa izin. Jangan meninggalkan sampah dan hormati pura di tepi danau.',
                'pengelola' => 'Desa Adat Munduk & Kelompok Tani Hutan',
            ],
            [
                'slug' => 'danau-buyan', 'nama' => 'Danau Buyan', 'kategori' => 'Danau',
                'wilayah' => 'buleleng', 'lat' => -8.2333, 'lng' => 115.1167, 'rating' => 4.6,
                'deskripsi' => 'Danau terbesar di Bali utara, dikelilingi kebun sayur dan hutan pinus di dataran tinggi Pancasari.',
                'waktu' => 'Pagi hari', 'jam' => '07:00 – 18:00',
                'tarif' => 'Rp 10.000',
                'cara' => 'Dari Singaraja sekitar 45 menit ke arah Bedugul.',
                'etika' => 'Hormati area persembahan di tepi danau. Jangan memancing atau memetik tanaman tanpa izin warga.',
                'pengelola' => 'Desa Adat Pancasari',
            ],
            [
                'slug' => 'air-terjun-banyumala', 'nama' => 'Air Terjun Banyumala', 'kategori' => 'Air Terjun',
                'wilayah' => 'buleleng', 'lat' => -8.2683, 'lng' => 115.1025, 'rating' => 4.8,
                'deskripsi' => 'Air terjun kembar dengan kolam alami jernih di lembah hutan Wanagiri, sekitar 20 menit dari Munduk.',
                'waktu' => 'Pagi saat air masih jernih', 'jam' => '07:00 – 17:00',
                'tarif' => 'Rp 20.000',
                'cara' => 'Dari Munduk sekitar 20 menit, lalu trekking turun ±15 menit.',
                'etika' => 'Jalur licin setelah hujan — gunakan alas kaki yang aman. Jangan berenang saat debit air tinggi dan bawa turun sampah Anda.',
                'pengelola' => 'Kelompok Pengelola Banyumala',
            ],
            [
                'slug' => 'air-terjun-aling-aling', 'nama' => 'Air Terjun Aling-Aling', 'kategori' => 'Air Terjun',
                'wilayah' => 'buleleng', 'lat' => -8.2128, 'lng' => 115.1153, 'rating' => 4.6,
                'deskripsi' => 'Rangkaian air terjun di Sambangan dengan kolam alami dan jalur lompat air yang dipandu warga lokal.',
                'waktu' => 'Pagi', 'jam' => '08:00 – 17:00',
                'tarif' => 'Rp 20.000; guide ± Rp 100.000',
                'cara' => 'Dari Singaraja sekitar 30 menit ke arah Sambangan.',
                'etika' => 'Gunakan pemandu resmi untuk trekking dan melompat. Jangan melompat tanpa arahan karena kedalaman kolam berubah-ubah.',
                'pengelola' => 'Kelompok Pemandu Aling-Aling',
            ],
            [
                'slug' => 'pantai-pemuteran', 'nama' => 'Pantai Pemuteran', 'kategori' => 'Pantai & Konservasi',
                'wilayah' => 'buleleng', 'lat' => -8.1407, 'lng' => 114.6528, 'rating' => 4.8,
                'deskripsi' => 'Teluk tenang di barat laut Bali dengan proyek konservasi terumbu karang buatan dan snorkeling ramah pemula.',
                'waktu' => 'April – Oktober', 'jam' => '06:00 – 18:00',
                'tarif' => 'Gratis; snorkel ± Rp 75.000',
                'cara' => 'Dari Singaraja sekitar 1,5 jam ke arah Gilimanuk.',
                'etika' => 'Jangan menyentuh struktur coral garden atau memberi makan ikan. Gunakan tabir surya ramah terumbu dan pilih operator lokal.',
                'pengelola' => 'Kelompok Konservasi Karang Pemuteran',
            ],
            [
                'slug' => 'pura-beji-sangsit', 'nama' => 'Pura Beji Sangsit', 'kategori' => 'Pura',
                'wilayah' => 'buleleng', 'lat' => -8.0994, 'lng' => 115.1347, 'rating' => 4.7,
                'deskripsi' => 'Pura abad ke-15 di Sangsit dengan ukiran batu paras yang penuh detail, contoh arsitektur Bali utara.',
                'waktu' => 'Pagi', 'jam' => '08:00 – 17:00',
                'tarif' => 'Donasi',
                'cara' => 'Dari Singaraja sekitar 20 menit ke timur.',
                'etika' => 'Wajib memakai kamen dan sopan. Jangan menyentuh ukiran atau masuk ke area dalam saat upacara berlangsung.',
                'pengelola' => 'Bendesa Adat Sangsit',
            ],
            [
                'slug' => 'pulau-menjangan', 'nama' => 'Pulau Menjangan', 'kategori' => 'Taman Nasional & Diving',
                'wilayah' => 'buleleng', 'lat' => -8.1000, 'lng' => 114.4500, 'rating' => 4.9,
                'deskripsi' => 'Pulau kecil di Taman Nasional Bali Barat dengan terumbu karang sehat dan air sangat jernih.',
                'waktu' => 'April – Oktober', 'jam' => '07:00 – 17:00',
                'tarif' => 'Rp 20.000 + perahu/guide',
                'cara' => 'Dari Labuhan Lalang sekitar 30 menit dengan perahu.',
                'etika' => 'Wajib izin taman nasional dan didampingi guide. Jangan menyentuh karang, tidak boleh menangkap satwa, dan jangan berlabuh di area terumbu.',
                'pengelola' => 'Balai TN Bali Barat & Kelompok Perahu Labuhan Lalang',
            ],

            // ---------------------------------------------------------------
            // TABANAN (2 destinasi lama + 8 baru)
            // ---------------------------------------------------------------
            [
                'slug' => 'pura-ulun-danu-beratan', 'nama' => 'Pura Ulun Danu Beratan', 'kategori' => 'Pura & Danau',
                'wilayah' => 'tabanan', 'lat' => -8.2750, 'lng' => 115.1667, 'rating' => 4.9,
                'deskripsi' => 'Pura di tepi Danau Beratan yang ikonik dengan meru bertingkat, dikelilingi kabut dataran tinggi Bedugul.',
                'waktu' => 'Pagi 07.00 – 09.00', 'jam' => '07:00 – 19:00',
                'tarif' => 'Rp 75.000',
                'cara' => 'Dari Denpasar sekitar 2 jam via Bedugul.',
                'etika' => 'Wajib kamen. Area pura dalam ditutup untuk wisatawan saat upacara — jangan memaksa masuk atau memotret prosesi.',
                'pengelola' => 'Bendesa Adat Candikuning',
            ],
            [
                'slug' => 'pura-tanah-lot', 'nama' => 'Pura Tanah Lot', 'kategori' => 'Pura & Pantai',
                'wilayah' => 'tabanan', 'lat' => -8.6212, 'lng' => 115.0868, 'rating' => 4.8,
                'deskripsi' => 'Pura di atas batu karang lepas pantai yang menjadi salah satu pemandangan matahari terbenam paling dikenal di Bali.',
                'waktu' => 'Sore menjelang matahari terbenam', 'jam' => '07:00 – 19:00',
                'tarif' => 'Rp 60.000',
                'cara' => 'Dari Denpasar sekitar 45 menit via Kediri.',
                'etika' => 'Jangan memanjat batu pura atau masuk ke area upacara. Saat air pasang, jangan memaksa menyeberang ke batu pura.',
                'pengelola' => 'Bendesa Adat Beraban',
            ],
            [
                'slug' => 'pantai-kedungu', 'nama' => 'Pantai Kedungu', 'kategori' => 'Pantai & Surf',
                'wilayah' => 'tabanan', 'lat' => -8.6333, 'lng' => 115.1000, 'rating' => 4.6,
                'deskripsi' => 'Pantai berpasir gelap dengan ombak konsisten, sering dipakai peselancar lokal dan cocok untuk menikmati sore.',
                'waktu' => 'Sore', 'jam' => '06:00 – 19:00',
                'tarif' => 'Gratis',
                'cara' => 'Dari Denpasar sekitar 45 menit via Kediri.',
                'etika' => 'Arus bisa kuat — berenang hanya di area yang diawasi. Jangan memarkir kendaraan di pematang sawah warga.',
                'pengelola' => 'Kelompok Sadar Wisata Kedungu',
            ],
            [
                'slug' => 'pantai-pasut', 'nama' => 'Pantai Pasut', 'kategori' => 'Pantai',
                'wilayah' => 'tabanan', 'lat' => -8.6260, 'lng' => 115.0960, 'rating' => 4.5,
                'deskripsi' => 'Pantai panjang berpasir hitam dengan muara sungai dan suasana tenang, jauh dari keramaian Kuta.',
                'waktu' => 'Sore', 'jam' => '06:00 – 19:00',
                'tarif' => 'Gratis',
                'cara' => 'Dari Denpasar sekitar 1 jam via Kediri.',
                'etika' => 'Beberapa bagian pantai dianggap sakral — jangan berenang di dekat pura atau area persembahan. Jaga kebersihan.',
                'pengelola' => 'Desa Adat Tibubiu',
            ],
            [
                'slug' => 'pantai-balian', 'nama' => 'Pantai Balian', 'kategori' => 'Pantai & Surf',
                'wilayah' => 'tabanan', 'lat' => -8.5333, 'lng' => 114.9667, 'rating' => 4.7,
                'deskripsi' => 'Pantai di muara sungai dengan ombak kelas dunia, dikelilingi sawah dan perkebunan kelapa.',
                'waktu' => 'April – Oktober', 'jam' => '06:00 – 19:00',
                'tarif' => 'Gratis; parkir ± Rp 5.000',
                'cara' => 'Dari Denpasar sekitar 1,5 jam ke arah barat.',
                'etika' => 'Ombak untuk peselancar berpengalaman — jangan berenang di area arus balik. Hormati peselancar lokal dan antrean di lineup.',
                'pengelola' => 'Kelompok Surfing Balian',
            ],
            [
                'slug' => 'air-terjun-nungnung', 'nama' => 'Air Terjun Nungnung', 'kategori' => 'Air Terjun',
                'wilayah' => 'tabanan', 'lat' => -8.3167, 'lng' => 115.1667, 'rating' => 4.7,
                'deskripsi' => 'Air terjun tinggi di lembah hijau dengan sekitar 500 anak tangga, salah satu yang paling dramatis di Tabanan.',
                'waktu' => 'Pagi', 'jam' => '08:00 – 17:00',
                'tarif' => 'Rp 20.000',
                'cara' => 'Dari Denpasar sekitar 1,5 jam via Plaga.',
                'etika' => 'Tangga curam dan licin — gunakan alas kaki yang aman. Jangan berenang saat debit air tinggi atau hujan deras.',
                'pengelola' => 'Kelompok Pengelola Nungnung',
            ],
            [
                'slug' => 'kebun-raya-bali', 'nama' => 'Kebun Raya Bali', 'kategori' => 'Taman & Edukasi',
                'wilayah' => 'tabanan', 'lat' => -8.2833, 'lng' => 115.1667, 'rating' => 4.7,
                'deskripsi' => 'Kebun botani di Bedugul dengan koleksi anggrek, tanaman obat, dan hutan pinus yang sejuk.',
                'waktu' => 'Pagi', 'jam' => '08:00 – 18:00',
                'tarif' => 'Rp 20.000',
                'cara' => 'Dari Denpasar sekitar 2 jam via Bedugul.',
                'etika' => 'Jangan memetik atau merusak tanaman. Tetap di jalur dan jangan memberi makan satwa liar.',
                'pengelola' => 'UPT Kebun Raya Bali',
            ],
            [
                'slug' => 'museum-subak', 'nama' => 'Museum Subak', 'kategori' => 'Museum & Budaya',
                'wilayah' => 'tabanan', 'lat' => -8.5419, 'lng' => 115.1230, 'rating' => 4.5,
                'deskripsi' => 'Museum yang menjelaskan sistem irigasi subak, filosofi Tri Hita Karana, dan sejarah pertanian Bali.',
                'waktu' => 'Pagi', 'jam' => '08:00 – 16:00',
                'tarif' => 'Rp 10.000',
                'cara' => 'Dari Denpasar sekitar 45 menit ke arah Tabanan kota.',
                'etika' => 'Jangan menyentuh koleksi. Minta izin sebelum memotret dan jaga ketenangan ruang pamer.',
                'pengelola' => 'Dinas Kebudayaan Tabanan',
            ],

            // ---------------------------------------------------------------
            // KLUNGKUNG (10 destinasi baru)
            // ---------------------------------------------------------------
            [
                'slug' => 'pantai-kelingking', 'nama' => 'Pantai Kelingking', 'kategori' => 'Pantai & Tebing',
                'wilayah' => 'klungkung', 'lat' => -8.7510, 'lng' => 115.4720, 'rating' => 4.9,
                'deskripsi' => 'Tebing berbentuk kepala T-Rex yang ikonik di Nusa Penida, dengan pantai tersembunyi di bawahnya.',
                'waktu' => 'Pagi sebelum panas; hindari musim hujan', 'jam' => '07:00 – 18:00',
                'tarif' => 'Rp 10.000',
                'cara' => 'Fast boat dari Sanur ke Nusa Penida, lalu sekitar 45 menit berkendara.',
                'etika' => 'Jalur turun ke pantai sangat curam — jangan turun tanpa alas kaki layak dan jangan berdiri di tepi tebing untuk berfoto.',
                'pengelola' => 'Kelompok Sadar Wisata Bungamekar',
            ],
            [
                'slug' => 'pantai-diamond', 'nama' => 'Pantai Diamond', 'kategori' => 'Pantai',
                'wilayah' => 'klungkung', 'lat' => -8.7240, 'lng' => 115.4490, 'rating' => 4.7,
                'deskripsi' => 'Pantai berpasir putih dengan batu karang berlubang dan air biru jernih di timur Nusa Penida.',
                'waktu' => 'Pagi', 'jam' => '07:00 – 18:00',
                'tarif' => 'Rp 10.000',
                'cara' => 'Dari Pelabuhan Toya Pakeh sekitar 30 menit.',
                'etika' => 'Tangga dan tebing licin — jangan memanjat batu berlubang. Jangan meninggalkan sampah karena fasilitas terbatas.',
                'pengelola' => 'Desa Adat Pejukutan',
            ],
            [
                'slug' => 'broken-beach', 'nama' => 'Broken Beach (Pasih Uug)', 'kategori' => 'Pantai & Tebing',
                'wilayah' => 'klungkung', 'lat' => -8.7410, 'lng' => 115.4630, 'rating' => 4.8,
                'deskripsi' => 'Laguna melingkar yang terbentuk dari runtuhan tebing, membentuk kolam alami dengan lengkungan batu.',
                'waktu' => 'Pagi sampai sore', 'jam' => '07:00 – 18:00',
                'tarif' => 'Rp 10.000',
                'cara' => 'Dari Toya Pakeh sekitar 40 menit, dekat Angel\'s Billabong.',
                'etika' => 'Jangan berenang di laguna — arus kuat dan tidak ada pengawas. Jangan melewati pagar pembatas tebing.',
                'pengelola' => 'Kelompok Sadar Wisata Bungamekar',
            ],
            [
                'slug' => 'angels-billabong', 'nama' => 'Angel\'s Billabong', 'kategori' => 'Kolam Alami',
                'wilayah' => 'klungkung', 'lat' => -8.7420, 'lng' => 115.4700, 'rating' => 4.7,
                'deskripsi' => 'Kolam alami di celah karang dengan air sebening kristal, terhubung ke laut saat pasang.',
                'waktu' => 'Pagi saat air tenang', 'jam' => '07:00 – 18:00',
                'tarif' => 'Rp 10.000',
                'cara' => 'Dekat Broken Beach, sekitar 40 menit dari Toya Pakeh.',
                'etika' => 'Jangan berenang saat gelombang tinggi — kolam bisa tersapu arus. Ikuti arahan petugas dan jangan berdiri di bibir karang.',
                'pengelola' => 'Kelompok Sadar Wisata Bungamekar',
            ],
            [
                'slug' => 'crystal-bay', 'nama' => 'Crystal Bay', 'kategori' => 'Pantai & Snorkeling',
                'wilayah' => 'klungkung', 'lat' => -8.7160, 'lng' => 115.4560, 'rating' => 4.7,
                'deskripsi' => 'Teluk berpasir putih di barat Nusa Penida dengan terumbu karang dan spot snorkeling yang tenang.',
                'waktu' => 'Pagi sampai siang', 'jam' => '07:00 – 18:00',
                'tarif' => 'Rp 10.000',
                'cara' => 'Dari Toya Pakeh sekitar 20 menit.',
                'etika' => 'Jangan menyentuh karang atau memberi makan ikan. Gunakan tabir surya ramah terumbu dan jangan berlabuh di area snorkeling.',
                'pengelola' => 'Desa Adat Sakti',
            ],
            [
                'slug' => 'pantai-atuh', 'nama' => 'Pantai Atuh', 'kategori' => 'Pantai',
                'wilayah' => 'klungkung', 'lat' => -8.7667, 'lng' => 115.5167, 'rating' => 4.7,
                'deskripsi' => 'Pantai tersembunyi di balik tebing dengan batu karang besar, terasa jauh dari keramaian Nusa Penida.',
                'waktu' => 'Pagi', 'jam' => '07:00 – 18:00',
                'tarif' => 'Rp 10.000',
                'cara' => 'Dari Toya Pakeh sekitar 45 menit ke timur.',
                'etika' => 'Fasilitas terbatas — bawa air dan bawa turun sampah. Jangan memanjat karang dan berhati-hati saat pasang.',
                'pengelola' => 'Desa Adat Pejukutan',
            ],
            [
                'slug' => 'mushroom-bay', 'nama' => 'Mushroom Bay', 'kategori' => 'Pantai & Snorkeling',
                'wilayah' => 'klungkung', 'lat' => -8.7000, 'lng' => 115.4333, 'rating' => 4.6,
                'deskripsi' => 'Teluk berpasir putih di Nusa Lembongan dengan air tenang, cocok untuk berenang dan snorkeling pemula.',
                'waktu' => 'Pagi sampai sore', 'jam' => '06:00 – 18:00',
                'tarif' => 'Gratis',
                'cara' => 'Dari Jungutbatu sekitar 10 menit dengan kendaraan.',
                'etika' => 'Hormati kapal nelayan dan jangan berlabuh di area snorkeling. Jangan menyentuh karang atau memberi makan ikan.',
                'pengelola' => 'Kelompok Sadar Wisata Lembongan',
            ],
            [
                'slug' => 'pura-goa-giri-putri', 'nama' => 'Pura Goa Giri Putri', 'kategori' => 'Pura & Gua',
                'wilayah' => 'klungkung', 'lat' => -8.7028, 'lng' => 115.4639, 'rating' => 4.7,
                'deskripsi' => 'Pura di dalam gua karang di Nusa Penida, dianggap sebagai tempat pembersihan diri dan pengobatan tradisional.',
                'waktu' => 'Pagi', 'jam' => '07:00 – 17:00',
                'tarif' => 'Donasi',
                'cara' => 'Dari Toya Pakeh sekitar 15 menit, lalu naik tangga ke mulut gua.',
                'etika' => 'Wajib kamen dan berpakaian sopan. Sebagian area khusus untuk berdoa — jangan memotret pemuja atau membuat suara keras.',
                'pengelola' => 'Bendesa Adat Suana',
            ],
            [
                'slug' => 'kertha-gosa', 'nama' => 'Kertha Gosa & Puri Semarapura', 'kategori' => 'Sejarah & Budaya',
                'wilayah' => 'klungkung', 'lat' => -8.5353, 'lng' => 115.4042, 'rating' => 4.6,
                'deskripsi' => 'Bale kerajaan abad ke-18 dengan lukisan langit-langit bergaya Kamasan dan museum sejarah Klungkung.',
                'waktu' => 'Pagi', 'jam' => '08:00 – 17:00',
                'tarif' => 'Rp 25.000',
                'cara' => 'Berada di pusat Kota Semarapura, Klungkung.',
                'etika' => 'Jangan menyentuh lukisan langit-langit atau dinding bale. Jaga ketenangan dan minta izin sebelum memotret pemandu.',
                'pengelola' => 'Dinas Kebudayaan Klungkung',
            ],
            [
                'slug' => 'pura-goa-lawah', 'nama' => 'Pura Goa Lawah', 'kategori' => 'Pura & Gua',
                'wilayah' => 'klungkung', 'lat' => -8.5333, 'lng' => 115.4667, 'rating' => 4.6,
                'deskripsi' => 'Pura di mulut gua yang menjadi rumah ribuan kelelawar, salah satu pura penting di jalur timur Bali.',
                'waktu' => 'Pagi', 'jam' => '07:00 – 17:00',
                'tarif' => 'Donasi',
                'cara' => 'Dari Semarapura sekitar 15 menit ke arah timur.',
                'etika' => 'Jangan mendekati atau mengganggu kelelawar. Wajib kamen, jaga ketenangan, dan jangan memotret area suci tanpa izin.',
                'pengelola' => 'Bendesa Adat Pesinggahan',
            ],

            // ---------------------------------------------------------------
            // BANGLI (1 destinasi lama + 9 baru)
            // ---------------------------------------------------------------
            [
                'slug' => 'danau-batur', 'nama' => 'Danau Batur', 'kategori' => 'Danau & Gunung',
                'wilayah' => 'bangli', 'lat' => -8.2667, 'lng' => 115.3833, 'rating' => 4.7,
                'deskripsi' => 'Danau kawah di bawah Gunung Batur dengan pemandangan kaldera dan desa-desa adat di tepiannya.',
                'waktu' => 'Pagi sebelum kabut turun', 'jam' => '06:00 – 18:00',
                'tarif' => 'Gratis; parkir dan retribusi kawasan',
                'cara' => 'Dari Denpasar sekitar 2 jam via Kintamani.',
                'etika' => 'Danau dianggap suci — jangan membuang sampah atau berenang tanpa izin. Hormati upacara di pura tepi danau.',
                'pengelola' => 'Desa Adat Batur',
            ],
            [
                'slug' => 'pura-ulun-danu-batur', 'nama' => 'Pura Ulun Danu Batur', 'kategori' => 'Pura',
                'wilayah' => 'bangli', 'lat' => -8.2550, 'lng' => 115.3740, 'rating' => 4.8,
                'deskripsi' => 'Pura kedua terpenting di Bali setelah Besakih, dipindahkan ke atas kaldera untuk menghormati Dewi Danau.',
                'waktu' => 'Pagi', 'jam' => '07:00 – 17:00',
                'tarif' => 'Donasi',
                'cara' => 'Dari Kintamani sekitar 10 menit ke arah Batur.',
                'etika' => 'Wajib kamen dan sopan. Jangan memotret prosesi tanpa izin dan jangan memasuki area dalam pura.',
                'pengelola' => 'Bendesa Adat Batur',
            ],
            [
                'slug' => 'desa-trunyan', 'nama' => 'Desa Trunyan', 'kategori' => 'Desa Adat',
                'wilayah' => 'bangli', 'lat' => -8.2667, 'lng' => 115.4167, 'rating' => 4.5,
                'deskripsi' => 'Desa Bali Aga di tepi Danau Batur dengan tradisi pemakaman unik dan kehidupan yang masih sangat tradisional.',
                'waktu' => 'Pagi', 'jam' => '08:00 – 17:00',
                'tarif' => 'Perahu ± Rp 300.000 per kelompok',
                'cara' => 'Perahu dari Kedisan sekitar 30 menit menyeberangi danau.',
                'etika' => 'Sangat sensitif: jangan memotret kuburan, tengkorak, atau prosesi. Ikuti pemandu desa, jangan menyentuh apa pun, dan jangan masuk area yang dilarang.',
                'pengelola' => 'Desa Adat Trunyan',
            ],
            [
                'slug' => 'air-terjun-tukad-cepung', 'nama' => 'Air Terjun Tukad Cepung', 'kategori' => 'Air Terjun',
                'wilayah' => 'bangli', 'lat' => -8.3667, 'lng' => 115.3833, 'rating' => 4.7,
                'deskripsi' => 'Air terjun di dalam celah tebing yang terkenal karena berkas cahaya masuk dari atas pada pagi hari.',
                'waktu' => 'Pagi 08.00 – 10.00 saat cahaya masuk', 'jam' => '07:00 – 17:00',
                'tarif' => 'Rp 20.000',
                'cara' => 'Dari Ubud sekitar 45 menit via Tembuku.',
                'etika' => 'Jalur sempit dan licin — jangan berhenti di tengah antrean foto. Jangan berenang saat debit tinggi dan bawa turun sampah.',
                'pengelola' => 'Kelompok Pengelola Tukad Cepung',
            ],
            [
                'slug' => 'air-terjun-tibumana', 'nama' => 'Air Terjun Tibumana', 'kategori' => 'Air Terjun',
                'wilayah' => 'bangli', 'lat' => -8.3520, 'lng' => 115.3160, 'rating' => 4.7,
                'deskripsi' => 'Air terjun bertirai tipis dengan kolam dangkal yang mudah dijangkau, cocok untuk kunjungan singkat dari Ubud.',
                'waktu' => 'Pagi', 'jam' => '08:00 – 17:00',
                'tarif' => 'Rp 20.000',
                'cara' => 'Dari Ubud sekitar 30 menit ke arah Apuan.',
                'etika' => 'Berenang hanya di area yang aman dan jangan memanjat batu di bawah air terjun. Jangan meninggalkan sampah.',
                'pengelola' => 'Kelompok Pengelola Tibumana',
            ],
            [
                'slug' => 'pura-kehen', 'nama' => 'Pura Kehen', 'kategori' => 'Pura',
                'wilayah' => 'bangli', 'lat' => -8.4333, 'lng' => 115.3500, 'rating' => 4.7,
                'deskripsi' => 'Pura kerajaan Bangli abad ke-11 dengan tangga besar, pohon beringin tua, dan arsitektur Bali klasik.',
                'waktu' => 'Pagi', 'jam' => '08:00 – 17:00',
                'tarif' => 'Donasi',
                'cara' => 'Berada di pusat Kota Bangli.',
                'etika' => 'Wajib kamen. Tangga dan dinding pura tidak untuk diduduki; jangan memotret pemuja dari dekat.',
                'pengelola' => 'Bendesa Adat Cempaga',
            ],
            [
                'slug' => 'toya-devasya', 'nama' => 'Toya Devasya Hot Spring', 'kategori' => 'Pemandian Air Panas',
                'wilayah' => 'bangli', 'lat' => -8.2410, 'lng' => 115.4080, 'rating' => 4.6,
                'deskripsi' => 'Pemandian air panas alami di tepi Danau Batur dengan kolam menghadap gunung dan danau.',
                'waktu' => 'Sore saat udara sejuk', 'jam' => '08:00 – 20:00',
                'tarif' => 'Rp 150.000 ke atas',
                'cara' => 'Dari Kintamani sekitar 10 menit ke arah Toya Bungkah.',
                'etika' => 'Gunakan pakaian renang yang sopan dan jangan membawa makanan ke kolam. Jaga ketenangan karena kawasan ini juga dipakai untuk pemulihan.',
                'pengelola' => 'Toya Devasya',
            ],
            [
                'slug' => 'pura-puncak-penulisan', 'nama' => 'Pura Puncak Penulisan', 'kategori' => 'Pura & Panorama',
                'wilayah' => 'bangli', 'lat' => -8.2833, 'lng' => 115.3500, 'rating' => 4.6,
                'deskripsi' => 'Pura tertinggi di Bali dengan deretan meru dan panorama Gunung Batur serta Gunung Agung.',
                'waktu' => 'Pagi saat langit cerah', 'jam' => '08:00 – 17:00',
                'tarif' => 'Donasi',
                'cara' => 'Dari Kintamani sekitar 20 menit via Penulisan.',
                'etika' => 'Wajib kamen dan jaga ketenangan di area puncak. Jangan memanjat bangunan atau memotret upacara tanpa izin.',
                'pengelola' => 'Bendesa Adat Penulisan',
            ],
            [
                'slug' => 'bukit-cinta-batur', 'nama' => 'Bukit Cinta Batur', 'kategori' => 'Panorama',
                'wilayah' => 'bangli', 'lat' => -8.2500, 'lng' => 115.3833, 'rating' => 4.6,
                'deskripsi' => 'Bukit pandang di tepi kaldera Batur, populer untuk menikmati matahari terbit dan kabut pagi.',
                'waktu' => 'Sore atau pagi', 'jam' => '07:00 – 19:00',
                'tarif' => 'Rp 10.000',
                'cara' => 'Dari Kintamani sekitar 5 menit ke arah Batur.',
                'etika' => 'Jangan turun ke lereng tanpa jalur resmi. Bawa jaket karena angin dingin dan jangan meninggalkan sampah.',
                'pengelola' => 'Desa Adat Batur',
            ],

            // ---------------------------------------------------------------
            // GIANYAR (2 destinasi lama + 8 baru)
            // ---------------------------------------------------------------
            [
                'slug' => 'goa-gajah', 'nama' => 'Goa Gajah', 'kategori' => 'Sejarah & Pura',
                'wilayah' => 'gianyar', 'lat' => -8.5230, 'lng' => 115.2870, 'rating' => 4.7,
                'deskripsi' => 'Candi gua abad ke-11 dengan mulut gua berukir raksasa dan kolam pemandian kuno di Bedulu.',
                'waktu' => 'Pagi', 'jam' => '08:00 – 17:00',
                'tarif' => 'Rp 50.000',
                'cara' => 'Dari Ubud sekitar 15 menit ke arah Bedulu.',
                'etika' => 'Wajib kamen. Jangan menyentuh relief atau masuk ke kolam pemandian kuno; area suci tetap dipakai untuk berdoa.',
                'pengelola' => 'Bendesa Adat Bedulu',
            ],
            [
                'slug' => 'pura-gunung-kawi', 'nama' => 'Pura Gunung Kawi', 'kategori' => 'Pura & Sejarah',
                'wilayah' => 'gianyar', 'lat' => -8.4236, 'lng' => 115.3117, 'rating' => 4.7,
                'deskripsi' => 'Kompleks candi yang dipahat langsung di dinding tebing pada abad ke-11, dikelilingi sawah dan sungai.',
                'waktu' => 'Pagi', 'jam' => '08:00 – 17:00',
                'tarif' => 'Rp 50.000',
                'cara' => 'Dari Ubud sekitar 20 menit via Tampaksiring.',
                'etika' => 'Banyak tangga dan jalur licin — gunakan alas kaki aman. Jangan memotret pemuja dari dekat atau menyentuh candi.',
                'pengelola' => 'Bendesa Adat Tampaksiring',
            ],
            [
                'slug' => 'air-terjun-tegenungan', 'nama' => 'Air Terjun Tegenungan', 'kategori' => 'Air Terjun',
                'wilayah' => 'gianyar', 'lat' => -8.5750, 'lng' => 115.2900, 'rating' => 4.6,
                'deskripsi' => 'Air terjun lebar dekat Ubud dengan kolam luas dan deretan warung di tepi sungai.',
                'waktu' => 'Pagi', 'jam' => '07:00 – 18:00',
                'tarif' => 'Rp 20.000',
                'cara' => 'Dari Ubud sekitar 15 menit ke arah Sukawati.',
                'etika' => 'Arus bisa deras — jangan berenang dekat jatuhan air. Jangan meninggalkan sampah dan hormati jalur warga.',
                'pengelola' => 'Kelompok Pengelola Tegenungan',
            ],
            [
                'slug' => 'sawah-tegallalang', 'nama' => 'Sawah Tegallalang', 'kategori' => 'Sawah & Terasering',
                'wilayah' => 'gianyar', 'lat' => -8.4312, 'lng' => 115.2790, 'rating' => 4.8,
                'deskripsi' => 'Terasering sawah bertingkat di lembah utara Ubud, dengan subak dan warung kopi menghadap sawah.',
                'waktu' => 'Pagi 07.00 – 09.00', 'jam' => '06:00 – 18:00',
                'tarif' => 'Donasi; ayunan dan fasilitas berbayar',
                'cara' => 'Dari Ubud sekitar 20 menit ke utara.',
                'etika' => 'Jangan menginjak pematang yang sedang diperbaiki atau tanaman padi. Hormati petani dan minta izin sebelum memotret mereka.',
                'pengelola' => 'Subak Tegallalang',
            ],
            [
                'slug' => 'monkey-forest-ubud', 'nama' => 'Mandala Suci Wenara Wana', 'kategori' => 'Hutan & Satwa',
                'wilayah' => 'gianyar', 'lat' => -8.5188, 'lng' => 115.2590, 'rating' => 4.7,
                'deskripsi' => 'Hutan suci di Ubud dengan ratusan monyet ekor panjang dan pura kecil di antara pohon beringin.',
                'waktu' => 'Pagi', 'jam' => '08:30 – 17:30',
                'tarif' => 'Rp 80.000',
                'cara' => 'Berada di Jalan Monkey Forest, pusat Ubud.',
                'etika' => 'Jangan memberi makanan manusia atau menyentuh monyet. Simpan barang kecil, jangan menatap mata monyet, dan jangan membawa makanan di tangan.',
                'pengelola' => 'Desa Adat Padangtegal',
            ],
            [
                'slug' => 'puri-saren-agung', 'nama' => 'Puri Saren Agung', 'kategori' => 'Puri & Budaya',
                'wilayah' => 'gianyar', 'lat' => -8.5069, 'lng' => 115.2625, 'rating' => 4.6,
                'deskripsi' => 'Puri kerajaan Ubud di persimpangan pusat kota, masih menjadi pusat kegiatan adat dan pertunjukan tari.',
                'waktu' => 'Pagi', 'jam' => '08:00 – 17:00',
                'tarif' => 'Donasi',
                'cara' => 'Berada di pusat Ubud, dekat Pasar Seni Ubud.',
                'etika' => 'Jangan memasuki area privat puri. Minta izin sebelum memotret dan jangan mengganggu persiapan upacara atau pertunjukan.',
                'pengelola' => 'Puri Saren Agung',
            ],
            [
                'slug' => 'pantai-keramas', 'nama' => 'Pantai Keramas', 'kategori' => 'Pantai & Surf',
                'wilayah' => 'gianyar', 'lat' => -8.5920, 'lng' => 115.3310, 'rating' => 4.6,
                'deskripsi' => 'Pantai berpasir hitam di pantai timur Gianyar dengan ombak konsisten dan suasana lebih tenang dari Kuta.',
                'waktu' => 'Pagi', 'jam' => '06:00 – 19:00',
                'tarif' => 'Gratis; parkir ± Rp 5.000',
                'cara' => 'Dari Ubud sekitar 30 menit ke arah timur.',
                'etika' => 'Ombak untuk peselancar mahir — jangan berenang di area arus. Hormati peselancar lokal dan jangan memarkir di jalur warga.',
                'pengelola' => 'Kelompok Sadar Wisata Keramas',
            ],
            [
                'slug' => 'pasar-seni-sukawati', 'nama' => 'Pasar Seni Sukawati', 'kategori' => 'Pasar & Kerajinan',
                'wilayah' => 'gianyar', 'lat' => -8.5600, 'lng' => 115.2830, 'rating' => 4.5,
                'deskripsi' => 'Pasar tradisional tempat perajin Gianyar menjual kain, ukiran, dan suvenir langsung kepada pembeli.',
                'waktu' => 'Pagi 08.00 – 11.00', 'jam' => '08:00 – 18:00',
                'tarif' => 'Gratis',
                'cara' => 'Dari Ubud sekitar 20 menit ke selatan.',
                'etika' => 'Tawar harga dengan sopan dan jangan memaksa. Minta izin sebelum memotret pedagang atau barang dagangan.',
                'pengelola' => 'Paguyuban Pedagang Sukawati',
            ],
        ];
    }
}
