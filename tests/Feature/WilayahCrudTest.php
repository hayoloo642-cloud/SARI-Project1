<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Wilayah;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WilayahCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_menampilkan_data_dan_show_satu_baris(): void
    {
        $this->seed(\Database\Seeders\WilayahSeeder::class);

        $this->get('/api/wilayah')->assertOk()->assertJsonCount(9, 'data');
        $id = Wilayah::where('slug', 'karangasem')->value('id');
        $this->get("/api/wilayah/{$id}")->assertOk()->assertJsonPath('data.slug', 'karangasem');
    }

    public function test_tamu_tidak_bisa_menambah_wilayah(): void
    {
        $this->post('/api/wilayah', ['slug' => 'x', 'nama' => 'X'])
            ->assertUnauthorized();
    }

    public function test_kontributor_ditolak_403_saat_menambah(): void
    {
        $kontributor = User::factory()->create(['role' => 'kontributor']);

        $this->actingAs($kontributor)
            ->post('/api/wilayah', ['slug' => 'bali-baru', 'nama' => 'Bali Baru'])
            ->assertStatus(403);
    }

    public function test_admin_bisa_menambah_dan_validasi_slug_unik(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->post('/api/wilayah', ['slug' => 'bali-baru', 'nama' => 'Bali Baru', 'deskripsi' => 'contoh'])
            ->assertCreated()
            ->assertJsonPath('data.slug', 'bali-baru');

        $this->actingAs($admin)
            ->post('/api/wilayah', ['slug' => 'bali-baru', 'nama' => 'Bali Baru Lagi'])
            ->assertJsonValidationErrors('slug');
    }

    public function test_admin_bisa_update_dan_hapus(): void
    {
        $this->seed([
            \Database\Seeders\WilayahSeeder::class,
            \Database\Seeders\DestinasiSeeder::class,
        ]);
        $admin = User::factory()->create(['role' => 'admin']);

        $id = Wilayah::where('slug', 'karangasem')->value('id');
        $this->actingAs($admin)
            ->put("/api/wilayah/{$id}", ['nama' => 'Karangasem Updated'])
            ->assertOk()
            ->assertJsonPath('data.nama', 'Karangasem Updated');

        // Gianyar dipakai destinasi (Tahura Mangrove & Tirta Empul) → terblokir FK
        $idGianyar = Wilayah::where('slug', 'gianyar')->value('id');
        $this->actingAs($admin)->delete("/api/wilayah/{$idGianyar}")->assertStatus(422);
        $this->assertDatabaseHas('wilayah', ['slug' => 'gianyar']);
    }
}
