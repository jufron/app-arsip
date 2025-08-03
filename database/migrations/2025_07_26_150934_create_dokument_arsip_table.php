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
        Schema::create('dokument_arsip', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dokumen_pemohon_id');
            $table->foreign('dokumen_pemohon_id')->references('id')->on('dokumen_pemohon');
            $table->string('ruangan');
            $table->string('lemari');
            $table->string('rak');
            $table->string('laci');
            $table->string('box');
            $table->text('keterangan')->nullable();
            $table->date('tanggal_arsip');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokument_arsip');
    }
};
