<?php

namespace Database\Seeders;

use App\Models\Bookmark;
use App\Models\Destinasi;
use App\Models\User;
use Illuminate\Database\Seeder;

class BookmarkSeeder extends Seeder
{
    /**
     * Data asli SARI menunjuk ke akun SARI (user_id 1 & 4) yang tidak ada di
     * Jejak-Bali, sehingga di sini bookmark dilampirkan ke user pertama yang
     * tersedia. Dilewati dengan peringatan jika tidak ada user/destinasi.
     */
    public function run(): void
    {
        $user = User::first();
        $destinasi = Destinasi::first();

        if (! $user || ! $destinasi) {
            $this->command->warn('BookmarkSeeder dilewati: belum ada user/destinasi.');
            return;
        }

        Bookmark::firstOrCreate(
            ['user_id' => $user->id, 'destinasi_id' => $destinasi->id],
            ['tgl_rencana' => '2027-02-10']
        );
    }
}
