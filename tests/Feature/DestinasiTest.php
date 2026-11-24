<?php

namespace Tests\Feature;

use App\Models\Destinasi;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DestinasiTest extends TestCase
{
    use RefreshDatabase;

    private function seedSari(): void
    {
        $this->seed([
            \Database\Seeders\WilayahSeeder::class,
            \Database\Seeders\AktivitasSeeder::class,
            \Database\Seeders\BudayaSeeder::class,
            \Database\Seeders\DestinasiSeeder::class,
            \Database\Seeders\DestinasiDetailSeeder::class,
            \Database\Seeders\DestinasiGambarSeeder::class,
            \Database\Seeders\DestinasiHighlightSeeder::class,
            \Database\Seeders\DestinasiAktivitasSeeder::class,
            \Database\Seeders\DestinasiBudayaSeeder::class,
        ]);
    }

    public function test_index_berisi_12_destinasi(): void
    {
        $this->seedSari();

        $this->get('/api/destinasi')->assertOk()->assertJsonCount(12, 'data');
    }

    public function test_tamu_tidak_bisa_menambah(): void
    {
        $this->seedSari();

        $this->post('/api/destinasi', ['slug' => 'x', 'nama' => 'X'])
            ->assertUnauthorized();
    }

    public function test_kontributor_bisa_membuat_dan_user_id_diisi_otomatis(): void
    {
        $this->seedSari();
        $kontributor = User::factory()->create(['role' => 'kontributor']);

        $response = $this->actingAs($kontributor)->post('/api/destinasi', [
            'slug' => 'destinasi-baru',
            'wilayah_id' => \App\Models\Wilayah::where('slug', 'karangasem')->value('id'),
            'nama' => 'Destinasi Baru',
            'deskripsi' => 'Deskripsi destinasi baru.',
            'cara_masuk' => 'Masuk dari timur.',
            'etika' => 'Hormati warga.',
        ]);

        $response->assertCreated();
        $this->assertEquals($kontributor->id, Destinasi::where('slug', 'destinasi-baru')->value('user_id'));
    }

    public function test_validasi_gagal_saat_field_wajib_kosong(): void
    {
        $this->seedSari();
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post('/api/destinasi', []);

        $response->assertJsonValidationErrors(['slug', 'wilayah_id', 'nama', 'deskripsi', 'cara_masuk', 'etika']);
    }

    public function test_show_memuat_relasi_detail_galeri_highlight_aktivitas_budaya(): void
    {
        $this->seedSari();

        $id = Destinasi::where('slug', 'amed-pantai')->value('id');
        $this->get("/api/destinasi/{$id}")
            ->assertOk()
            ->assertJsonPath('data.nama', 'Pantai Amed')
            ->assertJsonPath('data.detail.0.urutan', 0)
            ->assertJsonCount(4, 'data.galeri')
            ->assertJsonCount(4, 'data.highlight')
            ->assertJsonCount(5, 'data.aktivitas')
            ->assertJsonCount(2, 'data.budaya');
    }

    public function test_hapus_destinasi_hanya_untuk_admin(): void
    {
        $this->seedSari();
        $kontributor = User::factory()->create(['role' => 'kontributor']);
        $admin = User::factory()->create(['role' => 'admin']);

        $id = Destinasi::where('slug', 'amed-pantai')->value('id');
        $this->actingAs($kontributor)->delete("/api/destinasi/{$id}")->assertStatus(403);
        $this->actingAs($admin)->delete("/api/destinasi/{$id}")->assertOk();
        $this->assertDatabaseMissing('destinasi', ['id' => $id]);
    }
}
