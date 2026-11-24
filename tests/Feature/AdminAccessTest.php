<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_dialihkan_ke_login(): void
    {
        $this->get('/admin')->assertRedirect('/login');
    }

    public function test_role_user_ditolak_403(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $this->actingAs($user)->get('/admin')->assertStatus(403);
    }

    public function test_role_admin_boleh_masuk(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)->get('/admin')->assertOk();
    }

    public function test_role_kontributor_boleh_masuk(): void
    {
        $kontributor = User::factory()->create(['role' => 'kontributor']);

        $this->actingAs($kontributor)->get('/admin')->assertOk();
    }

    public function test_endpoint_pengaturan_ditolak_untuk_kontributor(): void
    {
        $kontributor = User::factory()->create(['role' => 'kontributor']);

        $this->actingAs($kontributor)->get('/api/pengaturan')->assertStatus(403);
    }

    public function test_endpoint_pengaturan_ditolak_untuk_guest(): void
    {
        $this->get('/api/pengaturan')->assertUnauthorized();
    }

    public function test_hapus_destinasi_hanya_admin(): void
    {
        $this->seed([
            \Database\Seeders\WilayahSeeder::class,
            \Database\Seeders\DestinasiSeeder::class,
        ]);
        $destinasiId = \App\Models\Destinasi::where('slug', 'amed-pantai')->value('id');

        $kontributor = User::factory()->create(['role' => 'kontributor']);
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($kontributor)->delete("/api/destinasi/{$destinasiId}")->assertStatus(403);
        $this->actingAs($admin)->delete('/api/destinasi/99999')->assertStatus(404);
    }
}
