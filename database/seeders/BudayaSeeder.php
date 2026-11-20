<?php

namespace Database\Seeders;

use App\Models\Budaya;
use Illuminate\Database\Seeder;

class BudayaSeeder extends Seeder
{
    /**
     * Data asli dari database SARI (live per 14 Nov 2026).
     * Idempoten: aman dijalankan berkali-kali.
     */
    public function run(): void
    {
        $rows = [
            ['slug' => 'busana-pura', 'judul' => 'Busana Masuk Pura', 'ringkas' => 'Kain saput dan syal untuk wanita, kain panjang untuk pria.', 'detail' => 'Kain saput dipakai di pinggang dan syal menutup bahu. Hindari celana pendek dan rok mini di area suci. Jika tidak membawa, biasanya dapat dipinjam di pintu masuk pura.'],
            ['slug' => 'canang-sari', 'judul' => 'Canang Sari', 'ringkas' => 'Persembahan kecil dari janur dan bunga di jalanan dan depan rumah.', 'detail' => 'Jangan menginjak canang yang tersebar di jalanan. Jika ingin memotret, minta izin terlebih dahulu kepada pemilik rumah atau penjaga area.'],
            ['slug' => 'nyepi', 'judul' => 'Hari Nyepi', 'ringkas' => 'Hari suci Tahun Baru Saka, seluruh aktivitas dihentikan 24 jam.', 'detail' => 'Selama Catur Brata Penyepian: api mati, lampu redup, tidak keluar rumah, tidak bekerja, dan tidak bersuka ria. Wisatawan di hotel juga diharapkan mematuhi.'],
            ['slug' => 'basa-bali', 'judul' => 'Frasa Bahasa Bali Dasar', 'ringkas' => 'Kata sederhana untuk menunjukkan hormat kepada warga lokal.', 'detail' => 'Om Swastiastu (salam hormat), Matur Suksma (terima kasih), Bli (sapaan laki-laki), Mbok (sapaan perempuan).'],
            ['slug' => 'adat-laut', 'judul' => 'Adat Laut & Nelayan', 'ringkas' => 'Hormati laut dan kehidupan nelayan di pesisir Bali.', 'detail' => 'Jangan membuang sampah ke laut dan jangan menyentuh terumbu karang saat berenang. Jika akan naik perahu, ikuti arahan nelayan lokal.'],
            ['slug' => 'pantang-larang-desa', 'judul' => 'Pantang Larang Desa', 'ringkas' => 'Beberapa area desa memiliki larangan khusus pada waktu tertentu.', 'detail' => 'Perhatikan papan pengumuman di pintu desa. Jika ada area yang dilarang untuk difoto, hargai dan jangan memaksa mengambil gambar.'],
        ];

        foreach ($rows as $row) {
            Budaya::updateOrCreate(['slug' => $row['slug']], $row);
        }
    }
}
