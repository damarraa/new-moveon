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
        Schema::create('checkin_manifest_penumpangs', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('checkin_manifest_id');
            $table->string('nik', 25);
            $table->string('nama');
            $table->date('tanggal_lahir');

            $table->timestamps();

            $table->foreign('checkin_manifest_id')
                ->references('id')
                ->on('checkin_manifests')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkin_manifest_penumpangs');
    }
};