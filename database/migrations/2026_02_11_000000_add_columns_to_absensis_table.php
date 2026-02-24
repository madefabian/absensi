<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('absensis', function (Blueprint $table) {
            $table->string('nama')->nullable();
            $table->string('jabatan')->nullable();
            $table->longText('tanda_tangan')->nullable();
            $table->uuid('uuid')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('absensis', function (Blueprint $table) {
            $table->dropColumn(['nama', 'jabatan', 'tanda_tangan', 'uuid']);
        });
    }
};
