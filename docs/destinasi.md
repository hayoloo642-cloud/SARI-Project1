# Dokumentasi Destinasi SARI

Dokumen ini di-generate otomatis dari database melalui `scripts/generate-destinasi-docs.php`.
Jangan mengedit tabel di bawah secara manual — ubah data lewat seeder/panel admin lalu generate ulang.

- **Tanggal generate:** 26 November 2026
- **Total destinasi:** 60
- **Wilayah:** 6 (Karangasem, Buleleng, Tabanan, Klungkung, Bangli, Gianyar)
- **Target minimum:** 10 destinasi per wilayah

> Catatan: tarif, jam buka, dan kontak adalah perkiraan dari informasi publik dan dapat berubah.
> Koordinat bersifat perkiraan untuk keperluan peta, bukan titik pintu masuk resmi.
> Destinasi tanpa foto akan memakai fallback desain SARI (`.ph-fallback`).

## Ringkasan per Wilayah

| Wilayah | Jumlah | Status |
|---|---:|---|
| Bangli | 10 | Memenuhi |
| Buleleng | 10 | Memenuhi |
| Gianyar | 10 | Memenuhi |
| Karangasem | 10 | Memenuhi |
| Klungkung | 10 | Memenuhi |
| Tabanan | 10 | Memenuhi |

## Cara Menambah / Memperbarui Data

1. Tambahkan entri baru di `database/seeders/DestinasiSeeder.php` atau `database/seeders/DestinasiTambahanSeeder.php`.
2. Gunakan `slug` yang unik, isi `wilayah` sesuai slug wilayah, dan koordinat desimal.
3. Jalankan `php artisan db:seed --class=DestinasiTambahanSeeder --force` (idempoten, aman diulang).
4. Generate ulang dokumen: `php scripts/generate-destinasi-docs.php`.
5. Untuk foto, simpan berkas di `public/assets/images/` lalu isi kolom `gambar` dengan `assets/images/namafile.jpg`.

## Bangli

Danau Batur, udara sejuk pegunungan, dan adat yang masih hidup.

Jumlah: **10 destinasi**.

### Air Terjun Tibumana

- **Slug:** `air-terjun-tibumana`
- **Kategori:** Air Terjun
- **Tarif:** Rp 20.000
- **Jam buka:** 08:00 – 17:00
- **Waktu terbaik:** Pagi
- **Koordinat:** -8.352, 115.316
- **Pengelola:** Kelompok Pengelola Tibumana
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Air terjun bertirai tipis dengan kolam dangkal yang mudah dijangkau, cocok untuk kunjungan singkat dari Ubud.

**Cara masuk:** Dari Ubud sekitar 30 menit ke arah Apuan.

**Etika:** Berenang hanya di area yang aman dan jangan memanjat batu di bawah air terjun. Jangan meninggalkan sampah.

### Air Terjun Tukad Cepung

- **Slug:** `air-terjun-tukad-cepung`
- **Kategori:** Air Terjun
- **Tarif:** Rp 20.000
- **Jam buka:** 07:00 – 17:00
- **Waktu terbaik:** Pagi 08.00 – 10.00 saat cahaya masuk
- **Koordinat:** -8.3667, 115.3833
- **Pengelola:** Kelompok Pengelola Tukad Cepung
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Air terjun di dalam celah tebing yang terkenal karena berkas cahaya masuk dari atas pada pagi hari.

**Cara masuk:** Dari Ubud sekitar 45 menit via Tembuku.

**Etika:** Jalur sempit dan licin — jangan berhenti di tengah antrean foto. Jangan berenang saat debit tinggi dan bawa turun sampah.

### Bukit Cinta Batur

- **Slug:** `bukit-cinta-batur`
- **Kategori:** Panorama
- **Tarif:** Rp 10.000
- **Jam buka:** 07:00 – 19:00
- **Waktu terbaik:** Sore atau pagi
- **Koordinat:** -8.25, 115.3833
- **Pengelola:** Desa Adat Batur
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Bukit pandang di tepi kaldera Batur, populer untuk menikmati matahari terbit dan kabut pagi.

**Cara masuk:** Dari Kintamani sekitar 5 menit ke arah Batur.

**Etika:** Jangan turun ke lereng tanpa jalur resmi. Bawa jaket karena angin dingin dan jangan meninggalkan sampah.

### Danau Batur

- **Slug:** `danau-batur`
- **Kategori:** Danau & Gunung
- **Tarif:** Gratis; parkir dan retribusi kawasan
- **Jam buka:** 06:00 – 18:00
- **Waktu terbaik:** Pagi sebelum kabut turun
- **Koordinat:** -8.2667, 115.3833
- **Pengelola:** Desa Adat Batur
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Danau kawah di bawah Gunung Batur dengan pemandangan kaldera dan desa-desa adat di tepiannya.

**Cara masuk:** Dari Denpasar sekitar 2 jam via Kintamani.

**Etika:** Danau dianggap suci — jangan membuang sampah atau berenang tanpa izin. Hormati upacara di pura tepi danau.

### Desa Penglipuran

- **Slug:** `penglipuran-desa`
- **Kategori:** Desa Adat
- **Tarif:** Rp 30.000
- **Jam buka:** 08:00 – 18:00
- **Waktu terbaik:** April – Oktober
- **Koordinat:** -8.4222, 115.3589
- **Pengelola:** Bendesa Adat & Kelompok Sadar Wisata Penglipuran
- **Kontak:** 0366-22208
- **Foto:** belum tersedia (fallback desain)

Desa adat Bali Aga yang bersih, lestari, dan dikenal sebagai salah satu desa terbersih di dunia.

**Cara masuk:** Kendaraan pribadi dari Denpasar via Kintamani, sekitar 1,5 jam.

**Etika:** Jangan memotret warga di dalam rumah tanpa izin. Tetap di jalur umum dan hormati upacara yang sedang berlangsung — jangan lewat di depan prosesi.

### Desa Trunyan

- **Slug:** `desa-trunyan`
- **Kategori:** Desa Adat
- **Tarif:** Perahu ± Rp 300.000 per kelompok
- **Jam buka:** 08:00 – 17:00
- **Waktu terbaik:** Pagi
- **Koordinat:** -8.2667, 115.4167
- **Pengelola:** Desa Adat Trunyan
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Desa Bali Aga di tepi Danau Batur dengan tradisi pemakaman unik dan kehidupan yang masih sangat tradisional.

**Cara masuk:** Perahu dari Kedisan sekitar 30 menit menyeberangi danau.

**Etika:** Sangat sensitif: jangan memotret kuburan, tengkorak, atau prosesi. Ikuti pemandu desa, jangan menyentuh apa pun, dan jangan masuk area yang dilarang.

### Pura Kehen

- **Slug:** `pura-kehen`
- **Kategori:** Pura
- **Tarif:** Donasi
- **Jam buka:** 08:00 – 17:00
- **Waktu terbaik:** Pagi
- **Koordinat:** -8.4333, 115.35
- **Pengelola:** Bendesa Adat Cempaga
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Pura kerajaan Bangli abad ke-11 dengan tangga besar, pohon beringin tua, dan arsitektur Bali klasik.

**Cara masuk:** Berada di pusat Kota Bangli.

**Etika:** Wajib kamen. Tangga dan dinding pura tidak untuk diduduki; jangan memotret pemuja dari dekat.

### Pura Puncak Penulisan

- **Slug:** `pura-puncak-penulisan`
- **Kategori:** Pura & Panorama
- **Tarif:** Donasi
- **Jam buka:** 08:00 – 17:00
- **Waktu terbaik:** Pagi saat langit cerah
- **Koordinat:** -8.2833, 115.35
- **Pengelola:** Bendesa Adat Penulisan
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Pura tertinggi di Bali dengan deretan meru dan panorama Gunung Batur serta Gunung Agung.

**Cara masuk:** Dari Kintamani sekitar 20 menit via Penulisan.

**Etika:** Wajib kamen dan jaga ketenangan di area puncak. Jangan memanjat bangunan atau memotret upacara tanpa izin.

### Pura Ulun Danu Batur

- **Slug:** `pura-ulun-danu-batur`
- **Kategori:** Pura
- **Tarif:** Donasi
- **Jam buka:** 07:00 – 17:00
- **Waktu terbaik:** Pagi
- **Koordinat:** -8.255, 115.374
- **Pengelola:** Bendesa Adat Batur
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Pura kedua terpenting di Bali setelah Besakih, dipindahkan ke atas kaldera untuk menghormati Dewi Danau.

**Cara masuk:** Dari Kintamani sekitar 10 menit ke arah Batur.

**Etika:** Wajib kamen dan sopan. Jangan memotret prosesi tanpa izin dan jangan memasuki area dalam pura.

### Toya Devasya Hot Spring

- **Slug:** `toya-devasya`
- **Kategori:** Pemandian Air Panas
- **Tarif:** Rp 150.000 ke atas
- **Jam buka:** 08:00 – 20:00
- **Waktu terbaik:** Sore saat udara sejuk
- **Koordinat:** -8.241, 115.408
- **Pengelola:** Toya Devasya
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Pemandian air panas alami di tepi Danau Batur dengan kolam menghadap gunung dan danau.

**Cara masuk:** Dari Kintamani sekitar 10 menit ke arah Toya Bungkah.

**Etika:** Gunakan pakaian renang yang sopan dan jangan membawa makanan ke kolam. Jaga ketenangan karena kawasan ini juga dipakai untuk pemulihan.

## Buleleng

Pantai hitam, lumba-lumba, dan air terjun di utara Bali.

Jumlah: **10 destinasi**.

### Air Terjun Aling-Aling

- **Slug:** `air-terjun-aling-aling`
- **Kategori:** Air Terjun
- **Tarif:** Rp 20.000; guide ± Rp 100.000
- **Jam buka:** 08:00 – 17:00
- **Waktu terbaik:** Pagi
- **Koordinat:** -8.2128, 115.1153
- **Pengelola:** Kelompok Pemandu Aling-Aling
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Rangkaian air terjun di Sambangan dengan kolam alami dan jalur lompat air yang dipandu warga lokal.

**Cara masuk:** Dari Singaraja sekitar 30 menit ke arah Sambangan.

**Etika:** Gunakan pemandu resmi untuk trekking dan melompat. Jangan melompat tanpa arahan karena kedalaman kolam berubah-ubah.

### Air Terjun Banyumala

- **Slug:** `air-terjun-banyumala`
- **Kategori:** Air Terjun
- **Tarif:** Rp 20.000
- **Jam buka:** 07:00 – 17:00
- **Waktu terbaik:** Pagi saat air masih jernih
- **Koordinat:** -8.2683, 115.1025
- **Pengelola:** Kelompok Pengelola Banyumala
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Air terjun kembar dengan kolam alami jernih di lembah hutan Wanagiri, sekitar 20 menit dari Munduk.

**Cara masuk:** Dari Munduk sekitar 20 menit, lalu trekking turun ±15 menit.

**Etika:** Jalur licin setelah hujan — gunakan alas kaki yang aman. Jangan berenang saat debit air tinggi dan bawa turun sampah Anda.

### Air Terjun Gitgit

- **Slug:** `gitgit-airterjun`
- **Kategori:** Alam & Hutan
- **Tarif:** Rp 20.000
- **Jam buka:** 07:00 – 17:00
- **Waktu terbaik:** Pagi hari pukul 07.00 – 10.00
- **Koordinat:** -8.1969, 115.1378
- **Pengelola:** Kelompok Pengelola Air Terjun Gitgit
- **Kontak:** 0815-6677-8899
- **Foto:** assets/images/gitgit.jpg

Air terjun 45 meter di hutan tropis dengan jalur melewati kebun cengkeh dan kopi warga.

**Cara masuk:** Dari Singaraja ke arah selatan, sekitar 10 km.

**Etika:** Jangan membuang sampah di sekitar air terjun dan gunakan tempat sampah yang disediakan. Jangan memanjat pagar pengaman yang ada.

### Air Terjun Sekumpul

- **Slug:** `sekumpul-air-terjun`
- **Kategori:** Air Terjun
- **Tarif:** Rp 75.000 (termasuk guide)
- **Jam buka:** 07:00 – 17:00
- **Waktu terbaik:** April – Oktober (cuaca cerah)
- **Koordinat:** -8.1778, 115.1827
- **Pengelola:** Kelompok Pemandu Lokal Lemukih–Sekumpul
- **Kontak:** 0821-9900-1122
- **Foto:** belum tersedia (fallback desain)

Gugusan 7 air terjun di lembah hijau Buleleng — disebut-sebut terindah di Bali.

**Cara masuk:** Kendaraan pribadi dari Lovina, sekitar 45 menit; lalu trekking.

**Etika:** Gunakan pemandu resmi desa — trek tanpa guide dilarang dan berbahaya. Jangan berenang saat debit air tinggi dan jangan meninggalkan sampah di lembah.

### Danau Buyan

- **Slug:** `danau-buyan`
- **Kategori:** Danau
- **Tarif:** Rp 10.000
- **Jam buka:** 07:00 – 18:00
- **Waktu terbaik:** Pagi hari
- **Koordinat:** -8.2333, 115.1167
- **Pengelola:** Desa Adat Pancasari
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Danau terbesar di Bali utara, dikelilingi kebun sayur dan hutan pinus di dataran tinggi Pancasari.

**Cara masuk:** Dari Singaraja sekitar 45 menit ke arah Bedugul.

**Etika:** Hormati area persembahan di tepi danau. Jangan memancing atau memetik tanaman tanpa izin warga.

### Danau Tamblingan

- **Slug:** `danau-tamblingan`
- **Kategori:** Danau & Hutan
- **Tarif:** Rp 20.000
- **Jam buka:** 07:00 – 17:00
- **Waktu terbaik:** Pagi 07.00 – 10.00 saat kabut masih turun
- **Koordinat:** -8.2725, 115.0897
- **Pengelola:** Desa Adat Munduk & Kelompok Tani Hutan
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Danau vulkanik paling sunyi di Bali, dikelilingi hutan hujan dan kabut pagi di kawasan Munduk.

**Cara masuk:** Dari Singaraja sekitar 45 menit via Munduk.

**Etika:** Danau dianggap suci — jangan membuat suara keras atau berenang tanpa izin. Jangan meninggalkan sampah dan hormati pura di tepi danau.

### Pantai Lovina

- **Slug:** `lovina-pantai`
- **Kategori:** Pantai & Nelayan
- **Tarif:** Gratis
- **Jam buka:** 05:00 – 19:00
- **Waktu terbaik:** Mei – Oktober (perairan paling tenang)
- **Koordinat:** -8.1609, 115.0267
- **Pengelola:** Kelompok Nelayan Lovina
- **Kontak:** 0814-5566-7788
- **Foto:** assets/images/lovina.jpg

Laut tenang utara Bali tempat lumba-lumba liar muncul di pagi buta.

**Cara masuk:** Kendaraan pribadi dari Singaraja, sekitar 15 menit.

**Etika:** Jangan memberi makan atau menyentuh lumba-lumba. Pilih operator perahu yang dikelola nelayan lokal dan ikuti arahan mereka saat di laut.

### Pantai Pemuteran

- **Slug:** `pantai-pemuteran`
- **Kategori:** Pantai & Konservasi
- **Tarif:** Gratis; snorkel ± Rp 75.000
- **Jam buka:** 06:00 – 18:00
- **Waktu terbaik:** April – Oktober
- **Koordinat:** -8.1407, 114.6528
- **Pengelola:** Kelompok Konservasi Karang Pemuteran
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Teluk tenang di barat laut Bali dengan proyek konservasi terumbu karang buatan dan snorkeling ramah pemula.

**Cara masuk:** Dari Singaraja sekitar 1,5 jam ke arah Gilimanuk.

**Etika:** Jangan menyentuh struktur coral garden atau memberi makan ikan. Gunakan tabir surya ramah terumbu dan pilih operator lokal.

### Pulau Menjangan

- **Slug:** `pulau-menjangan`
- **Kategori:** Taman Nasional & Diving
- **Tarif:** Rp 20.000 + perahu/guide
- **Jam buka:** 07:00 – 17:00
- **Waktu terbaik:** April – Oktober
- **Koordinat:** -8.1, 114.45
- **Pengelola:** Balai TN Bali Barat & Kelompok Perahu Labuhan Lalang
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Pulau kecil di Taman Nasional Bali Barat dengan terumbu karang sehat dan air sangat jernih.

**Cara masuk:** Dari Labuhan Lalang sekitar 30 menit dengan perahu.

**Etika:** Wajib izin taman nasional dan didampingi guide. Jangan menyentuh karang, tidak boleh menangkap satwa, dan jangan berlabuh di area terumbu.

### Pura Beji Sangsit

- **Slug:** `pura-beji-sangsit`
- **Kategori:** Pura
- **Tarif:** Donasi
- **Jam buka:** 08:00 – 17:00
- **Waktu terbaik:** Pagi
- **Koordinat:** -8.0994, 115.1347
- **Pengelola:** Bendesa Adat Sangsit
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Pura abad ke-15 di Sangsit dengan ukiran batu paras yang penuh detail, contoh arsitektur Bali utara.

**Cara masuk:** Dari Singaraja sekitar 20 menit ke timur.

**Etika:** Wajib memakai kamen dan sopan. Jangan menyentuh ukiran atau masuk ke area dalam saat upacara berlangsung.

## Gianyar

Jantung seni dan kerajinan Bali dengan pasar-pasar tradisional.

Jumlah: **10 destinasi**.

### Air Terjun Tegenungan

- **Slug:** `air-terjun-tegenungan`
- **Kategori:** Air Terjun
- **Tarif:** Rp 20.000
- **Jam buka:** 07:00 – 18:00
- **Waktu terbaik:** Pagi
- **Koordinat:** -8.575, 115.29
- **Pengelola:** Kelompok Pengelola Tegenungan
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Air terjun lebar dekat Ubud dengan kolam luas dan deretan warung di tepi sungai.

**Cara masuk:** Dari Ubud sekitar 15 menit ke arah Sukawati.

**Etika:** Arus bisa deras — jangan berenang dekat jatuhan air. Jangan meninggalkan sampah dan hormati jalur warga.

### Goa Gajah

- **Slug:** `goa-gajah`
- **Kategori:** Sejarah & Pura
- **Tarif:** Rp 50.000
- **Jam buka:** 08:00 – 17:00
- **Waktu terbaik:** Pagi
- **Koordinat:** -8.523, 115.287
- **Pengelola:** Bendesa Adat Bedulu
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Candi gua abad ke-11 dengan mulut gua berukir raksasa dan kolam pemandian kuno di Bedulu.

**Cara masuk:** Dari Ubud sekitar 15 menit ke arah Bedulu.

**Etika:** Wajib kamen. Jangan menyentuh relief atau masuk ke kolam pemandian kuno; area suci tetap dipakai untuk berdoa.

### Mandala Suci Wenara Wana

- **Slug:** `monkey-forest-ubud`
- **Kategori:** Hutan & Satwa
- **Tarif:** Rp 80.000
- **Jam buka:** 08:30 – 17:30
- **Waktu terbaik:** Pagi
- **Koordinat:** -8.5188, 115.259
- **Pengelola:** Desa Adat Padangtegal
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Hutan suci di Ubud dengan ratusan monyet ekor panjang dan pura kecil di antara pohon beringin.

**Cara masuk:** Berada di Jalan Monkey Forest, pusat Ubud.

**Etika:** Jangan memberi makanan manusia atau menyentuh monyet. Simpan barang kecil, jangan menatap mata monyet, dan jangan membawa makanan di tangan.

### Pantai Keramas

- **Slug:** `pantai-keramas`
- **Kategori:** Pantai & Surf
- **Tarif:** Gratis; parkir ± Rp 5.000
- **Jam buka:** 06:00 – 19:00
- **Waktu terbaik:** Pagi
- **Koordinat:** -8.592, 115.331
- **Pengelola:** Kelompok Sadar Wisata Keramas
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Pantai berpasir hitam di pantai timur Gianyar dengan ombak konsisten dan suasana lebih tenang dari Kuta.

**Cara masuk:** Dari Ubud sekitar 30 menit ke arah timur.

**Etika:** Ombak untuk peselancar mahir — jangan berenang di area arus. Hormati peselancar lokal dan jangan memarkir di jalur warga.

### Pasar Seni Sukawati

- **Slug:** `pasar-seni-sukawati`
- **Kategori:** Pasar & Kerajinan
- **Tarif:** Gratis
- **Jam buka:** 08:00 – 18:00
- **Waktu terbaik:** Pagi 08.00 – 11.00
- **Koordinat:** -8.56, 115.283
- **Pengelola:** Paguyuban Pedagang Sukawati
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Pasar tradisional tempat perajin Gianyar menjual kain, ukiran, dan suvenir langsung kepada pembeli.

**Cara masuk:** Dari Ubud sekitar 20 menit ke selatan.

**Etika:** Tawar harga dengan sopan dan jangan memaksa. Minta izin sebelum memotret pedagang atau barang dagangan.

### Pura Gunung Kawi

- **Slug:** `pura-gunung-kawi`
- **Kategori:** Pura & Sejarah
- **Tarif:** Rp 50.000
- **Jam buka:** 08:00 – 17:00
- **Waktu terbaik:** Pagi
- **Koordinat:** -8.4236, 115.3117
- **Pengelola:** Bendesa Adat Tampaksiring
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Kompleks candi yang dipahat langsung di dinding tebing pada abad ke-11, dikelilingi sawah dan sungai.

**Cara masuk:** Dari Ubud sekitar 20 menit via Tampaksiring.

**Etika:** Banyak tangga dan jalur licin — gunakan alas kaki aman. Jangan memotret pemuja dari dekat atau menyentuh candi.

### Pura Tirta Empul

- **Slug:** `tirta-empul-pura`
- **Kategori:** Pura & Pemurnian
- **Tarif:** Rp 75.000
- **Jam buka:** 08:00 – 18:00
- **Waktu terbaik:** Pagi sebelum 10:00 (paling hening)
- **Koordinat:** -8.4164, 115.3147
- **Pengelola:** Bendesa Adat Tampaksiring & Pengelola Pura Tirta Empul
- **Kontak:** 0361-981190
- **Foto:** belum tersedia (fallback desain)

Pura mata air suci abad ke-10 di Tampaksiring — tempat melukat (pembersihan diri).

**Cara masuk:** Kendaraan pribadi dari Ubud via Tampaksiring, sekitar 30 menit.

**Etika:** Wajib kain saput + syal (tersedia di pintu). Dilarang memasuki kolam pemandian saat menstruasi menurut tradisi. Niatkan melukat dengan hormat, bukan untuk bersenang-senang.

### Puri Saren Agung

- **Slug:** `puri-saren-agung`
- **Kategori:** Puri & Budaya
- **Tarif:** Donasi
- **Jam buka:** 08:00 – 17:00
- **Waktu terbaik:** Pagi
- **Koordinat:** -8.5069, 115.2625
- **Pengelola:** Puri Saren Agung
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Puri kerajaan Ubud di persimpangan pusat kota, masih menjadi pusat kegiatan adat dan pertunjukan tari.

**Cara masuk:** Berada di pusat Ubud, dekat Pasar Seni Ubud.

**Etika:** Jangan memasuki area privat puri. Minta izin sebelum memotret dan jangan mengganggu persiapan upacara atau pertunjukan.

### Sawah Tegallalang

- **Slug:** `sawah-tegallalang`
- **Kategori:** Sawah & Terasering
- **Tarif:** Donasi; ayunan dan fasilitas berbayar
- **Jam buka:** 06:00 – 18:00
- **Waktu terbaik:** Pagi 07.00 – 09.00
- **Koordinat:** -8.4312, 115.279
- **Pengelola:** Subak Tegallalang
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Terasering sawah bertingkat di lembah utara Ubud, dengan subak dan warung kopi menghadap sawah.

**Cara masuk:** Dari Ubud sekitar 20 menit ke utara.

**Etika:** Jangan menginjak pematang yang sedang diperbaiki atau tanaman padi. Hormati petani dan minta izin sebelum memotret mereka.

### Tahura Mangrove Ngurah Rai

- **Slug:** `mangrove-pemogan`
- **Kategori:** Mangrove & Taman Nasional
- **Tarif:** Rp 30.000
- **Jam buka:** 06:00 – 18:30
- **Waktu terbaik:** Pagi atau sore hari (panas siang)
- **Koordinat:** -8.725, 115.1944
- **Pengelola:** Balai Pengelolaan Hutan Mangrove & Kelompok Tani Hutan Pemogan
- **Kontak:** 0361-1722991
- **Foto:** belum tersedia (fallback desain)

Hutan mangrove 1.300+ hektar di sisi jalan Bypass dengan jembatan kayu di atas laut.

**Cara masuk:** Kendaraan pribadi dari Denpasar via Bypass Ngurah Rai, sekitar 20 menit.

**Etika:** Jangan menginjak akar mangrove dan jangan memberi makan satwa liar. Tetap di jembatan — memberi makan atau menyentuh satwa dapat merusak ekosistem.

## Karangasem

Gunung, pura tua, dan pantai tenang di timur Bali.

Jumlah: **10 destinasi**.

### Bukit Asah Bugbug

- **Slug:** `bukit-asah-bugbug`
- **Kategori:** Bukit & Camping
- **Tarif:** Rp 10.000; camping tambahan
- **Jam buka:** 07:00 – 19:00
- **Waktu terbaik:** Sore untuk matahari terbenam atau pagi untuk camping
- **Koordinat:** -8.4547, 115.6019
- **Pengelola:** Desa Adat Bugbug
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Padang rumput di atas tebing yang menghadap Selat Lombok, populer untuk camping dan menikmati matahari terbit.

**Cara masuk:** Dari Amlapura sekitar 20 menit ke arah Bugbug.

**Etika:** Bawa turun semua sampah dan jangan menyalakan api di luar area yang disediakan. Hormati warga desa dan jangan merusak padang rumput.

### Desa Sidemen

- **Slug:** `sidemen-sawah`
- **Kategori:** Desa & Pertanian
- **Tarif:** Gratis
- **Jam buka:** 06:00 – 18:00
- **Waktu terbaik:** Maret – November
- **Koordinat:** -8.4819, 115.4419
- **Pengelola:** Kelompok Sadar Wisata Sidemen
- **Kontak:** 0817-8899-0011
- **Foto:** assets/images/sidemen.jpg

Lembah tenang di kaki Gunung Agung, dijuluki "Ubud dua puluh tahun silam".

**Cara masuk:** Dari Amlapura ke arah barat, sekitar 30 menit.

**Etika:** Tidak semua area boleh difoto. Tanyakan izin kepada pemilik rumah atau petani terlebih dahulu, terutama saat ritual sedang berlangsung.

### Desa Tenganan Pegringsingan

- **Slug:** `desa-tenganan`
- **Kategori:** Desa Adat
- **Tarif:** Donasi masuk desa
- **Jam buka:** 08:00 – 17:00
- **Waktu terbaik:** Pagi, hindari tengah hari
- **Koordinat:** -8.4522, 115.6078
- **Pengelola:** Bendesa Adat Tenganan
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Desa Bali Aga dengan tata ruang kuno dan kain gringsing tenun ikat ganda, salah satu warisan tekstil tertua di Bali.

**Cara masuk:** Dari Amlapura sekitar 15 menit ke arah Candidasa, belok di Tenganan.

**Etika:** Jangan memotret warga atau rumah tanpa izin. Beli tenun langsung dari perajin dan tawar dengan sopan; jangan menyentuh alat tenun tanpa dipersilakan.

### Pantai Amed

- **Slug:** `amed-pantai`
- **Kategori:** Pantai & Nelayan
- **Tarif:** Gratis (donasi sukarela)
- **Jam buka:** 06:00 – 18:00
- **Waktu terbaik:** April – November (musim kemarau)
- **Koordinat:** -8.3499, 115.6568
- **Pengelola:** Kelompok Sadar Wisata Amed
- **Kontak:** 0812-3456-7890
- **Foto:** assets/images/amed.jpg

Rangkaian desa nelayan berpasir hitam dengan terumbu karang yang paling sehat di Bali.

**Cara masuk:** Kendaraan pribadi dari Amlapura, sekitar 1 jam.

**Etika:** Jangan menyentuh atau berdiri di atas terumbu karang. Hormati nelayan lokal yang sedang bekerja dan minta izin sebelum memotret perahu atau warga.

### Pantai Bias Tugel

- **Slug:** `pantai-bias-tugel`
- **Kategori:** Pantai
- **Tarif:** Rp 10.000
- **Jam buka:** 07:00 – 18:00
- **Waktu terbaik:** Pagi sebelum ramai
- **Koordinat:** -8.4189, 115.5926
- **Pengelola:** Kelompok Pengelola Pantai Bias Tugel
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Pantai berpasir putih tersembunyi di balik tebing dekat Padang Bai, dengan air tenang dan cocok untuk berenang.

**Cara masuk:** Dari Padang Bai sekitar 10 menit, lalu turun lewat tangga.

**Etika:** Jalur tangga sempit — jangan berhenti berlama-lama di tengah jalur. Bawa kembali sampah Anda karena tempat sampah terbatas.

### Pantai Jemeluk

- **Slug:** `pantai-jemeluk`
- **Kategori:** Pantai & Snorkeling
- **Tarif:** Gratis; sewa alat snorkel ± Rp 50.000
- **Jam buka:** 06:00 – 18:00
- **Waktu terbaik:** April – Oktober (air paling jernih)
- **Koordinat:** -8.3369, 115.6637
- **Pengelola:** Kelompok Nelayan Jemeluk
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Teluk kecil berpasir hitam di Amed dengan terumbu karang dangkal yang bisa dijangkau langsung dari bibir pantai.

**Cara masuk:** Dari Amlapura sekitar 1 jam ke arah Amed, lalu ikuti petunjuk Jemeluk.

**Etika:** Jangan berdiri atau menyentuh terumbu karang, termasuk saat mengambil foto. Gunakan tabir surya ramah terumbu dan jangan memberi makan ikan.

### Pantai Tulamben

- **Slug:** `pantai-tulamben`
- **Kategori:** Pantai & Diving
- **Tarif:** Gratis; diving ± Rp 350.000 ke atas
- **Jam buka:** 06:00 – 18:00
- **Waktu terbaik:** April – Oktober; pagi untuk visibilitas terbaik
- **Koordinat:** -8.2745, 115.5932
- **Pengelola:** Kelompok Sadar Wisata Tulamben
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Pantai berbatu tempat bangkai kapal Liberty tahun 1942 menjadi salah satu spot diving paling terkenal di Bali.

**Cara masuk:** Dari Amlapura sekitar 45 menit ke utara via Kubu.

**Etika:** Jangan menyentuh bangkai kapal atau karang. Gunakan operator diving bersertifikat dan patuhi batas kedalaman serta waktu menyelam.

### Pura Agung Besakih

- **Slug:** `pura-agung-besakih`
- **Kategori:** Pura
- **Tarif:** Donasi; sewa kamen ± Rp 25.000
- **Jam buka:** 07:00 – 17:00
- **Waktu terbaik:** Pagi 06.00 – 09.00 sebelum bus rombongan
- **Koordinat:** -8.3739, 115.4504
- **Pengelola:** Bendesa Adat Besakih
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Pura induk Sad Kahyangan di lereng Gunung Agung, kompleks terbesar di Bali dengan puluhan pura pengiring.

**Cara masuk:** Dari Denpasar sekitar 2 jam via Rendang, atau 1 jam dari Amlapura.

**Etika:** Wajib memakai kamen dan sopan. Saat upacara, wisatawan tidak boleh masuk ke area dalam — ikuti arahan pemandu dan jangan memotret pemuja dari dekat.

### Pura Lempuyang

- **Slug:** `pura-lempuyang`
- **Kategori:** Pura
- **Tarif:** Donasi
- **Jam buka:** 06:00 – 18:00
- **Waktu terbaik:** Pukul 06.00 – 08.00, sebelum antrean foto memanjang
- **Koordinat:** -8.3917, 115.6311
- **Pengelola:** Bendesa Adat Desa Lempuyang / Pengelola Pura Penataran Agung
- **Kontak:** -
- **Foto:** assets/images/lempuyang.jpg

Pura Sad Kahyangan berusia ribuan tahun dengan candi bentar yang membingkai Gunung Agung.

**Cara masuk:** Kendaraan pribadi dari Denpasar, sekitar 2 jam.

**Etika:** Wajib memakai kain saput dan syal. Jangan memotret pemuja yang sedang beribadah dan jangan duduk di atas dinding pura.

### Taman Tirta Gangga

- **Slug:** `tirta-gangga`
- **Kategori:** Taman Air Kerajaan
- **Tarif:** Rp 50.000 (dewasa)
- **Jam buka:** 07:00 – 18:00
- **Waktu terbaik:** Pukul 07.00 – 09.00, sebelum rombongan tiba
- **Koordinat:** -8.4116, 115.5873
- **Pengelola:** Pengelola Unit Usaha Desa Ababi
- **Kontak:** 0813-2233-4455
- **Foto:** assets/images/tirta-gangga.jpg

Taman air kerajaan 1948 dengan kolam koi, patung dewa, dan batu pijakan di atas air.

**Cara masuk:** Kendaraan pribadi, area parkir tersedia.

**Etika:** Gunakan kain saput saat memasuki area suci dan pemandian. Jangan merokok di sekitar kolam suci dan jangan berdiri di atas patung.

## Klungkung

Pusat kerajaan klasik, seni, dan gerbang menuju Nusa Penida.

Jumlah: **10 destinasi**.

### Angel's Billabong

- **Slug:** `angels-billabong`
- **Kategori:** Kolam Alami
- **Tarif:** Rp 10.000
- **Jam buka:** 07:00 – 18:00
- **Waktu terbaik:** Pagi saat air tenang
- **Koordinat:** -8.742, 115.47
- **Pengelola:** Kelompok Sadar Wisata Bungamekar
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Kolam alami di celah karang dengan air sebening kristal, terhubung ke laut saat pasang.

**Cara masuk:** Dekat Broken Beach, sekitar 40 menit dari Toya Pakeh.

**Etika:** Jangan berenang saat gelombang tinggi — kolam bisa tersapu arus. Ikuti arahan petugas dan jangan berdiri di bibir karang.

### Broken Beach (Pasih Uug)

- **Slug:** `broken-beach`
- **Kategori:** Pantai & Tebing
- **Tarif:** Rp 10.000
- **Jam buka:** 07:00 – 18:00
- **Waktu terbaik:** Pagi sampai sore
- **Koordinat:** -8.741, 115.463
- **Pengelola:** Kelompok Sadar Wisata Bungamekar
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Laguna melingkar yang terbentuk dari runtuhan tebing, membentuk kolam alami dengan lengkungan batu.

**Cara masuk:** Dari Toya Pakeh sekitar 40 menit, dekat Angel's Billabong.

**Etika:** Jangan berenang di laguna — arus kuat dan tidak ada pengawas. Jangan melewati pagar pembatas tebing.

### Crystal Bay

- **Slug:** `crystal-bay`
- **Kategori:** Pantai & Snorkeling
- **Tarif:** Rp 10.000
- **Jam buka:** 07:00 – 18:00
- **Waktu terbaik:** Pagi sampai siang
- **Koordinat:** -8.716, 115.456
- **Pengelola:** Desa Adat Sakti
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Teluk berpasir putih di barat Nusa Penida dengan terumbu karang dan spot snorkeling yang tenang.

**Cara masuk:** Dari Toya Pakeh sekitar 20 menit.

**Etika:** Jangan menyentuh karang atau memberi makan ikan. Gunakan tabir surya ramah terumbu dan jangan berlabuh di area snorkeling.

### Kertha Gosa & Puri Semarapura

- **Slug:** `kertha-gosa`
- **Kategori:** Sejarah & Budaya
- **Tarif:** Rp 25.000
- **Jam buka:** 08:00 – 17:00
- **Waktu terbaik:** Pagi
- **Koordinat:** -8.5353, 115.4042
- **Pengelola:** Dinas Kebudayaan Klungkung
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Bale kerajaan abad ke-18 dengan lukisan langit-langit bergaya Kamasan dan museum sejarah Klungkung.

**Cara masuk:** Berada di pusat Kota Semarapura, Klungkung.

**Etika:** Jangan menyentuh lukisan langit-langit atau dinding bale. Jaga ketenangan dan minta izin sebelum memotret pemandu.

### Mushroom Bay

- **Slug:** `mushroom-bay`
- **Kategori:** Pantai & Snorkeling
- **Tarif:** Gratis
- **Jam buka:** 06:00 – 18:00
- **Waktu terbaik:** Pagi sampai sore
- **Koordinat:** -8.7, 115.4333
- **Pengelola:** Kelompok Sadar Wisata Lembongan
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Teluk berpasir putih di Nusa Lembongan dengan air tenang, cocok untuk berenang dan snorkeling pemula.

**Cara masuk:** Dari Jungutbatu sekitar 10 menit dengan kendaraan.

**Etika:** Hormati kapal nelayan dan jangan berlabuh di area snorkeling. Jangan menyentuh karang atau memberi makan ikan.

### Pantai Atuh

- **Slug:** `pantai-atuh`
- **Kategori:** Pantai
- **Tarif:** Rp 10.000
- **Jam buka:** 07:00 – 18:00
- **Waktu terbaik:** Pagi
- **Koordinat:** -8.7667, 115.5167
- **Pengelola:** Desa Adat Pejukutan
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Pantai tersembunyi di balik tebing dengan batu karang besar, terasa jauh dari keramaian Nusa Penida.

**Cara masuk:** Dari Toya Pakeh sekitar 45 menit ke timur.

**Etika:** Fasilitas terbatas — bawa air dan bawa turun sampah. Jangan memanjat karang dan berhati-hati saat pasang.

### Pantai Diamond

- **Slug:** `pantai-diamond`
- **Kategori:** Pantai
- **Tarif:** Rp 10.000
- **Jam buka:** 07:00 – 18:00
- **Waktu terbaik:** Pagi
- **Koordinat:** -8.724, 115.449
- **Pengelola:** Desa Adat Pejukutan
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Pantai berpasir putih dengan batu karang berlubang dan air biru jernih di timur Nusa Penida.

**Cara masuk:** Dari Pelabuhan Toya Pakeh sekitar 30 menit.

**Etika:** Tangga dan tebing licin — jangan memanjat batu berlubang. Jangan meninggalkan sampah karena fasilitas terbatas.

### Pantai Kelingking

- **Slug:** `pantai-kelingking`
- **Kategori:** Pantai & Tebing
- **Tarif:** Rp 10.000
- **Jam buka:** 07:00 – 18:00
- **Waktu terbaik:** Pagi sebelum panas; hindari musim hujan
- **Koordinat:** -8.751, 115.472
- **Pengelola:** Kelompok Sadar Wisata Bungamekar
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Tebing berbentuk kepala T-Rex yang ikonik di Nusa Penida, dengan pantai tersembunyi di bawahnya.

**Cara masuk:** Fast boat dari Sanur ke Nusa Penida, lalu sekitar 45 menit berkendara.

**Etika:** Jalur turun ke pantai sangat curam — jangan turun tanpa alas kaki layak dan jangan berdiri di tepi tebing untuk berfoto.

### Pura Goa Giri Putri

- **Slug:** `pura-goa-giri-putri`
- **Kategori:** Pura & Gua
- **Tarif:** Donasi
- **Jam buka:** 07:00 – 17:00
- **Waktu terbaik:** Pagi
- **Koordinat:** -8.7028, 115.4639
- **Pengelola:** Bendesa Adat Suana
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Pura di dalam gua karang di Nusa Penida, dianggap sebagai tempat pembersihan diri dan pengobatan tradisional.

**Cara masuk:** Dari Toya Pakeh sekitar 15 menit, lalu naik tangga ke mulut gua.

**Etika:** Wajib kamen dan berpakaian sopan. Sebagian area khusus untuk berdoa — jangan memotret pemuja atau membuat suara keras.

### Pura Goa Lawah

- **Slug:** `pura-goa-lawah`
- **Kategori:** Pura & Gua
- **Tarif:** Donasi
- **Jam buka:** 07:00 – 17:00
- **Waktu terbaik:** Pagi
- **Koordinat:** -8.5333, 115.4667
- **Pengelola:** Bendesa Adat Pesinggahan
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Pura di mulut gua yang menjadi rumah ribuan kelelawar, salah satu pura penting di jalur timur Bali.

**Cara masuk:** Dari Semarapura sekitar 15 menit ke arah timur.

**Etika:** Jangan mendekati atau mengganggu kelelawar. Wajib kamen, jaga ketenangan, dan jangan memotret area suci tanpa izin.

## Tabanan

Teras sawah UNESCO, sistem subak, dan pura di lereng gunung.

Jumlah: **10 destinasi**.

### Air Terjun Nungnung

- **Slug:** `air-terjun-nungnung`
- **Kategori:** Air Terjun
- **Tarif:** Rp 20.000
- **Jam buka:** 08:00 – 17:00
- **Waktu terbaik:** Pagi
- **Koordinat:** -8.3167, 115.1667
- **Pengelola:** Kelompok Pengelola Nungnung
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Air terjun tinggi di lembah hijau dengan sekitar 500 anak tangga, salah satu yang paling dramatis di Tabanan.

**Cara masuk:** Dari Denpasar sekitar 1,5 jam via Plaga.

**Etika:** Tangga curam dan licin — gunakan alas kaki yang aman. Jangan berenang saat debit air tinggi atau hujan deras.

### Kebun Raya Bali

- **Slug:** `kebun-raya-bali`
- **Kategori:** Taman & Edukasi
- **Tarif:** Rp 20.000
- **Jam buka:** 08:00 – 18:00
- **Waktu terbaik:** Pagi
- **Koordinat:** -8.2833, 115.1667
- **Pengelola:** UPT Kebun Raya Bali
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Kebun botani di Bedugul dengan koleksi anggrek, tanaman obat, dan hutan pinus yang sejuk.

**Cara masuk:** Dari Denpasar sekitar 2 jam via Bedugul.

**Etika:** Jangan memetik atau merusak tanaman. Tetap di jalur dan jangan memberi makan satwa liar.

### Museum Subak

- **Slug:** `museum-subak`
- **Kategori:** Museum & Budaya
- **Tarif:** Rp 10.000
- **Jam buka:** 08:00 – 16:00
- **Waktu terbaik:** Pagi
- **Koordinat:** -8.5419, 115.123
- **Pengelola:** Dinas Kebudayaan Tabanan
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Museum yang menjelaskan sistem irigasi subak, filosofi Tri Hita Karana, dan sejarah pertanian Bali.

**Cara masuk:** Dari Denpasar sekitar 45 menit ke arah Tabanan kota.

**Etika:** Jangan menyentuh koleksi. Minta izin sebelum memotret dan jaga ketenangan ruang pamer.

### Pantai Balian

- **Slug:** `pantai-balian`
- **Kategori:** Pantai & Surf
- **Tarif:** Gratis; parkir ± Rp 5.000
- **Jam buka:** 06:00 – 19:00
- **Waktu terbaik:** April – Oktober
- **Koordinat:** -8.5333, 114.9667
- **Pengelola:** Kelompok Surfing Balian
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Pantai di muara sungai dengan ombak kelas dunia, dikelilingi sawah dan perkebunan kelapa.

**Cara masuk:** Dari Denpasar sekitar 1,5 jam ke arah barat.

**Etika:** Ombak untuk peselancar berpengalaman — jangan berenang di area arus balik. Hormati peselancar lokal dan antrean di lineup.

### Pantai Kedungu

- **Slug:** `pantai-kedungu`
- **Kategori:** Pantai & Surf
- **Tarif:** Gratis
- **Jam buka:** 06:00 – 19:00
- **Waktu terbaik:** Sore
- **Koordinat:** -8.6333, 115.1
- **Pengelola:** Kelompok Sadar Wisata Kedungu
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Pantai berpasir gelap dengan ombak konsisten, sering dipakai peselancar lokal dan cocok untuk menikmati sore.

**Cara masuk:** Dari Denpasar sekitar 45 menit via Kediri.

**Etika:** Arus bisa kuat — berenang hanya di area yang diawasi. Jangan memarkir kendaraan di pematang sawah warga.

### Pantai Pasut

- **Slug:** `pantai-pasut`
- **Kategori:** Pantai
- **Tarif:** Gratis
- **Jam buka:** 06:00 – 19:00
- **Waktu terbaik:** Sore
- **Koordinat:** -8.626, 115.096
- **Pengelola:** Desa Adat Tibubiu
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Pantai panjang berpasir hitam dengan muara sungai dan suasana tenang, jauh dari keramaian Kuta.

**Cara masuk:** Dari Denpasar sekitar 1 jam via Kediri.

**Etika:** Beberapa bagian pantai dianggap sakral — jangan berenang di dekat pura atau area persembahan. Jaga kebersihan.

### Pura Luhur Batukaru

- **Slug:** `pura-batukaru`
- **Kategori:** Pura
- **Tarif:** Donasi
- **Jam buka:** 07:00 – 17:00
- **Waktu terbaik:** Pagi hari (kabut tipis, suasana hening)
- **Koordinat:** -8.3719, 115.1014
- **Pengelola:** Bendesa Adat Pura Luhur Batukaru
- **Kontak:** -
- **Foto:** assets/images/batukaru.jpg

Pura Sad Kahyangan yang tersembunyi di hutan berkabut lereng Gunung Batukaru.

**Cara masuk:** Kendaraan pribadi, area parkir tersedia di bawah.

**Etika:** Wajib kain saput dan syal. Jangan berbicara keras di area suci dan jangan memasuki area dalam pura tanpa didampingi.

### Pura Tanah Lot

- **Slug:** `pura-tanah-lot`
- **Kategori:** Pura & Pantai
- **Tarif:** Rp 60.000
- **Jam buka:** 07:00 – 19:00
- **Waktu terbaik:** Sore menjelang matahari terbenam
- **Koordinat:** -8.6212, 115.0868
- **Pengelola:** Bendesa Adat Beraban
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Pura di atas batu karang lepas pantai yang menjadi salah satu pemandangan matahari terbenam paling dikenal di Bali.

**Cara masuk:** Dari Denpasar sekitar 45 menit via Kediri.

**Etika:** Jangan memanjat batu pura atau masuk ke area upacara. Saat air pasang, jangan memaksa menyeberang ke batu pura.

### Pura Ulun Danu Beratan

- **Slug:** `pura-ulun-danu-beratan`
- **Kategori:** Pura & Danau
- **Tarif:** Rp 75.000
- **Jam buka:** 07:00 – 19:00
- **Waktu terbaik:** Pagi 07.00 – 09.00
- **Koordinat:** -8.275, 115.1667
- **Pengelola:** Bendesa Adat Candikuning
- **Kontak:** -
- **Foto:** belum tersedia (fallback desain)

Pura di tepi Danau Beratan yang ikonik dengan meru bertingkat, dikelilingi kabut dataran tinggi Bedugul.

**Cara masuk:** Dari Denpasar sekitar 2 jam via Bedugul.

**Etika:** Wajib kamen. Area pura dalam ditutup untuk wisatawan saat upacara — jangan memaksa masuk atau memotret prosesi.

### Teras Sawah Jatiluwih

- **Slug:** `jatiluwih-sawah`
- **Kategori:** Sawah & Subak
- **Tarif:** Rp 40.000
- **Jam buka:** 06:00 – 18:00
- **Waktu terbaik:** Juni – Agustus (padi hijau merata)
- **Koordinat:** -8.3698, 115.1311
- **Pengelola:** Subak Jatiluwih & Desa Adat
- **Kontak:** 0816-7788-9900
- **Foto:** assets/images/jatiluwih.jpg

600 hektar sawah subak Warisan Dunia UNESCO di kaki Gunung Batukaru.

**Cara masuk:** Kendaraan pribadi dari Denpasar, sekitar 1,5 jam.

**Etika:** Jangan menginjak area tanaman padi dan jalur sawah yang sedang dibajak. Hormati petani yang sedang bekerja, minta izin sebelum memotret dekat.

