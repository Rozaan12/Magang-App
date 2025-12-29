<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdLowonganToPendaftaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->unsignedBigInteger('id_lowongan')->nullable()->after('id_users');
            $table->text('jawaban_wawancara')->nullable()->after('status_pendaftaran'); 
            $table->string('link_project')->nullable()->after('jawaban_wawancara');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->dropColumn(['id_lowongan', 'jawaban_wawancara', 'link_project']);
        });
    }
}
