<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('izin_lembaga', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lembaga_id')
                  ->constrained('lembaga')
                  ->cascadeOnDelete();
            $table->string('no_sertifikat')->nullable();
            $table->date('masa_berlaku')->nullable();
            $table->enum('status', ['aktif', 'habis', 'kadaluarsa'])->default('aktif');
            $table->enum('jenis_izin', ['baru', 'perpanjangan', 'operasional'])->nullable();
            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('izin_lembaga');
    }
};