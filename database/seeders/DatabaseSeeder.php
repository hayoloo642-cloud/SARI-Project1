<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Idempoten: jangan duplikat Test User saat db:seed dijalankan ulang.
        if (! User::where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }

        $this->call([
            AdminSeeder::class,
            WilayahSeeder::class,
            AktivitasSeeder::class,
            BudayaSeeder::class,
            KalenderSeeder::class,
            DestinasiSeeder::class,
            DestinasiTambahanSeeder::class,
            DestinasiBaliSeeder::class,
            DestinasiDetailSeeder::class,
            DestinasiGambarSeeder::class,
            DestinasiFotoSeeder::class,
            DestinasiHighlightSeeder::class,
            DestinasiAktivitasSeeder::class,
            DestinasiBudayaSeeder::class,
            UlasanSeeder::class,
            StatistikKunjunganSeeder::class,
            PengaturanSeeder::class,
            BookmarkSeeder::class,
        ]);
    }
}
