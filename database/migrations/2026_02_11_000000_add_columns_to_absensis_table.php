<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
<<<<<<< HEAD

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

=======
    public function up(): void
    {
        Schema::table('absensis', function (Blueprint $table) {
            $table->string('nama')->nullable();
            $table->string('jabatan')->nullable();
            $table->longText('tanda_tangan')->nullable();
        });
    }
>>>>>>> 70be02f57cb47ceae4e81711a054e31c8e686253

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
<<<<<<< HEAD
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

=======
        Schema::table('absensis', function (Blueprint $table) {
            $table->dropColumn(['nama', 'jabatan', 'tanda_tangan']);
        });
>>>>>>> 70be02f57cb47ceae4e81711a054e31c8e686253
    }
};
