<?php

namespace Tests\Feature;

use App\Models\Destinasi;
use App\Models\Ulasan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    private function seedDasar(): void
    {
        $this->seed([
            \Database\Seeders\WilayahSeeder::class,
            \Database\Seeders\AktivitasSeeder::class,
            \Database\Seeders\BudayaSeeder::class,
            \Database\Seeders\KalenderSeeder::class,
            \Database\Seeders\DestinasiSeeder::class,
        ]);
    }

    public function test_halaman_publik_utama_dapat_dibuka(): void
    {
        $this->seedDasar();

        $this->get('/')
            ->assertOk()
            ->assertSee('Temukan')
            ->assertSee('Pantai Amed');

        $this->get('/destinasi')
            ->assertOk()
            ->assertSee('Wisata Lokal')
            ->assertSee('Pantai Amed')
            ->assertSee('Peta Destinasi SARI');

        $this->get('/destinasi/amed-pantai')
            ->assertOk()
            ->assertSee('Pantai Amed')
            ->assertSee('Tentang Tempat Ini')
            ->assertSee('Tulis Ulasan Anda');

        $this->get('/etika')
            ->assertOk()
            ->assertSee('Etika Budaya');

        $this->get('/etika/busana-pura')
            ->assertOk()
            ->assertSee('Busana Masuk Pura');

        $this->get('/kalender')
            ->assertOk()
            ->assertSee('Kalender');

        $this->get('/tentang')->assertOk();
        $this->get('/privasi')->assertOk();
    }

    public function test_ulasan_pending_tidak_tampil_di_halaman_detail(): void
    {
        $this->seedDasar();

        $destinasi = Destinasi::where('slug', 'amed-pantai')->firstOrFail();

        Ulasan::create([
            'destinasi_id' => $destinasi->id,
            'nama_pengunjung' => 'Pengunjung Disetujui',
            'rating' => 5,
            'komentar' => 'Ulasan yang sudah lolos moderasi.',
            'status' => 'disetujui',
        ]);

        Ulasan::create([
            'destinasi_id' => $destinasi->id,
            'nama_pengunjung' => 'Pengunjung Pending',
            'rating' => 4,
            'komentar' => 'Ulasan yang masih menunggu moderasi.',
            'status' => 'pending',
        ]);

        $this->get('/destinasi/amed-pantai')
            ->assertOk()
            ->assertSee('Pengunjung Disetujui')
            ->assertDontSee('Pengunjung Pending');
    }

    public function test_halaman_wilayah_dialihkan_ke_filter_destinasi(): void
    {
        $this->seedDasar();

        $this->get('/wilayah/karangasem')
            ->assertRedirect('/destinasi?wilayah=karangasem');
    }

    public function test_destinasi_draft_tidak_bisa_dibuka_publik(): void
    {
        $this->seedDasar();

        $destinasi = Destinasi::where('slug', 'amed-pantai')->firstOrFail();
        $destinasi->update(['status' => 'draft']);

        $this->get('/destinasi/amed-pantai')->assertNotFound();
    }
}
