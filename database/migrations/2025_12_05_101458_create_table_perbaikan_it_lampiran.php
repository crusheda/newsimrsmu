<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePerbaikanItLampiran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perbaikan_it_lampiran', function (Blueprint $table) {
            $table->id();
            $table->integer('tiket_id');

                $table->unsignedInteger('pegawai_id')->comment('ID from Table Users');
                $table->foreign('pegawai_id')->references('id')->on('users');

                $table->string('title', 200)->nullable();
                $table->string('filename', 300)->nullable();
                $table->longText('ket')->nullable();
                $table->boolean('status')->default(1)->comment('1=Aktif,0=Non Aktif');

            $table->softDeletes();
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
        Schema::dropIfExists('perbaikan_it_lampiran');
    }
}
