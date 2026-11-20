<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('destinasi', function (Blueprint $table) {
            $table->string('pengelola_nama')->default('')->after('maps_url');
            $table->string('pengelola_wa')->default('')->after('pengelola_nama');
            $table->string('pengelola_foto')->default('')->after('pengelola_wa');
        });
    }

    public function down(): void
    {
        Schema::table('destinasi', function (Blueprint $table) {
            $table->dropColumn(['pengelola_nama', 'pengelola_wa', 'pengelola_foto']);
        });
    }
};
