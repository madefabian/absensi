<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

public function up()
{
    Schema::table('absensis', function (Blueprint $table) {

        if (!Schema::hasColumn('absensis', 'nama')) {
            $table->string('nama')->nullable();
        }

        if (!Schema::hasColumn('absensis', 'jabatan')) {
            $table->string('jabatan')->nullable();
        }

        if (!Schema::hasColumn('absensis', 'tanda_tangan')) {
            $table->longText('tanda_tangan')->nullable();
        }

        if (!Schema::hasColumn('absensis', 'uuid')) {
            $table->uuid('uuid')->nullable();
        }

    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
Schema::table('absensis', function (Blueprint $table) {
    if (!Schema::hasColumn('absensis', 'nama')) {
        $table->string('nama')->nullable();
    }

    if (!Schema::hasColumn('absensis', 'jabatan')) {
        $table->string('jabatan')->nullable();
    }

    if (!Schema::hasColumn('absensis', 'tanda_tangan')) {
        $table->longText('tanda_tangan')->nullable();
    }

    if (!Schema::hasColumn('absensis', 'uuid')) {
        $table->uuid('uuid')->nullable();
    }
});

    }
};
