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
        Schema::create('epinjam_barang', function (Blueprint $table) {
            $table->id();

                $table->unsignedBigInteger('id_kategori')->comment('ID from Table epinjam_kategori');
                $table->foreign('id_kategori')->references('id')->on('epinjam_kategori');

            $table->string('nama', 500);
            $table->string('asal', 300)->nullable()->comment('Unit Asal');
            $table->string('kondisi', 200)->nullable();
            $table->longText('kelengkapan')->nullable();

            $table->integer('user');
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
        Schema::dropIfExists('epinjam_barang');
    }
};
