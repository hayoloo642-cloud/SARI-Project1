<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('destinasi_highlight', function (Blueprint $table) {

            $table->id();
            $table->foreignId('destinasi_id')->constrained('destinasi')->cascadeOnDelete();
            $table->unsignedInteger('urutan')->default(0);
            $table->text('teks');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('destinasi_highlight');
    }
};
