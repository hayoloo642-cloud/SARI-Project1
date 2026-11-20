<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('destinasi', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->foreignId('wilayah_id')->constrained('wilayah')->restrictOnDelete();
            $table->string('nama');
            $table->string('kategori')->default('');
            $table->text('deskripsi');
            $table->string('waktu_terbaik')->default('');
            $table->string('jam_buka')->default('');
            $table->string('tarif')->default('');
            $table->text('cara_masuk');
            $table->text('etika');
            $table->string('whatsapp')->nullable();
            $table->string('kontak')->default('-');
            $table->decimal('rating_awal', 3, 1)->default(4.5);
            $table->string('gambar')->default('');
            $table->boolean('is_unggulan')->default(false);
            $table->enum('status', ['draft', 'aktif'])->default('aktif');
            $table->decimal('latitude', 10, 7)->default(0);
            $table->decimal('longitude', 10, 7)->default(0);
            $table->string('maps_url')->default('');
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            // FULLTEXT hanya untuk driver MySQL — SQLite tidak mendukungnya.
            if (DB::connection()->getDriverName() === 'mysql') {
                $table->fullText(['nama', 'deskripsi'], 'destinasi_nama_deskripsi_fulltext');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinasi');
    }
};
