<?php

namespace Tests\Feature;

use App\Models\Budaya;
use App\Models\Destinasi;
use App\Models\Kalender;
use App\Models\Ulasan;
use App\Models\User;
use App\Models\Wilayah;
use Database\Seeders\AdminSeeder;
use Database\Seeders\WilayahSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPanelCrudTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;
    private Wilayah $wilayah;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed([AdminSeeder::class, WilayahSeeder::class]);
        $this->admin = User::where('role', 'admin')->first();
        $this->wilayah = Wilayah::first();
    }

    public function test_guest_tidak_bisa_akses_admin(): void
    {
        $this->get('/admin')->assertRedirect('/login');
        $this->get('/admin/destinasi')->assertRedirect('/login');
    }

    public function test_admin_bisa_buka_dashboard_dan_halaman_list(): void
    {
        $this->actingAs($this->admin)
            ->get('/admin')
            ->assertOk()
            ->assertSee('Ringkasan Sistem');

        $this->actingAs($this->admin)
            ->get('/admin/destinasi')
            ->assertOk()
            ->assertSee('Kelola Destinasi Wisata');

        $this->actingAs($this->admin)
            ->get('/admin/budaya')
            ->assertOk()
            ->assertSee('Kelola Panduan Etika Budaya');

        $this->actingAs($this->admin)
            ->get('/admin/kalender')
            ->assertOk()
            ->assertSee('Kelola Agenda Kalender');

        $this->actingAs($this->admin)
            ->get('/admin/ulasan')
            ->assertOk()
            ->assertSee('Moderasi Ulasan Pengunjung');
    }

    public function test_admin_bisa_tambah_edit_hapus_destinasi(): void
    {
        // 1. Create
        $response = $this->actingAs($this->admin)
            ->post('/admin/destinasi', [
                'nama' => 'Pantai Uji Coba Baru',
                'slug' => 'pantai-uji-coba-baru',
                'wilayah_id' => $this->wilayah->id,
                'kategori' => 'Pantai & Pesisir',
                'deskripsi' => 'Deskripsi pantai uji coba.',
                'status' => 'aktif',
            ]);

        $response->assertRedirect('/admin/destinasi');
        $this->assertDatabaseHas('destinasi', ['slug' => 'pantai-uji-coba-baru']);

        $destinasi = Destinasi::where('slug', 'pantai-uji-coba-baru')->firstOrFail();

        // 2. Edit / Update
        $this->actingAs($this->admin)
            ->put("/admin/destinasi/{$destinasi->id}", [
                'nama' => 'Pantai Uji Coba Diubah',
                'slug' => 'pantai-uji-coba-baru',
                'wilayah_id' => $this->wilayah->id,
                'kategori' => 'Pantai & Sunset',
                'deskripsi' => 'Deskripsi sudah diperbarui.',
                'status' => 'aktif',
            ])
            ->assertRedirect('/admin/destinasi');

        $this->assertDatabaseHas('destinasi', ['nama' => 'Pantai Uji Coba Diubah']);

        // 3. Delete
        $this->actingAs($this->admin)
            ->delete("/admin/destinasi/{$destinasi->id}")
            ->assertRedirect('/admin/destinasi');

        $this->assertDatabaseMissing('destinasi', ['id' => $destinasi->id]);
    }

    public function test_admin_bisa_tambah_edit_hapus_budaya(): void
    {
        $response = $this->actingAs($this->admin)
            ->post('/admin/budaya', [
                'judul' => 'Etika Mengikuti Upacara Melasti',
                'ringkas' => 'Panduan menghormati iringan warga.',
                'detail' => 'Jangan memotong iringan dan patuhi arahan pecalang.',
            ]);

        $response->assertRedirect('/admin/budaya');
        $this->assertDatabaseHas('budaya', ['judul' => 'Etika Mengikuti Upacara Melasti']);

        $budaya = Budaya::where('judul', 'Etika Mengikuti Upacara Melasti')->firstOrFail();

        $this->actingAs($this->admin)
            ->put("/admin/budaya/{$budaya->id}", [
                'judul' => 'Etika Melasti Diperbarui',
                'slug' => $budaya->slug,
                'ringkas' => 'Ringkasan diubah.',
                'detail' => 'Detail baru.',
            ])
            ->assertRedirect('/admin/budaya');

        $this->assertDatabaseHas('budaya', ['judul' => 'Etika Melasti Diperbarui']);

        $this->actingAs($this->admin)
            ->delete("/admin/budaya/{$budaya->id}")
            ->assertRedirect('/admin/budaya');

        $this->assertDatabaseMissing('budaya', ['id' => $budaya->id]);
    }

    public function test_admin_bisa_tambah_edit_hapus_kalender(): void
    {
        $response = $this->actingAs($this->admin)
            ->post('/admin/kalender', [
                'nama' => 'Piodalan Pura Uji',
                'tanggal_teks' => '10 Desember 2027',
                'tanggal_iso' => '2027-12-10',
                'keterangan' => 'Perayaan hari jadi pura desa.',
            ]);

        $response->assertRedirect('/admin/kalender');
        $this->assertDatabaseHas('kalender', ['nama' => 'Piodalan Pura Uji']);

        $kalender = Kalender::where('nama', 'Piodalan Pura Uji')->firstOrFail();

        $this->actingAs($this->admin)
            ->put("/admin/kalender/{$kalender->id}", [
                'nama' => 'Piodalan Pura Uji Revisi',
                'tanggal_teks' => '11 Desember 2027',
                'tanggal_iso' => '2027-12-11',
                'keterangan' => 'Keterangan diperbarui.',
            ])
            ->assertRedirect('/admin/kalender');

        $this->assertDatabaseHas('kalender', ['nama' => 'Piodalan Pura Uji Revisi']);

        $this->actingAs($this->admin)
            ->delete("/admin/kalender/{$kalender->id}")
            ->assertRedirect('/admin/kalender');

        $this->assertDatabaseMissing('kalender', ['id' => $kalender->id]);
    }

    public function test_admin_bisa_moderasi_dan_hapus_ulasan(): void
    {
        $destinasi = Destinasi::create([
            'nama' => 'Destinasi Untuk Review',
            'slug' => 'destinasi-untuk-review',
            'wilayah_id' => $this->wilayah->id,
            'kategori' => 'Pantai',
            'deskripsi' => 'Deskripsi ulasan',
            'cara_masuk' => 'Akses mudah',
            'etika' => 'Norma sopan',
            'status' => 'aktif',
        ]);

        $ulasan = Ulasan::create([
            'destinasi_id' => $destinasi->id,
            'nama_pengunjung' => 'Budi Pengunjung',
            'rating' => 5,
            'komentar' => 'Tempat yang sangat indah dan bersih.',
            'status' => 'pending',
        ]);

        $this->actingAs($this->admin)
            ->patch("/admin/ulasan/{$ulasan->id}/status", ['status' => 'disetujui'])
            ->assertRedirect();

        $this->assertDatabaseHas('ulasan', ['id' => $ulasan->id, 'status' => 'disetujui']);

        $this->actingAs($this->admin)
            ->delete("/admin/ulasan/{$ulasan->id}")
            ->assertRedirect();

        $this->assertDatabaseMissing('ulasan', ['id' => $ulasan->id]);
    }
}
