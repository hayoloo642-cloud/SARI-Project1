<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Menyiapkan akun admin untuk panel admin SARI.
     * Idempoten: dijalankan berkali-kali tidak menggandakan akun
     * dan tidak mereset password akun yang sudah ada.
     */
    public function run(): void
    {
        // 1. Akun admin utama SARI
        $admin = User::firstOrNew(['email' => 'admin@sari-bali.id']);
        if (! $admin->exists) {
            $admin->name = 'Administrator Jejak Bali';
            $admin->password = Hash::make('admin123');
            $admin->role = 'admin';
            $admin->bio = '';
            $admin->avatar = '';
            $admin->email_verified_at = now();
            $admin->save();
            $this->command->info('AdminSeeder: admin@sari-bali.id dibuat (password: admin123 — segera ganti).');
        } else {
            $admin->role = 'admin';
            $admin->save();
            $this->command->info('AdminSeeder: admin@sari-bali.id sudah ada; role dipastikan admin (password tidak diubah).');
        }

        // 2. Test User dipromosikan jadi admin agar bisa dipakai uji panel admin
        $test = User::where('email', 'test@example.com')->first();
        if ($test && $test->role !== 'admin') {
            $test->role = 'admin';
            $test->save();
            $this->command->info('AdminSeeder: test@example.com dipromosikan menjadi admin.');
        }
    }
}
