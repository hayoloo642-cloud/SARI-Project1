<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StatistikKunjunganTest extends TestCase
{
    use RefreshDatabase;

    private function seedDestinasi(): void
    {
        $this->seed([
            \Database\Seeders\WilayahSeeder::class,
            \Database\Seeders\DestinasiSeeder::class,
        ]);
    }

    public function test_kunjungan_pertama_dan_kedua_digabung_per_tanggal(): void
    {
        $this->seedDestinasi();

        $destinasiId = \App\Models\Destinasi::where('slug', 'amed-pantai')->value('id');
        $payload = ['destinasi_id' => $destinasiId, 'tanggal' => '2026-11-19', 'jumlah' => 1];

        $this->post('/statistik-kunjungan', $payload)->assertCreated();
        $this->post('/statistik-kunjungan', $payload)->assertCreated();

        $this->assertDatabaseHas('statistik_kunjungan', [
            'destinasi_id' => $destinasiId,
            'tanggal' => '2026-11-19',
            'jumlah' => 2,
        ]);
    }

    public function test_index_hanya_untuk_admin(): void
    {
        $this->seedDestinasi();

        $this->get('/statistik-kunjungan')->assertRedirect('/login');

        $admin = \App\Models\User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin)->get('/statistik-kunjungan')->assertOk();
    }
}
