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
        Schema::create('epinjam_list', function (Blueprint $table) {
            $table->id();

                // $table->unsignedInteger('id_epinjam')->comment('ID from Table epinjam');
                $table->unsignedBigInteger('id_epinjam')->comment('ID from Table epinjam');
                $table->foreign('id_epinjam')->references('id')->on('epinjam');

            $table->integer('id_barang');
            $table->integer('jumlah');
            $table->dateTime('tgl_rencana_kembali')->nullable();

            $table->longText('keterangan')->nullable();
            $table->longText('peruntukan')->nullable();
            $table->boolean('status')->default(true)->comment('0 = Tidak Aktif, 1 = Aktif');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('epinjam_list');
    }
};
