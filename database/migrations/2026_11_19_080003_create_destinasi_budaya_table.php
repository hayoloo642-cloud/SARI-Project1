<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('destinasi_budaya', function (Blueprint $table) {

            $table->foreignId('destinasi_id')->constrained('destinasi')->cascadeOnDelete();
            $table->foreignId('budaya_id')->constrained('budaya')->cascadeOnDelete();
            $table->primary(['destinasi_id', 'budaya_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('destinasi_budaya');
    }
};
