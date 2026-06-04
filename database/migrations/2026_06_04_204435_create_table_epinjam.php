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
        Schema::create('epinjam', function (Blueprint $table) {
            $table->id();

            $table->integer('user_pinjam');
            $table->integer('user_admin_pinjam');
            $table->dateTime('tgl_pinjam');

            $table->integer('user_kembali')->nullable();
            $table->integer('user_admin_kembali')->nullable();
            $table->dateTime('tgl_kembali')->nullable();

            $table->longText('keperluan')->nullable();
            $table->tinyInteger('status')->default(true)->comment('0 = Dibatalkan, 1 = Dipinjam, 2 = Dikembalikan');

            $table->integer('user_batal')->nullable()->comment('User yang membatalkan (status=0)');
            $table->longText('alasan_dibatalkan')->nullable()->comment('Alasan pembatalan (status=0)');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('epinjam');
    }
};
