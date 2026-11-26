<?php

namespace Database\Seeders;

use App\Models\Kalender;
use Illuminate\Database\Seeder;

class KalenderSeeder extends Seeder
{
    /**
     * Data kalender upacara dan hari raya keagamaan Hindu Bali terlengkap.
     * Idempoten: aman dijalankan berkali-kali.
     */
    public function run(): void
    {
        $rows = [
            [
                'nama' => 'Nyepi (Tahun Baru Saka 1949)',
                'tanggal_teks' => 'Menurut kalender Saka (biasanya Maret–April)',
                'keterangan' => 'Hari suci pergantian Tahun Baru Saka. Seluruh Pulau Bali hening, hening tanpa api, kerja, bepergian, maupun hiburan.',
                'saran' => 'Seluruh aktivitas publik dan penerbangan di Bali berhenti 24 jam. Wisatawan wajib tetap di akomodasi, menjaga ketenangan, dan meredupkan lampu.',
                'sejarah' => 'Hari Raya Nyepi menandai pergantian Tahun Baru Saka Hindu yang dimulai sejak tahun 78 Masehi, merujuk pada rekonsiliasi damai antar-suku bangsa di India kuno oleh Raja Kaniska I. Di Bali, Nyepi bertransformasi menjadi momen pemurnian kosmos (Bhuana Agung) dan batin manusia (Bhuana Alit) melalui Catur Brata Penyepian: Amati Geni (tidak menyalakan api/cahaya), Amati Karya (tidak bekerja), Amati Lelungan (tidak bepergian), dan Amati Lelanguan (tidak bersenang-senang). Sehari sebelum Nyepi, diadakan upacara Tawur Kesanga dan pawai Ogoh-ogoh sebagai simbol menetralisir sifat-sifat negatif (Bhuta Kala) agar keharmonisan semesta kembali suci.',
                'tanggal_iso' => '2027-03-08'
            ],
            [
                'nama' => 'Galungan',
                'tanggal_teks' => 'Setiap 210 hari (Rabu Kliwon Dungulan)',
                'keterangan' => 'Hari suci merayakan kemenangan Dharma (kebenaran) melawan Adharma (keburukan). Penjor megah menghiasi tepi jalan di seluruh Bali.',
                'saran' => 'Pura keluarga dan pura desa ramai warga berpakaian sembahyang adat. Hormati rombongan ngelawang (barong keliling desa). Foto boleh diambil dengan sopan dari kejauhan.',
                'sejarah' => 'Hari Raya Galungan diperingati untuk merayakan kemenangan kebajikan (Dharma) melawan kejahatan (Adharma). Tradisi ini pertama kali dirayakan secara resmi pada Purnama Kapat tahun 882 Masehi semasa pemerintahan Raja Sri Jayakasunu. Konon raja menerima wangsit suci dari Dewi Durga untuk mengadakan perayaan puja bhakti kepada Hyang Widhi dan para leluhur agar wabah malapetaka reda. Penjor megah yang terbuat dari bambu berhiaskan janur, padi, dan hasil bumi dipasang di depan setiap rumah sebagai lambang Gunung Agung dan naga kemakmuran Basuki-Ananta Boga.',
                'tanggal_iso' => '2027-01-13'
            ],
            [
                'nama' => 'Kuningan',
                'tanggal_teks' => '10 hari setelah Galungan (Sabtu Kliwon Kuningan)',
                'keterangan' => 'Hari persembahyangan saat para Dewa dan roh leluhur yang berkunjung saat Galungan kembali berpulang ke alam surga (Swarga Loka).',
                'saran' => 'Persembahyangan selesai sebelum tengah hari (pukul 12.00 WITA). Suasana desa tenang dan penuh kekeluargaan.',
                'sejarah' => 'Hari Raya Kuningan jatuh tepat 10 hari setelah Galungan, menandai penutupan rangkaian perayaan kemenangan Dharma. Menurut teologi Hindu Bali, pada hari ini para Dewa dan roh suci leluhur yang sebelumnya turun mengunjungi sanak keluarga saat Galungan akan kembali berpulang ke Swargaloka. Ciri khas upacara Kuningan adalah persembahan nasi kuning (simbol kemakmuran dan rasa syukur) serta Tamiang dan Kolem yang dipasang di pelinggih sebagai tameng pertahanan spiritual diri dari marabahaya.',
                'tanggal_iso' => '2027-01-23'
            ],
            [
                'nama' => 'Saraswati',
                'tanggal_teks' => 'Setiap 210 hari (Sabtu Umanis Watugunung)',
                'keterangan' => 'Hari pemujaan Dewi Saraswati sebagai manifestasi Tuhan Yang Maha Esa yang menurunkan ilmu pengetahuan suci, sastra, dan kebijaksanaan.',
                'saran' => 'Buku, kitab suci, dan lontar diupacarai. Siswa dan umat memadati pura sekolah dan kantor. Diimbau tidak membaca atau menulis hingga ritual persembahyangan selesai.',
                'sejarah' => 'Hari Raya Saraswati dirayakan setiap hari Saniscara Umanis Wuku Watugunung untuk memuja Sang Hyang Saraswati, dewi penguasa ilmu pengetahuan, sastra, dan kebijaksanaan suci. Filosofi Saraswati mengajarkan bahwa pengetahuan adalah senjata sejati manusia untuk mengatasi kebodohan (Awidya) dan mencapai pencerahan hidup. Pada hari ini, kitab suci Weda, lontar kuno, dan buku-buku disucikan dengan canang sari dan wewangian, sementara umat berpantang membaca dan menulis sampai matahari terbit keesokan harinya saat Banyu Pinaruh (mandi suci penyucian diri di mata air).',
                'tanggal_iso' => '2027-05-29'
            ],
            [
                'nama' => 'Banyu Pinaruh',
                'tanggal_teks' => 'Sehari setelah Saraswati (Minggu Paing Sinta)',
                'keterangan' => 'Ritual mandi suci pembersihan diri (melukat) di laut, danau, atau mata air alami menyambut berkah ilmu pengetahuan yang baru.',
                'saran' => 'Pagi buta sebelum matahari terbit, pantai dan sumber mata air (seperti Tirta Empul) sangat ramai warga melakukan ritual penyucian.',
                'sejarah' => 'Banyu Pinaruh berasal dari kata banyu (air) dan pinaruh (kawruh/pengetahuan). Maknanya adalah memohon air suci pengetahuan untuk membersihkan kekotoran pikiran, perkataan, dan perbuatan. Umat menyucikan diri di sumber air alami lalu berkumpul di rumah meminum ramuan jamu tradisional kumkuman dan menyantap nasi kuning sebagai simbol penyerapan energi kesegaran budi pekerti.',
                'tanggal_iso' => '2027-05-30'
            ],
            [
                'nama' => 'Pagerwesi',
                'tanggal_teks' => '4 hari setelah Saraswati (Rabu Kliwon Sinta)',
                'keterangan' => 'Hari memagari keteguhan iman dan jiwa agar terhindar dari godaan kegelapan, memuliakan Sang Hyang Pramesti Guru.',
                'saran' => 'Perayaan besar terutama di Bali Utara (Buleleng). Warga menghaturkan sesaji di sanggah keluarga dan pura desa.',
                'sejarah' => 'Pagerwesi bermakna pagar besi — perisai rohani yang kokoh. Umat memuja Sang Hyang Widhi dalam manifestasinya sebagai Sang Hyang Pramesti Guru (Guru Semesta Alam). Tujuannya adalah memagari diri dengan keteguhan batin dan kebijaksanaan sejati yang telah diperoleh pada hari Saraswati, sehingga manusia tidak tergelincir oleh hawa nafsu dan kesombongan.',
                'tanggal_iso' => '2027-06-02'
            ],
            [
                'nama' => 'Purnama (Bulan Purnama)',
                'tanggal_teks' => 'Setiap Sukla Paksa (Bulan Penuh, 15 hari sekali)',
                'keterangan' => 'Hari suci saat pancaran sinar Sang Hyang Candra membawa ketenangan spiritual. Momen piodalan (hari jadi) ratusan pura di Bali.',
                'saran' => 'Umat Hindu berbusana adat sembahyang ke pura. Pura-pura besar seperti Pura Besakih dan Tirta Empul mengadakan piodalan meriah.',
                'sejarah' => 'Hari Purnama adalah hari memuja Sang Hyang Candra dan Sang Hyang Siwa Raditya. Dalam naskah Sundarigama, Purnama dipandang sebagai hari penuh berkah di mana energi ketuhanan dan keindahan kosmik memancar sempurna, sangat baik untuk pembersihan batin, meditasi, dan memohon anugerah kesucian serta rezeki berlimpah.',
                'tanggal_iso' => '2027-01-22'
            ],
            [
                'nama' => 'Tilem (Bulan Mati)',
                'tanggal_teks' => 'Setiap Kresna Paksa (Bulan Mati/Gelap)',
                'keterangan' => 'Hari suci peleburan kotoran batin dan pemujaan Dewa Surya agar memberikan cahaya pencerahan di tengah kegelapan.',
                'saran' => 'Umat melakukan persembahyangan dan upacara pecaruan di catus pata (perempatan jalan) untuk menjaga keseimbangan dengan alam.',
                'sejarah' => 'Tilem adalah waktu ketika posisi bulan dan matahari berada searah, melambangkan heningnya kegelapan awal semesta. Umat Hindu memanfaatkan hari Tilem untuk peleburan mala (dosa/kekotoran spiritual) melalui doa tulus dan persembahan sesaji, memohon agar sinar kesadaran batin selalu menerangi jalan hidup.',
                'tanggal_iso' => '2027-02-06'
            ],
            [
                'nama' => 'Tumpek Landep',
                'tanggal_teks' => 'Setiap Saniscara Kliwon Wuku Landep',
                'keterangan' => 'Hari pemuliaan ketajaman pikiran (jnana). Secara simbolis diupacarai pusaka keris, perkakas logam, kendaraan, dan teknologi.',
                'saran' => 'Jangan salah kaprah mengira warga menyembah benda logam atau mobil; upacara ini adalah rasa syukur atas ketajaman pikiran manusia yang melahirkan teknologi bermanfaat.',
                'sejarah' => 'Kata Landep berarti tajam atau runcing. Hakikat Tumpek Landep adalah ungkapan terima kasih kepada Sang Hyang Siwa Pasupati atas karunia ketajaman pikiran budi manusia. Benda-benda tajam seperti keris pusaka, parang, kendaraan, dan perangkat digital dihias janur sebagai simbol bahwa alat-alat buatan manusia harus diarahkan untuk kebaikan, bukan untuk mencelakai sesama.',
                'tanggal_iso' => '2027-02-27'
            ],
            [
                'nama' => 'Tumpek Kandang (Uye)',
                'tanggal_teks' => 'Setiap Saniscara Kliwon Wuku Uye',
                'keterangan' => 'Hari kasih sayang terhadap fauna dan satwa ciptaan Tuhan yang membantu keberlangsungan hidup manusia.',
                'saran' => 'Hewan ternak, burung, dan binatang peliharaan diberi kalung janur dan sesaji khusus. Waktu yang baik untuk melihat harmoni manusia dan alam.',
                'sejarah' => 'Berdasarkan ajaran luhur Tri Hita Karana (harmoni dengan sesama, alam, dan Tuhan), manusia berhutang budi pada binatang yang membantu membajak sawah, menjaga rumah, dan menopang ekosistem. Umat memuja Sang Hyang Rare Angon (pengembala semesta) memohon agar satwa dan fauna tetap lestari dan terhindar dari wabah penyakit.',
                'tanggal_iso' => '2027-04-03'
            ],
            [
                'nama' => 'Siwaratri (Malam Renungan Suci)',
                'tanggal_teks' => 'Setiap Panglong Ping 14 Sasih Kapitu',
                'keterangan' => 'Malam pemujaan suci Hyang Siwa untuk peleburan dosa dan introspeksi diri (jagra/berjaga semalam suntuk).',
                'saran' => 'Umat Hindu berjaga sepanjang malam (begadang suci) sambil melantunkan kakawin di pura. Suasana pura hening dan khusyuk.',
                'sejarah' => 'Berdasarkan kisah kuno Lubdaka karangan Mpu Tanakung, seorang pemburu bernama Lubdaka tanpa sengaja melakukan brata pemujaan Siwa di atas pohon bila di tepi telaga, sehingga arwahnya diselamatkan Dewa Siwa. Filosofi intinya adalah kesempatan bagi manusia untuk merenungi perbuatannya, memohon ampunan, dan berjanji memperbaiki kualitas moral ke depan.',
                'tanggal_iso' => '2027-01-07'
            ]
        ];

        foreach ($rows as $row) {
            Kalender::updateOrCreate(['nama' => $row['nama']], $row);
        }
    }
}
