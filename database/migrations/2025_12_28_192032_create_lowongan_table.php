<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLowonganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lowongan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lowongan');
            $table->string('gambar')->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('persyaratan')->nullable();
            $table->text('tahapan_seleksi')->nullable();
            $table->integer('kuota')->default(0);
            $table->enum('status', ['aktif', 'tutup'])->default('aktif');
            $table->text('pertanyaan_wawancara')->nullable(); // Bisa JSON atau Text
            $table->text('tugas_project')->nullable(); // Deskripsi Project Test
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lowongan');
    }
}
