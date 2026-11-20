<?php

namespace Tests\Feature;

use App\Models\Ulasan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UlasanTest extends TestCase
{
    use RefreshDatabase;

    private function seedSari(): void
    {
        $this->seed([
            \Database\Seeders\WilayahSeeder::class,
            \Database\Seeders\DestinasiSeeder::class,
        ]);
    }

    public function test_tamu_bisa_mengirim_ulasan_masuk_default_pending(): void
    {
        $this->seedSari();
        $destinasiId = \App\Models\Destinasi::where('slug', 'amed-pantai')->value('id');

        $this->post('/ulasan', [
            'destinasi_id' => $destinasiId,
            'nama_pengunjung' => 'I Wayan Test',
            'rating' => 5,
            'komentar' => 'Tempatnya indah sekali.',
        ])->assertCreated();

        $this->assertDatabaseHas('ulasan', [
            'destinasi_id' => $destinasiId,
            'nama_pengunjung' => 'I Wayan Test',
            'status' => 'pending',
        ]);
    }

    public function test_rating_di_luar_1_sampai_5_ditolak(): void
    {
        $this->seedSari();

        $this->post('/ulasan', [
            'destinasi_id' => \App\Models\Destinasi::where('slug', 'amed-pantai')->value('id'),
            'nama_pengunjung' => 'Test',
            'rating' => 7,
            'komentar' => 'x',
        ])->assertSessionHasErrors('rating');
    }

    public function test_index_ulasan_hanya_untuk_admin(): void
    {
        $this->seedSari();

        $this->get('/ulasan')->assertRedirect('/login');

        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user)->get('/ulasan')->assertStatus(403);

        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin)->get('/ulasan')->assertOk();
    }

    public function test_admin_bisa_menyetujui_ulasan(): void
    {
        $this->seedSari();
        $admin = User::factory()->create(['role' => 'admin']);

        $destinasiId = \App\Models\Destinasi::where('slug', 'tirta-gangga')->value('id');
        $this->post('/ulasan', [
            'destinasi_id' => $destinasiId,
            'nama_pengunjung' => 'Moderasi Test',
            'rating' => 4,
            'komentar' => 'bagus',
        ]);

        $ulasan = Ulasan::where('nama_pengunjung', 'Moderasi Test')->firstOrFail();

        $this->actingAs($admin)
            ->patch("/ulasan/{$ulasan->id}", ['status' => 'disetujui'])
            ->assertOk()
            ->assertJsonPath('data.status', 'disetujui');
    }

    public function test_status_tidak_valid_ditolak_saat_moderasi(): void
    {
        $this->seedSari();
        $admin = User::factory()->create(['role' => 'admin']);

        $ulasan = Ulasan::create([
            'destinasi_id' => \App\Models\Destinasi::where('slug', 'amed-pantai')->value('id'),
            'nama_pengunjung' => 'X',
            'rating' => 3,
            'komentar' => 'x',
            'status' => 'pending',
        ]);

        $this->actingAs($admin)
            ->patch("/ulasan/{$ulasan->id}", ['status' => 'ngaco'])
            ->assertSessionHasErrors('status');
    }
}
