<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ulasan', function (Blueprint $table) {

            $table->id();
            $table->foreignId('destinasi_id')->constrained('destinasi')->cascadeOnDelete();
            $table->string('nama_pengunjung');
            $table->unsignedTinyInteger('rating');
            $table->text('komentar');
            $table->enum('status', ['pending', 'disetujui', 'ditolak'])->default('pending');
            $table->timestamps();
            $table->index(['destinasi_id', 'status'], 'idx_ulasan_destinasi');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ulasan');
    }
};
