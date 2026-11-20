<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class KalenderSeeder extends Seeder
{
    /**
     * Data asli dari database SARI (live per 19 Nov 2026, terbaru).
     * Idempoten: aman dijalankan berkali-kali.
     * Parent id di-resolve dari slug/nama, bukan hardcode id.
     */
    public function run(): void
    {

        $rows = [
            ['nama' => 'Nyepi', 'tanggal_teks' => 'Menurut kalender Saka (biasanya Maret–April)', 'keterangan' => 'Hari sunyi, seluruh aktivitas di Bali berhenti 24 jam.', 'saran' => 'Tetap di akomodasi, lampu redup, jangan beraktivitas di luar.', 'sejarah' => 'Hari Raya Nyepi menandai pergantian Tahun Baru Saka Hindu yang dimulai sejak tahun 78 Masehi, merujuk pada rekonsiliasi damai antar-suku bangsa di India kuno oleh Raja Kaniska I. Di Bali, Nyepi bertransformasi menjadi momen pemurnian kosmos (Bhuana Agung) dan batin manusia (Bhuana Alit) melalui Catur Brata Penyepian: Amati Geni (tidak menyalakan api/cahaya), Amati Karya (tidak bekerja), Amati Lelungan (tidak bepergian), dan Amati Lelanguan (tidak bersenang-senang). Sehari sebelum Nyepi, diadakan upacara Tawur Kesanga dan pawai Ogoh-ogoh sebagai simbol menetralisir sifat-sifat negatif (Bhuta Kala) agar keharmonisan semesta kembali suci.', 'tanggal_iso' => '2027-03-08'],
            ['nama' => 'Galungan', 'tanggal_teks' => 'Setiap 210 hari (kalender Pawukon)', 'keterangan' => 'Perayaan kemenangan dharma, penjor dipasang di depan rumah.', 'saran' => 'Pura ramai, warga memakai busana adat. Foto boleh dengan penuh hormat.', 'sejarah' => 'Hari Raya Galungan diperingati untuk merayakan kemenangan kebajikan (Dharma) melawan kejahatan (Adharma). Tradisi ini pertama kali dirayakan secara resmi pada Purnama Kapat tahun 882 Masehi semasa pemerintahan Raja Sri Jayakasunu. Konon raja menerima wangsit suci dari Dewi Durga untuk mengadakan perayaan puja bhakti kepada Hyang Widhi dan para leluhur agar wabah malapetaka reda. Penjor megah yang terbuat dari bambu berhiaskan janur, padi, dan hasil bumi dipasang di depan setiap rumah sebagai lambang Gunung Agung dan naga kemakmuran Basuki-Ananta Boga.', 'tanggal_iso' => '2027-01-13'],
            ['nama' => 'Kuningan', 'tanggal_teks' => '10 hari setelah Galungan', 'keterangan' => 'Hari para leluhur kembali ke surga.', 'saran' => 'Suasana mirip Galungan namun lebih tenang. Waktu terbaik melihat ritual keluarga.', 'sejarah' => 'Hari Raya Kuningan jatuh tepat 10 hari setelah Galungan, menandai penutupan rangkaian perayaan kemenangan Dharma. Menurut teologi Hindu Bali, pada hari ini para Dewa dan roh suci leluhur yang sebelumnya turun mengunjungi sanak keluarga saat Galungan akan kembali berpulang ke Swargaloka. Ciri khas upacara Kuningan adalah persembahan nasi kuning (simbol kemakmuran dan rasa syukur) serta Tamiang dan Kolem yang dipasang di pelinggih sebagai tameng pertahanan spiritual diri dari marabahaya.', 'tanggal_iso' => '2027-01-23'],
            ['nama' => 'Saraswati', 'tanggal_teks' => 'Setiap 210 hari', 'keterangan' => 'Hari ilmu pengetahuan, buku dan lontar disembahyakan.', 'saran' => 'Sekolah dan perpustakaan mungkin libur. Hormati ritual yang berlangsung.', 'sejarah' => 'Hari Raya Saraswati dirayakan setiap hari Saniscara Umanis Wuku Watugunung untuk memuja Sang Hyang Saraswati, dewi penguasa ilmu pengetahuan, sastra, dan kebijaksanaan suci. Filosofi Saraswati mengajarkan bahwa pengetahuan adalah senjata sejati manusia untuk mengatasi kebodohan (Awidya) dan mencapai pencerahan hidup. Pada hari ini, kitab suci Weda, lontar kuno, dan buku-buku disucikan dengan canang sari dan wewangian, sementara umat berpantang membaca dan menulis sampai matahari terbit keesokan harinya saat Banyu Pinaruh (mandi suci penyucian diri di mata air).', 'tanggal_iso' => '2027-05-29'],
        ];

        foreach ($rows as $row) {
            \App\Models\Kalender::updateOrCreate(['nama' => $row['nama']], $row);
        }
    }
}
