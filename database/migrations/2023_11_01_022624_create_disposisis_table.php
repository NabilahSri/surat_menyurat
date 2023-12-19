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
        Schema::create('disposisis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_user')->unsigned();
            $table->bigInteger('id_surat_masuk')->unsigned();
            $table->bigInteger('disposisi')->unsigned();
            $table->text('isi_disposisi');
            $table->bigInteger('dari_bagian')->unsigned();
            $table->date('tanggal');
            $table->foreign('id_user')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_surat_masuk')->references('id')->on('surat_masuks')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('disposisi')->references('id')->on('unit_kerjas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('dari_bagian')->references('id')->on('unit_kerjas')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disposisis');
    }
};