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
        Schema::create('dokumen_pemohon', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nik')->unique();
            $table->string('nama');
            $table->string('jenis_pengurusan');
            $table->date('tanggal_pengurusan');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_pemohon');
    }
};
