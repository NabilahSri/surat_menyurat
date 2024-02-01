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
        Schema::create('surat_masuks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_user')->unsigned();
            $table->string('nomor_surat')->unique();
            $table->date('tanggal_surat');
            $table->enum('sifat_surat', ['segera', 'penting', 'rahasia', 'biasa']);
            $table->string('pengirim');
            $table->unsignedBigInteger('id_perihal');
            $table->text('isi_surat_ringkas');
            $table->text('file')->nullable();
            $table->datetime('tanggal');
            $table->string('status');
            $table->string('lokasi_penyimpanan')->nullable();
            $table->foreign('id_user')->references('id')->on('users')->onUpdate('no action')->onDelete('no action');
            $table->foreign('id_perihal')->references('id')->on('perihal')->onUpdate('no action')->onDelete('no action');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_masuks');
    }
};
