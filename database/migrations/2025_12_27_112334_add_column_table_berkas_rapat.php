<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTableBerkasRapat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('berkas_rapat', function (Blueprint $table) {
            $table->longText('nama_kepala')->after('kepala')->comment("Nama Kepala Rapat")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('berkas_rapat', function (Blueprint $table) {
            $table->dropColumn('nama_kepala');
        });
    }
}
