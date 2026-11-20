<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('destinasi_gambar', function (Blueprint $table) {

            $table->id();
            $table->foreignId('destinasi_id')->constrained('destinasi')->cascadeOnDelete();
            $table->string('path');
            $table->string('alt')->default('');
            $table->boolean('is_utama')->default(false);
            $table->string('kredit')->default('Wikimedia Commons');
            $table->string('sumber_url')->default('');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('destinasi_gambar');
    }
};
