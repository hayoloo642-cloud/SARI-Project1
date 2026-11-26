<?php

namespace Database\Seeders;

use App\Models\Destinasi;
use Illuminate\Database\Seeder;

class DestinasiFotoSeeder extends Seeder
{
    /**
     * Memasang foto cover dan atribusinya dari manifest hasil
     * scripts/import-foto-wikimedia.php.
     *
     * Idempoten: aman dijalankan berkali-kali.
     */
    public function run(): void
    {
        $manifestPath = database_path('data/foto-destinasi.json');

        if (! is_file($manifestPath)) {
            $this->command?->warn('Manifest foto-destinasi.json belum ada. Jalankan scripts/import-foto-wikimedia.php.');

            return;
        }

        $manifest = json_decode(file_get_contents($manifestPath), true) ?: [];
        $ids = Destinasi::pluck('id', 'slug');
        $dipasang = 0;

        foreach ($manifest as $slug => $foto) {
            $id = $ids[$slug] ?? null;
            $path = public_path($foto['file'] ?? '');

            if (! $id || ! is_file($path)) {
                continue;
            }

            Destinasi::whereKey($id)->update([
                'gambar' => $foto['file'],
                'gambar_kredit' => $foto['kredit'] ?? null,
                'gambar_sumber' => $foto['sumber'] ?? null,
            ]);

            $dipasang++;
        }

        $this->command?->info("Foto cover terpasang: {$dipasang} destinasi.");
    }
}
