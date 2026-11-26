<?php

use App\Models\Wilayah;

/**
 * Menghasilkan docs/destinasi.md dari data destinasi di database.
 *
 * Jalankan:
 *   php scripts/generate-destinasi-docs.php
 */

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$wilayah = Wilayah::with(['destinasi' => fn ($q) => $q->orderBy('nama')])
    ->orderBy('nama')
    ->get();

$total = $wilayah->sum(fn ($w) => $w->destinasi->count());

$lines = [];
$lines[] = '# Dokumentasi Destinasi SARI';
$lines[] = '';
$lines[] = 'Dokumen ini di-generate otomatis dari database melalui `scripts/generate-destinasi-docs.php`.';
$lines[] = 'Jangan mengedit tabel di bawah secara manual — ubah data lewat seeder/panel admin lalu generate ulang.';
$lines[] = '';
$lines[] = '- **Tanggal generate:** ' . now()->locale('id')->translatedFormat('j F Y');
$lines[] = '- **Total destinasi:** ' . $total;
$lines[] = '- **Wilayah:** ' . $wilayah->count() . ' (Karangasem, Buleleng, Tabanan, Klungkung, Bangli, Gianyar)';
$lines[] = '- **Target minimum:** 10 destinasi per wilayah';
$lines[] = '';
$lines[] = '> Catatan: tarif, jam buka, dan kontak adalah perkiraan dari informasi publik dan dapat berubah.';
$lines[] = '> Koordinat bersifat perkiraan untuk keperluan peta, bukan titik pintu masuk resmi.';
$lines[] = '> Destinasi tanpa foto akan memakai fallback desain SARI (`.ph-fallback`).';
$lines[] = '';
$lines[] = '## Ringkasan per Wilayah';
$lines[] = '';
$lines[] = '| Wilayah | Jumlah | Status |';
$lines[] = '|---|---:|---|';
foreach ($wilayah as $w) {
    $jumlah = $w->destinasi->count();
    $status = $jumlah >= 10 ? 'Memenuhi' : 'Kurang ' . (10 - $jumlah);
    $lines[] = '| ' . $w->nama . ' | ' . $jumlah . ' | ' . $status . ' |';
}
$lines[] = '';
$lines[] = '## Cara Menambah / Memperbarui Data';
$lines[] = '';
$lines[] = '1. Tambahkan entri baru di `database/seeders/DestinasiSeeder.php` atau `database/seeders/DestinasiTambahanSeeder.php`.';
$lines[] = '2. Gunakan `slug` yang unik, isi `wilayah` sesuai slug wilayah, dan koordinat desimal.';
$lines[] = '3. Jalankan `php artisan db:seed --class=DestinasiTambahanSeeder --force` (idempoten, aman diulang).';
$lines[] = '4. Generate ulang dokumen: `php scripts/generate-destinasi-docs.php`.';
$lines[] = '5. Untuk foto, simpan berkas di `public/assets/images/` lalu isi kolom `gambar` dengan `assets/images/namafile.jpg`.';
$lines[] = '';

foreach ($wilayah as $w) {
    $lines[] = '## ' . $w->nama;
    $lines[] = '';
    $lines[] = $w->deskripsi ?: '';
    $lines[] = '';
    $lines[] = 'Jumlah: **' . $w->destinasi->count() . ' destinasi**.';
    $lines[] = '';

    foreach ($w->destinasi as $d) {
        $lines[] = '### ' . $d->nama;
        $lines[] = '';
        $lines[] = '- **Slug:** `' . $d->slug . '`';
        $lines[] = '- **Kategori:** ' . ($d->kategori ?: '-');
        $lines[] = '- **Tarif:** ' . ($d->tarif ?: '-');
        $lines[] = '- **Jam buka:** ' . ($d->jam_buka ?: '-');
        $lines[] = '- **Waktu terbaik:** ' . ($d->waktu_terbaik ?: '-');
        $lines[] = '- **Koordinat:** ' . $d->latitude . ', ' . $d->longitude;
        $lines[] = '- **Pengelola:** ' . ($d->pengelola_nama ?: '-');
        $lines[] = '- **Kontak:** ' . ($d->kontak ?: '-');
        $lines[] = '- **Foto:** ' . ($d->gambar ?: 'belum tersedia (fallback desain)');
        $lines[] = '';
        $lines[] = $d->deskripsi;
        $lines[] = '';
        $lines[] = '**Cara masuk:** ' . $d->cara_masuk;
        $lines[] = '';
        $lines[] = '**Etika:** ' . $d->etika;
        $lines[] = '';
    }
}

$output = __DIR__ . '/../docs/destinasi.md';

if (! is_dir(dirname($output))) {
    mkdir(dirname($output), 0775, true);
}

file_put_contents($output, implode(PHP_EOL, $lines) . PHP_EOL);

echo "Dokumentasi ditulis ke docs/destinasi.md ({$total} destinasi, {$wilayah->count()} wilayah)." . PHP_EOL;
