<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DestinasiDetailSeeder extends Seeder
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
            ['destinasi_slug' => 'amed-pantai', 'urutan' => 0, 'paragraf' => 'Amed bukan satu pantai tunggal, melainkan rangkaian desa nelayan di sepanjang pesisir timur laut Karangasem — dari Cemeluk, Lipah, hingga Bunutan. Pasir hitam vulkaniknya berasal dari endapan Gunung Agung, memberi warna laut yang pekat dan kontras dengan perahu jukung putih yang tersusun rapi di tepian.'],
            ['destinasi_slug' => 'amed-pantai', 'urutan' => 1, 'paragraf' => 'Di bawah permukaan, terumbu karang Amed termasuk yang paling sehat di Bali dan menjadi lokasi populer untuk snorkeling serta pelatihan selam. Pagi hari adalah waktu terbaik: laut tenang, cahaya lembut, dan para nelayan mulai turun ke perahu untuk melaut.'],
            ['destinasi_slug' => 'tirta-gangga', 'urutan' => 0, 'paragraf' => 'Dibangun tahun 1948 oleh raja terakhir Karangasem, Anak Agung Anglurah Ketut Karangasem, Tirta Gangga adalah taman air kerajaan yang memadukan gaya Bali, Tiongkok, dan Eropa. Namanya berarti "air dari Gangga", merujuk pada air suci sungai Gangga di India.'],
            ['destinasi_slug' => 'tirta-gangga', 'urutan' => 1, 'paragraf' => 'Ikon utamanya adalah kolam dengan patung dewa dan ratu naga di atas air, serta deretan batu pijakan (stepping stones) yang memungkinkan Anda berjalan di atas kolam berisi ikan koi. Air yang mengisi kolam berasal dari mata air suci di daerah itu dan dipercaya memiliki kekuatan penyembuh.'],
            ['destinasi_slug' => 'pura-lempuyang', 'urutan' => 0, 'paragraf' => 'Pura Lempuyang Luhur berdiri di puncak Bukit Lempuyang (±1.175 mdpl) dan merupakan salah satu Sad Kahyangan — enam pura utama arah mata angin di Bali — yang dipercaya sudah ada lebih dari 1.000 tahun.'],
            ['destinasi_slug' => 'pura-lempuyang', 'urutan' => 1, 'paragraf' => 'Candi Bentar di Pura Penataran Agung menjadi fenomena viral "Gates of Heaven" karena membingkai Gunung Agung dengan awan di kejauhan. Namun bagi umat Hindu, pura ini terutama tempat pemujaan Hyang Iswara; kunjungan wisata diharapkan menempati ruang tanpa mengganggu ritus yang sedang berlangsung.'],
            ['destinasi_slug' => 'lovina-pantai', 'urutan' => 0, 'paragraf' => 'Lovina adalah kawasan pantai di pesisir utara Buleleng yang mencakup tujuh desa, dengan pusat di Kalibukbuk. Lautnya jauh lebih tenang dibanding pantai selatan sehingga aktivitas di air nyaman dilakukan sepanjang pagi.'],
            ['destinasi_slug' => 'lovina-pantai', 'urutan' => 1, 'paragraf' => 'Atraksi utama Lovina adalah menonton lumba-lumba liar yang berkumpul di perairan ini pada pagi buta. Perahu tradisional berangkat sekitar pukul 05.30–06.00 dan menunggu lumba-lumba muncul di tengah laut. Setelah itu, snorkeling di perairan karang di sekitar Teluk Lovina juga populer.'],
            ['destinasi_slug' => 'gitgit-airterjun', 'urutan' => 0, 'paragraf' => 'Gitgit adalah air terjun paling terkenal di Bali utara, dengan ketinggian sekitar 45 meter. Aliran airnya jatuh ke kolam alami yang dikelilingi bebatuan dan pepohonan tropis yang rimbun.'],
            ['destinasi_slug' => 'gitgit-airterjun', 'urutan' => 1, 'paragraf' => 'Akses menuju air terjun melalui jalur berbatu selama 10–15 menit dari parkir. Sepanjang jalur Anda melewati kebun cengkeh dan kopi milik warga, memberi gambaran nyata kehidupan agraris desa di dataran tinggi Buleleng.'],
            ['destinasi_slug' => 'jatiluwih-sawah', 'urutan' => 0, 'paragraf' => 'Jatiluwih berarti "luar biasa indah" — dan terasering sawahnya memang setara dengan namanya. Terbentang lebih dari 600 hektar di kaki Gunung Batukaru, sawah di Jatiluwih mengikuti sistem subak, sistem irigasi tradisional Bali yang telah berusia lebih dari 1.000 tahun dan diakui UNESCO sebagai Warisan Budaya Dunia pada 2012.'],
            ['destinasi_slug' => 'jatiluwih-sawah', 'urutan' => 1, 'paragraf' => 'Saat berjalan di jalur setapak sawah, Anda akan bertemu petani yang bekerja dengan cara tradisional serta angsa-angsa yang berkeliaran. Warna pemandangan berubah menurut musim: hijau muda saat masa tanam dan kuning keemasan menjelang panen.'],
            ['destinasi_slug' => 'pura-batukaru', 'urutan' => 0, 'paragraf' => 'Pura Luhur Batukaru adalah salah satu Sad Kahyangan yang dipercaya menjaga arah barat Bali. Berbeda dengan pura-pura besar yang terbuka, pura ini tersembunyi di dalam hutan lebat di lereng Gunung Batukaru dengan arsitektur khas lereng gunung.'],
            ['destinasi_slug' => 'pura-batukaru', 'urutan' => 1, 'paragraf' => 'Kabut yang turun hampir setiap siang memberikan suasana mistis. Area pura dijaga hening oleh burung-burung hutan, memberi pengalaman ibadah dan refleksi yang sulit ditemukan di pura lain di Bali.'],
            ['destinasi_slug' => 'sidemen-sawah', 'urutan' => 0, 'paragraf' => 'Sidemen adalah lembah pedesaan di kaki Gunung Agung yang sering dijuluki "Ubud dua puluh tahun silam" — jauh lebih tenang namun sama indahnya. Warga menggeluti pertanian sawah, tenun songket endek, dan pembuatan arak tradisional.'],
            ['destinasi_slug' => 'sidemen-sawah', 'urutan' => 1, 'paragraf' => 'Berjalan menyusuri jalan desa, Anda akan melihat kegiatan sehari-hari warga: petani membajak sawah, ibu-ibu menenun di beranda, dan anak-anak bermain di sungai. Ini destinasi untuk merelaksasi diri tanpa keramaian.'],
            ['destinasi_slug' => 'penglipuran-desa', 'urutan' => 1, 'paragraf' => 'Penglipuran adalah desa adat Bali Aga di Bangli, dikenal karena tata ruangnya yang simetris: jalan utama lurus membujur timur-barat diapit barisan rumah adat dengan gapura angkul-angkul yang seragam, dipisahkan ladang tanaman upacara di belakang.'],
            ['destinasi_slug' => 'penglipuran-desa', 'urutan' => 2, 'paragraf' => 'Warga masih hidup dengan aturan adat (awig-awig) ketat — kebersihan halaman, pelestarian bambu, dan busana adat saat upacara. Pengunjung dipersilakan berjalan menyusuri desa, namun diminta menghormati rumah-rumah pribadi dan tidak masuk tanpa izin.'],
            ['destinasi_slug' => 'sekumpul-air-terjun', 'urutan' => 1, 'paragraf' => 'Sekumpul adalah kumpulan tujuh air terjun yang jatuh dari tebing hutan vulkanik di Buleleng utara. Nama “Sekumpul” berarti “bergerombol” dalam bahasa Bali — sesuai bentuknya yang datang bergerombol dari tiga arah sungai.'],
            ['destinasi_slug' => 'sekumpul-air-terjun', 'urutan' => 2, 'paragraf' => 'Trek turun dan naik membutuhkan kondisi fisik menengah dengan banyak anak tangga basah. Papan peringatan dan pemandu lokal tersedia — pendakian HANYA boleh dengan pemandu resmi desa demi keamanan dan bagi hasil ekonomi warga.'],
            ['destinasi_slug' => 'mangrove-pemogan', 'urutan' => 1, 'paragraf' => 'Taman Hutan Raya (Tahura) Ngurah Rai adalah kawasan mangrove terbesar di Bali, membentang dari Pemogan hingga Nusa Dua. Fungsi utamanya menahan abrasi dan habitat satwa laut — belangkas, kepiting bakau, dan burung air.'],
            ['destinasi_slug' => 'mangrove-pemogan', 'urutan' => 2, 'paragraf' => 'Pengunjung dapat berjalan di jembatan kayu atas kanopi mangrove atau menyewa kano. Tiket masuk langsung mendukung program rehabilitasi mangrove bersama warga pesisir.'],
            ['destinasi_slug' => 'tirta-empul-pura', 'urutan' => 1, 'paragraf' => 'Pura Tirta Empul dibangun sekitar tahun 962 M di lokasi mata air alami yang terus mengalir. Kata “Tirta Empul” berarti “air yang memancar kuat” — airnya dipercaya menyucikan fisik dan batin.'],
            ['destinasi_slug' => 'tirta-empul-pura', 'urutan' => 2, 'paragraf' => 'Kolam pemandian (pancoran) berderet 30 lebih air mancur dengan aliran air pegunungan segar. Melukat adalah ritual pemandian suci yang terbuka bagi umat Hindu maupun pengunjung non-Hindu yang menghormati tata cara dan aturan pura.'],
        ];

        foreach ($rows as $row) {
            $row['destinasi_id'] = $destinasiIds[$row['destinasi_slug']];
            unset($row['destinasi_slug']);
            \App\Models\DestinasiDetail::updateOrCreate([
                'destinasi_id' => $row['destinasi_id'],
                'urutan' => $row['urutan'],
            ], $row);
        }
    }
}
