<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('checkin_manifests', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('user_id');
            $table->uuid('profiling_id');

            $table->string('jenis_layanan');
            $table->string('asal');
            $table->string('tujuan');
            $table->date('tanggal_berangkat');
            $table->time('jam_berangkat');
            $table->string('telepon');

            $table->string('bawa_kendaraan')->nullable();
            $table->string('jenis_kendaraan')->nullable();
            $table->string('plat_nomor')->nullable();

            $table->integer('jumlah_penumpang')->default(0);
            $table->string('status')->default('draft');

            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('profiling_id')
                ->references('id')
                ->on('profilings')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkin_manifests');
    }
};