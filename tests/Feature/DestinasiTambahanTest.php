<?php

namespace Tests\Feature;

use App\Models\Destinasi;
use App\Models\Wilayah;
use Database\Seeders\AdminSeeder;
use Database\Seeders\DestinasiBaliSeeder;
use Database\Seeders\DestinasiFotoSeeder;
use Database\Seeders\DestinasiSeeder;
use Database\Seeders\DestinasiTambahanSeeder;
use Database\Seeders\WilayahSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DestinasiTambahanTest extends TestCase
{
    use RefreshDatabase;

    private function seedDestinasi(): void
    {
        $this->seed([
            AdminSeeder::class,
            WilayahSeeder::class,
            DestinasiSeeder::class,
            DestinasiTambahanSeeder::class,
            DestinasiBaliSeeder::class,
            DestinasiFotoSeeder::class,
        ]);
    }

    public function test_setiap_wilayah_punya_minimal_sepuluh_destinasi(): void
    {
        $this->seedDestinasi();

        $jumlah = Wilayah::withCount('destinasi')->pluck('destinasi_count', 'slug');

        $wilayah9 = [
            'karangasem', 'buleleng', 'tabanan', 'klungkung',
            'bangli', 'gianyar', 'badung', 'denpasar', 'jembrana',
        ];

        foreach ($wilayah9 as $slug) {
            $this->assertGreaterThanOrEqual(
                10,
                (int) ($jumlah[$slug] ?? 0),
                "Wilayah {$slug} belum mencapai 10 destinasi."
            );
        }

        $this->assertSame(96, Destinasi::count());
    }

    public function test_slug_destinasi_tidak_duplikat(): void
    {
        $this->seedDestinasi();

        $this->assertSame(
            Destinasi::count(),
            Destinasi::distinct()->count('slug')
        );
    }

    public function test_data_destinasi_tambahan_lengkap(): void
    {
        $this->seedDestinasi();

        foreach (Destinasi::all() as $destinasi) {
            $this->assertNotEmpty($destinasi->nama);
            $this->assertNotEmpty($destinasi->deskripsi, "Deskripsi {$destinasi->slug} kosong.");
            $this->assertNotEmpty($destinasi->cara_masuk, "Cara masuk {$destinasi->slug} kosong.");
            $this->assertNotEmpty($destinasi->etika, "Etika {$destinasi->slug} kosong.");
            $this->assertNotEmpty($destinasi->jam_buka, "Jam buka {$destinasi->slug} kosong.");
            $this->assertNotEmpty($destinasi->tarif, "Tarif {$destinasi->slug} kosong.");
            $this->assertNotEmpty($destinasi->waktu_terbaik, "Waktu terbaik {$destinasi->slug} kosong.");
            $this->assertNotEmpty($destinasi->pengelola_nama, "Pengelola {$destinasi->slug} kosong.");

            $this->assertNotSame(0.0, (float) $destinasi->latitude, "Latitude {$destinasi->slug} kosong.");
            $this->assertNotSame(0.0, (float) $destinasi->longitude, "Longitude {$destinasi->slug} kosong.");
        }
    }

    public function test_semua_destinasi_punya_gambar_cover_dan_file_fisik_ada(): void
    {
        $this->seedDestinasi();

        foreach (Destinasi::all() as $destinasi) {
            $this->assertNotEmpty($destinasi->gambar, "Gambar cover {$destinasi->slug} kosong.");
            $path = public_path($destinasi->gambar);
            $this->assertFileExists($path, "File fisik gambar {$destinasi->slug} tidak ditemukan di {$path}.");
        }
    }

    public function test_seeder_idempoten_saat_dijalankan_dua_kali(): void
    {
        $this->seedDestinasi();
        $jumlahPertama = Destinasi::count();

        $this->seed(DestinasiTambahanSeeder::class);
        $this->seed(DestinasiBaliSeeder::class);
        $this->seed(DestinasiFotoSeeder::class);

        $this->assertSame($jumlahPertama, Destinasi::count());
    }
}
