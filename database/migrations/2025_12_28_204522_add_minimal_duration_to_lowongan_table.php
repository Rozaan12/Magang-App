<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMinimalDurationToLowonganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lowongan', function (Blueprint $table) {
            $table->integer('minimal_durasi')->default(1)->after('kuota');
        });
    }

    public function down()
    {
        Schema::table('lowongan', function (Blueprint $table) {
            $table->dropColumn('minimal_durasi');
        });
    }
}
