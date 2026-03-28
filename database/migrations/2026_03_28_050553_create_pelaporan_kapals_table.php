<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pelaporan_kapals', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users')->cascadeOnDelete();

            $table->string('nama_kapal');
            $table->enum('status_operasi', [
                'Docking',
                'Rusak Sementara',
                'Rusak Selamanya',
                'Ubah Sifat',
            ]);
            $table->enum('lama_tidak_beroperasi', [
                '1-3 Bulan',
                '3-6 Bulan',
                '6-12 Bulan',
                'Selamanya',
            ]);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pelaporan_kapals');
    }
};