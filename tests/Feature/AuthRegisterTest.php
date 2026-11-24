<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthRegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_halaman_register_dapat_dibuka(): void
    {
        $this->get('/register')
            ->assertOk()
            ->assertSee('Buat Akun Pengunjung')
            ->assertSee('Ulangi password');
    }

    public function test_pengunjung_bisa_mendaftar_dan_langsung_masuk(): void
    {
        $this->post('/register', [
            'name' => 'Wayan Pendaftar',
            'email' => 'wayan@example.com',
            'password' => 'rahasia123',
            'password_confirmation' => 'rahasia123',
            'terms' => '1',
        ])->assertRedirect('/akun');

        $this->assertAuthenticated();

        $this->assertDatabaseHas('users', [
            'name' => 'Wayan Pendaftar',
            'email' => 'wayan@example.com',
            'role' => 'user',
        ]);

        $this->get('/akun')
            ->assertOk()
            ->assertSee('Wayan Pendaftar')
            ->assertSee('Destinasi Favorit Saya');
    }

    public function test_role_tidak_bisa_diisi_dari_form_register(): void
    {
        $this->post('/register', [
            'name' => 'Tamu Nakal',
            'email' => 'nakal@example.com',
            'password' => 'rahasia123',
            'password_confirmation' => 'rahasia123',
            'terms' => '1',
            'role' => 'admin',
        ])->assertRedirect('/akun');

        $this->assertDatabaseHas('users', [
            'email' => 'nakal@example.com',
            'role' => 'user',
        ]);
    }

    public function test_email_ganda_dan_password_pendek_ditolak(): void
    {
        User::factory()->create(['email' => 'sudah@example.com']);

        $this->from('/register')->post('/register', [
            'name' => 'Duplikat',
            'email' => 'sudah@example.com',
            'password' => 'pendek',
            'password_confirmation' => 'pendek',
            'terms' => '1',
        ])->assertRedirect('/register')
            ->assertSessionHasErrors(['email', 'password']);

        $this->assertGuest();
    }

    public function test_syarat_privasi_wajib_disetujui(): void
    {
        $this->from('/register')->post('/register', [
            'name' => 'Tanpa Setuju',
            'email' => 'tanpa@example.com',
            'password' => 'rahasia123',
            'password_confirmation' => 'rahasia123',
        ])->assertRedirect('/register')
            ->assertSessionHasErrors('terms');

        $this->assertGuest();
    }

    public function test_pengunjung_biasa_tidak_bisa_membuka_panel_admin(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $this->actingAs($user)
            ->get('/admin')
            ->assertForbidden();
    }

    public function test_halaman_akun_wajib_login(): void
    {
        $this->get('/akun')->assertRedirect('/login');
    }
}
