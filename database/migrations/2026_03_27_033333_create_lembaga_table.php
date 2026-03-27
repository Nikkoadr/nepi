<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lembaga', function (Blueprint $table) {
            $table->id();

            $table->string('npsn')->unique();
            $table->string('nama_lembaga');
            $table->string('pengelola');

            $table->text('alamat');
            $table->string('telepon')->nullable();

            $table->foreignId('jenis_lembaga_id')
                  ->constrained('jenis_lembaga')
                  ->cascadeOnDelete();

            $table->foreignId('kategori_paud_id')
                  ->nullable()
                  ->constrained('kategori_paud')
                  ->nullOnDelete();

            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lembaga');
    }
};
