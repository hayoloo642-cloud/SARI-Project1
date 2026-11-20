<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    private function buatAdmin(): User
    {
        return User::factory()->create([
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);
    }

    public function test_halaman_login_bisa_dibuka(): void
    {
        $this->get('/login')->assertOk();
    }

    public function test_login_berhasil_redirect_ke_admin(): void
    {
        $admin = $this->buatAdmin();

        $response = $this->post('/login', [
            'email' => 'admin@example.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('/admin');
        $this->assertAuthenticatedAs($admin);
    }

    public function test_login_gagal_kembali_dengan_error(): void
    {
        $this->buatAdmin();

        $response = $this->post('/login', [
            'email' => 'admin@example.com',
            'password' => 'password-salah',
        ]);

        $response->assertRedirect('/');
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_login_dibatasi_5_percobaan_per_menit(): void
    {
        $this->buatAdmin();

        for ($i = 0; $i < 5; $i++) {
            $this->post('/login', ['email' => 'admin@example.com', 'password' => 'salah']);
        }

        $response = $this->post('/login', ['email' => 'admin@example.com', 'password' => 'salah']);
        $this->assertEquals(429, $response->getStatusCode());
    }

    public function test_logout_mematikan_sesi(): void
    {
        $admin = $this->buatAdmin();

        $this->actingAs($admin)
            ->post('/logout')
            ->assertRedirect('/login');

        $this->assertGuest();
    }

    public function test_pengguna_yang_sudah_login_dialihkan_dari_halaman_login(): void
    {
        $admin = $this->buatAdmin();

        $this->actingAs($admin)
            ->get('/login')
            ->assertRedirect('/admin');
    }
}
