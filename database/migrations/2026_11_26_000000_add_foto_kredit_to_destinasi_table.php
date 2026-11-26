<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('destinasi', function (Blueprint $table) {
            $table->string('gambar_kredit')->nullable()->after('gambar');
            $table->string('gambar_sumber')->nullable()->after('gambar_kredit');
        });
    }

    public function down(): void
    {
        Schema::table('destinasi', function (Blueprint $table) {
            $table->dropColumn(['gambar_kredit', 'gambar_sumber']);
        });
    }
};
