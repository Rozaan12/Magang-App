<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFileTugasToLowonganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lowongan', function (Blueprint $table) {
            $table->string('file_tugas')->nullable()->after('minimal_durasi');
        });
    }

    public function down()
    {
        Schema::table('lowongan', function (Blueprint $table) {
            $table->dropColumn('file_tugas');
        });
    }
}
