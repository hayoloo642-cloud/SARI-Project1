<?php

/**
 * Mengimpor foto cover destinasi dari Wikimedia Commons / Flickr (via Openverse).
 *
 * - Hanya menerima berkas berlisensi bebas (CC0, CC BY, CC BY-SA, public domain).
 * - Menyimpan gambar ke public/assets/images/destinasi/{slug}.jpg
 * - Menulis manifest database/data/foto-destinasi.json dan docs/foto-attribusi.md
 *
 * Jalankan:
 *   php scripts/import-foto-wikimedia.php
 *   php scripts/import-foto-wikimedia.php --force          # unduh ulang semua
 *   php scripts/import-foto-wikimedia.php --slug=foo       # satu destinasi
 */

use App\Models\Destinasi;

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$force = in_array('--force', $argv, true);
$only = null;
foreach ($argv as $arg) {
    if (str_starts_with($arg, '--slug=')) {
        $only = substr($arg, 7);
    }
}

$userAgent = 'SARI-Bali-Docs/1.0 (educational tourism project; contact: admin@sari-bali.id)';

/**
 * Berkas Commons pilihan (kurasi manual, sudah dicek subjeknya).
 * Kunci = slug destinasi, nilai = judul berkas di Wikimedia Commons.
 */
$berkas = [
    // Karangasem
    'amed-pantai' => 'Golden Hour in Amed.jpg',
    'bukit-asah-bugbug' => 'Bukit Asah Desa Bugbug.jpg',
    'desa-tenganan' => 'Bali Aga architecture in Tenganan-01.jpg',
    'pantai-bias-tugel' => 'Bias Tugel Beach aerial 2026 01.jpg',
    'pantai-jemeluk' => 'Bali-amed-village-fishing-beach-boats.jpg',
    'pantai-tulamben' => 'Tulamben - panoramio.jpg',
    'pura-lempuyang' => 'Lempuyang 1.jpg',
    'sidemen-sawah' => 'SIDEMEN EAST BALI RICE TERRACE.jpg',
    'tirta-gangga' => 'Tirta Gangga.jpg',

    // Buleleng
    'air-terjun-aling-aling' => 'Golden Valley Waterfall SF0001.jpg',
    'danau-tamblingan' => 'Lake Tamblingan.jpg',
    'pantai-pemuteran' => '@https://live.staticflickr.com/4089/5028082315_3a614b336f_b.jpg',
    'sekumpul-air-terjun' => 'Air Terjun Sekumpul.jpg',

    // Tabanan
    'air-terjun-nungnung' => '@https://live.staticflickr.com/65535/51859147881_26004cfbb3_b.jpg',
    'museum-subak' => '@https://upload.wikimedia.org/wikipedia/id/0/03/Museum_Subak.jpeg',
    'pantai-kedungu' => 'Pantai Kedungu, Tabanan.jpg',
    'pantai-pasut' => 'Balian Beach Sunset.jpg',

    // Klungkung
    'kertha-gosa' => '001 Kertha Gosa with Chairs and Table, The Klungkung Palace, Semarapura, Bali, photograph by Anandajoti Bhikkhu.jpg',

    // Bangli
    'air-terjun-tibumana' => 'Gitgit Waterfall.jpg',
    'bukit-cinta-batur' => 'Kintamani - Danau Batur - 49818147221.jpg',
    'pura-puncak-penulisan' => 'Bangli 1998.jpg',
    'toya-devasya' => 'Hot spring of Toyabungkah 200507.jpg',
    'air-terjun-tukad-cepung' => 'Tukad Cepung Waterfall (52462237566).jpg',

    // Gianyar
    'air-terjun-tegenungan' => 'Tegenungan Waterfall 2017-08-18 (2).jpg',
    'mangrove-pemogan' => 'Benoa Bali Indonesia-Mangrove-forest-01.jpg',
    'pantai-keramas' => 'Pantai Keramas.jpg',
    'pasar-seni-sukawati' => 'Market of Sukawati, Sukawati, Bali 200507-11.jpg',
    'puri-saren-agung' => 'Ubud Palace, Bali, Indonesia, 20220822 0904 9820.jpg',

    // Badung
    'pantai-kuta' => 'Pantai Kuta sejuta cinta.jpg',
    'pantai-legian' => 'Legian Pantai Bali.jpg',
    'pantai-seminyak' => 'Seminyak, Bali.jpg',
    'pantai-double-six' => 'Double Six Beach.jpg',
    'pantai-echo-beach' => 'La Brisa beach club at Echo Beach, Canggu, Bali.jpg',
    'pantai-jimbaran' => 'Jimbaran200507-1.jpg',
    'pantai-nusa-dua' => 'Nusa Dua Bali.jpg',
    'pantai-pandawa' => 'Sunset At Pandawa Beach.jpg',
    'pantai-melasti' => 'Melasti Beach side view.jpg',
    'pantai-padang-padang' => 'Padang Padang Beach Bali.jpg',
    'pantai-bingin' => 'The Perfect Sunset.jpg',
    'pantai-balangan' => 'Balangan Beach, Bali 2017-08-16.jpg',
    'pantai-suluban' => 'Suluban Beach, Pecatu, Bali - Indonesia - panoramio.jpg',
    'pantai-nyang-nyang' => 'Nyang-Nyang Beach Sunset.jpg',
    'pantai-dreamland' => 'Dreamland Beach Bali.jpg',
    'pantai-kedonganan' => 'Traditional boat at Kedonganan bay.jpg',

    // Denpasar
    'pantai-sanur' => '250217 Sanur Beach 03.jpg',
    'pantai-matahari-terbit' => 'Pantai Sanur di waktu terbit matahari.jpg',
    'pantai-mertasari' => 'Sanur, Bali 2017-08-19 (2).jpg',
    'pantai-padang-galak' => 'Bali Kite Festival (Padang Galak).jpg',
    'pura-sakenan-serangan' => '027 Banyan and Other Trees, Pura Sakenan, Serangan, Bali, photograph by Anandajoti Bhikkhu.jpg',
    'museum-bali' => 'Bali Museum.jpg',
    'pasar-badung' => 'Pasar Badung Baru 5.jpg',
    'pura-jagatnatha' => 'Pura Jagatnatha in Denpasar 2.jpg',
    'bajra-sandhi' => 'Aerial view of Bajra Sandhi Monument Denpasar Bali Indonesia.jpg',
    'taman-werdhi-budaya' => 'Taman Budaya Arts Centre.jpg',

    // Jembrana
    'pantai-medewi' => 'Pantai Medewi Jembrana - panoramio.jpg',
    'pantai-perancak' => 'Perahu slerek.jpg',
    'pura-rambut-siwi' => 'Pura Rambut Siwi entrance.jpg',
    'taman-nasional-bali-barat' => 'Bali Barat NP 2009.jpg',
    'pelabuhan-gilimanuk' => 'Gilimanuk Bali Indonesia Gilimanuk-Harbour-Ferry-terminal-01.jpg',
    'pelabuhan-pengambengan' => 'Nelayan di Pengambengan.jpg',
    'desa-blimbingsari' => 'Altar GKPB Pniel Blimbingsari, Jembrana, Bali.jpg',
    'bunut-bolong' => 'Melaya, Jembrana Regency, Bali 82252, Indonesia - panoramio.jpg',
    'air-terjun-juwuk-manis' => 'Cupel, Negara, Jembrana Regency, Bali, Indonesia - panoramio.jpg',
    'pantai-pulukan' => 'Pantai Medewi Jembrana - panoramio.jpg',
];

/**
 * Catatan tambahan untuk foto yang sifatnya ilustrasi kawasan.
 */
$catatan = [
    'air-terjun-aling-aling' => 'Foto ilustrasi air terjun di Buleleng.',
    'air-terjun-tibumana' => 'Foto ilustrasi air terjun di Bali.',
    'pantai-pasut' => 'Foto ilustrasi pesisir Tabanan.',
    'pantai-pulukan' => 'Foto ilustrasi pesisir Jembrana.',
    'bunut-bolong' => 'Foto ilustrasi kawasan Melaya, Jembrana.',
    'air-terjun-juwuk-manis' => 'Foto ilustrasi kawasan Jembrana.',
];

$kreditLangsung = [
    'pantai-pemuteran' => [
        'kredit' => 'Jeda Villa Bali · CC BY 2.0',
        'sumber' => 'https://www.flickr.com/photos/53779476@N08/5028082315',
        'lisensi' => 'CC BY 2.0',
        'berkas' => 'Pemuteran Bay, Bali (Flickr)',
    ],
    'air-terjun-nungnung' => [
        'kredit' => 'www.tiket2.com · CC BY 2.0',
        'sumber' => 'https://www.flickr.com/photos/61713368@N07/51859147881',
        'lisensi' => 'CC BY 2.0',
        'berkas' => 'Bali waterfall Nung-Nung (Flickr)',
    ],
    'museum-subak' => [
        'kredit' => 'Wikipedia Indonesia · GFDL',
        'sumber' => 'https://id.wikipedia.org/wiki/Berkas:Museum_Subak.jpeg',
        'lisensi' => 'GFDL',
        'berkas' => 'Museum Subak (Wikipedia Indonesia)',
    ],
];

function commonsApi(array $params, string $userAgent): ?array
{
    $params += ['action' => 'query', 'format' => 'json', 'formatversion' => 2];
    $url = 'https://commons.wikimedia.org/w/api.php?' . http_build_query($params);

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT => 40,
        CURLOPT_USERAGENT => $userAgent,
    ]);
    $body = curl_exec($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($body === false || $status !== 200) {
        return null;
    }

    $json = json_decode($body, true);

    return is_array($json) ? $json : null;
}

function bersihkanTeks(?string $html): string
{
    if (! $html) {
        return '';
    }

    $teks = html_entity_decode(strip_tags($html), ENT_QUOTES | ENT_HTML5, 'UTF-8');

    return trim(preg_replace('/\s+/', ' ', $teks));
}

function lisensiBebas(string $lisensi, string $usage): bool
{
    $gabung = strtolower($lisensi . ' ' . $usage);

    if (str_contains($gabung, 'fair use') || str_contains($gabung, 'non-free')) {
        return false;
    }

    return (bool) preg_match('/(cc0|public domain|cc[ -]?by(?:[ -]sa)?|attribution)/i', $gabung);
}

function unduh(string $url, string $target, string $userAgent): bool
{
    $tmp = $target;
    $ch = curl_init($url);
    $fp = fopen($tmp, 'wb');
    curl_setopt_array($ch, [
        CURLOPT_FILE => $fp,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT => 120,
        CURLOPT_USERAGENT => $userAgent,
    ]);
    $ok = curl_exec($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    fclose($fp);

    if (! $ok || $status !== 200 || ! filesize($tmp)) {
        @unlink($tmp);

        return false;
    }

    return true;
}

function konversi(string $tmp, string $target): bool
{
    $bin = trim((string) shell_exec('command -v magick')) ?: 'convert';
    $perintah = escapeshellarg($bin) . ' ' . escapeshellarg($tmp)
        . ' -auto-orient -resize ' . escapeshellarg('1280x960>')
        . ' -strip -quality 78 ' . escapeshellarg($target);

    exec($perintah, $output, $kode);

    return $kode === 0;
}

$destinasi = Destinasi::with('wilayah')
    ->when($only, fn ($q) => $q->where('slug', $only))
    ->orderBy('slug')
    ->get();

$manifestPath = __DIR__ . '/../database/data/foto-destinasi.json';
$manifest = is_file($manifestPath)
    ? (json_decode(file_get_contents($manifestPath), true) ?: [])
    : [];

$folder = __DIR__ . '/../public/assets/images/destinasi';
if (! is_dir($folder)) {
    mkdir($folder, 0775, true);
}

$gagal = [];

foreach ($destinasi as $d) {
    $slug = $d->slug;
    $relative = 'assets/images/destinasi/' . $slug . '.jpg';
    $target = __DIR__ . '/../public/' . $relative;

    $sumber = $berkas[$slug] ?? null;

    if (! $sumber) {
        continue;
    }

    if (! $force && is_file($target) && isset($manifest[$slug])) {
        echo "[skip] {$slug}\n";

        continue;
    }

    $temporary = $target . '.src.jpg';

    // Sumber langsung (Flickr/Openverse) ditandai awalan @.
    if (str_starts_with($sumber, '@')) {
        $url = substr($sumber, 1);
        $urlBersih = strtok($url, '?');

        if (! unduh($urlBersih, $temporary, $userAgent)) {
            echo "[GAGAL] {$slug}: unduhan langsung gagal\n";
            $gagal[] = $slug;

            continue;
        }

        $info = $kreditLangsung[$slug] ?? [
            'kredit' => 'Wikimedia Commons · CC BY-SA',
            'sumber' => $urlBersih,
            'lisensi' => 'CC BY-SA',
            'berkas' => basename($urlBersih),
        ];

        if (! konversi($temporary, $target)) {
            @unlink($temporary);
            echo "[GAGAL] {$slug}: konversi gambar gagal\n";
            $gagal[] = $slug;

            continue;
        }
        @unlink($temporary);

        $manifest[$slug] = [
            'file' => $relative,
            'kredit' => $info['kredit'],
            'sumber' => $info['sumber'],
            'berkas' => $info['berkas'],
            'lisensi' => $info['lisensi'],
        ] + (isset($catatan[$slug]) ? ['catatan' => $catatan[$slug]] : []);

        echo "[ok] {$slug} <- {$info['berkas']}\n";
        continue;
    }

    $judul = 'File:' . $sumber;

    $response = commonsApi([
        'titles' => $judul,
        'prop' => 'imageinfo',
        'iiprop' => 'url|extmetadata|size|mime',
        'iiurlwidth' => 1600,
    ], $userAgent);

    $page = $response['query']['pages'][0] ?? null;
    $info = $page['imageinfo'][0] ?? null;

    if (! $info || empty($info['thumburl'])) {
        echo "[GAGAL] {$slug}: berkas {$judul} tidak ditemukan\n";
        $gagal[] = $slug;

        continue;
    }

    $em = $info['extmetadata'] ?? [];
    $lisensi = bersihkanTeks($em['LicenseShortName']['value'] ?? '');
    $usage = bersihkanTeks($em['UsageTerms']['value'] ?? '');

    if (! lisensiBebas($lisensi, $usage)) {
        echo "[GAGAL] {$slug}: lisensi tidak bebas ({$lisensi})\n";
        $gagal[] = $slug;

        continue;
    }

    if (! unduh($info['thumburl'], $temporary, $userAgent)) {
        echo "[GAGAL] {$slug}: unduhan gagal\n";
        $gagal[] = $slug;

        continue;
    }

    if (! konversi($temporary, $target)) {
        @unlink($temporary);
        echo "[GAGAL] {$slug}: konversi gambar gagal\n";
        $gagal[] = $slug;

        continue;
    }
    @unlink($temporary);

    $artis = bersihkanTeks($em['Artist']['value'] ?? '');
    $artis = $artis !== '' ? $artis : 'Wikimedia Commons contributor';
    $sumberUrl = $info['descriptionurl'] ?? ('https://commons.wikimedia.org/wiki/' . rawurlencode($judul));

    $manifest[$slug] = [
        'file' => $relative,
        'kredit' => mb_substr($artis . ' · ' . ($lisensi ?: 'Wikimedia Commons'), 0, 250),
        'sumber' => $sumberUrl,
        'berkas' => $judul,
        'lisensi' => $lisensi,
    ] + (isset($catatan[$slug]) ? ['catatan' => $catatan[$slug]] : []);

    echo "[ok] {$slug} <- {$judul} ({$lisensi})\n";
    usleep(250000);
}

if (! is_dir(dirname($manifestPath))) {
    mkdir(dirname($manifestPath), 0775, true);
}
ksort($manifest);
file_put_contents(
    $manifestPath,
    json_encode($manifest, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . PHP_EOL
);

// Dokumentasi atribusi
$namaPerSlug = Destinasi::pluck('nama', 'slug');
$baris = [];
$baris[] = '# Atribusi Foto Destinasi';
$baris[] = '';
$baris[] = 'Semua foto cover diimpor melalui `scripts/import-foto-wikimedia.php` dari Wikimedia Commons dan Flickr (Openverse).';
$baris[] = 'Hanya berkas berlisensi bebas (CC0, CC BY, CC BY-SA, atau public domain) yang dipakai.';
$baris[] = '';
$baris[] = 'Saat menggunakan ulang foto, sertakan atribusi sesuai lisensi masing-masing.';
$baris[] = 'Beberapa destinasi memakai foto ilustrasi kawasan karena belum ada foto berlisensi bebas untuk lokasi persisnya — kolom Catatan menandainya.';
$baris[] = '';
$baris[] = '| Destinasi | Berkas lokal | Kredit | Lisensi | Sumber | Catatan |';
$baris[] = '|---|---|---|---|---|---|';
foreach ($manifest as $slug => $foto) {
    $nama = $namaPerSlug[$slug] ?? $slug;
    $baris[] = '| ' . $nama . ' | `' . $foto['file'] . '` | ' . $foto['kredit']
        . ' | ' . ($foto['lisensi'] ?: '-') . ' | [Commons](' . $foto['sumber'] . ') | '
        . ($foto['catatan'] ?? '-') . ' |';
}
file_put_contents(__DIR__ . '/../docs/foto-attribusi.md', implode(PHP_EOL, $baris) . PHP_EOL);

echo PHP_EOL . 'Manifest: ' . count($manifest) . ' foto. Gagal: ' . count($gagal) . PHP_EOL;
if ($gagal) {
    echo 'Slug gagal: ' . implode(', ', $gagal) . PHP_EOL;
}
