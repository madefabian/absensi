<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('rapat_id')->constrained()->cascadeOnDelete();
            $table->string('nama')->nullable();
            $table->string('jabatan')->nullable();
            $table->timestamp('waktu_scan');
            $table->enum('status', ['hadir', 'telat']);
            $table->longText('tanda_tangan')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};