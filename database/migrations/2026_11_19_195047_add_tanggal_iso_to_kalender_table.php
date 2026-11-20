<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kalender', function (Blueprint $table) {
            $table->date('tanggal_iso')->nullable()->after('tanggal_teks');
        });
    }

    public function down(): void
    {
        Schema::table('kalender', function (Blueprint $table) {
            $table->dropColumn('tanggal_iso');
        });
    }
};
