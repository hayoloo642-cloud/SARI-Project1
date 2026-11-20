<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('statistik_kunjungan', function (Blueprint $table) {

            $table->id();
            $table->foreignId('destinasi_id')->constrained('destinasi')->cascadeOnDelete();
            $table->date('tanggal');
            $table->unsignedInteger('jumlah')->default(0);
            $table->unique(['destinasi_id', 'tanggal'], 'uniq_statistik_destinasi_tanggal');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('statistik_kunjungan');
    }
};
