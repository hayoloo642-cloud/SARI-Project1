<?php

namespace Tests\Feature;

use App\Models\Destinasi;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class DestinasiFullTextTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * FULLTEXT InnoDB tidak melihat baris yang belum di-COMMIT, jadi test ini
     * tidak dibungkus transaksi (pakai DatabaseMigrations, bukan RefreshDatabase).
     */
    public function test_fulltext_index_menemukan_kata_pantai(): void
    {
        $this->seed([
            \Database\Seeders\WilayahSeeder::class,
            \Database\Seeders\DestinasiSeeder::class,
        ]);

        $this->assertEquals(2, Destinasi::whereFullText(['nama', 'deskripsi'], 'pantai')->count());
    }
}
