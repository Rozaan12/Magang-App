<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAcademicAndFilesToDetailUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_users', function (Blueprint $table) {
            $table->string('sekolah')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('program_studi')->nullable();
            $table->string('cv')->nullable();
            $table->string('portofolio_file')->nullable();
            $table->string('portofolio_link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_users', function (Blueprint $table) {
            $table->dropColumn(['sekolah', 'jurusan', 'program_studi', 'cv', 'portofolio_file', 'portofolio_link']);
        });
    }
}
