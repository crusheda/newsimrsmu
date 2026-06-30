<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePerbaikanIt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perbaikan_it', function (Blueprint $table) {
            $table->id();
            $table->string('tiket_id', 300)->comment('ID Tiket Whatsapp')->nullable();
            $table->integer('kategori_id')->comment('ID Kategori Tiket')->nullable();

            $table->string('telegram_chat_id',300)->nullable();
            $table->bigInteger('telegram_message_id')->nullable();
            $table->string('telegram_username',300)->nullable();

                $table->unsignedInteger('pegawai_id')->comment('ID from Table Users');
                $table->foreign('pegawai_id')->references('id')->on('users');

                $table->string('title', 200)->nullable();
                $table->string('filename', 300)->nullable();

            $table->string('nama', 300)->comment('Nama Lengkap')->nullable();
            $table->bigInteger('no_wa')->comment('No. Whatsapp')->nullable();
            $table->string('unit', 300)->nullable();
            $table->string('estimasi', 300)->comment('Estimasi Pengerjaan Sampai Selesai')->nullable();

            $table->dateTime('tgl_pengaduan')->nullable();
            $table->longText('ket_pengaduan')->nullable();

            $table->dateTime('tgl_terima')->nullable();
            $table->dateTime('tgl_kerjakan')->nullable();
            $table->dateTime('tgl_selesai')->nullable();
            $table->dateTime('tgl_tolak')->nullable();

            $table->longText('ket_terima')->nullable();
            $table->longText('ket_kerjakan')->nullable();
            $table->longText('ket_selesai')->nullable();
            $table->longText('ket_tolak')->nullable();

            $table->integer('user_terima')->nullable();
            $table->integer('user_kerjakan')->nullable();
            $table->integer('user_selesai')->nullable();
            $table->integer('user_tolak')->nullable();

            $table->string('nama_user_terima',300)->nullable();
            $table->string('nama_user_kerjakan',300)->nullable();
            $table->string('nama_user_selesai',300)->nullable();
            $table->string('nama_user_tolak',300)->nullable();

            // $table->boolean('wa_sent')->default(false);
            // $table->text('wa_error')->nullable();

            $table->boolean('telegram_sent')->default(false);
            $table->text('telegram_error')->nullable();

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
        Schema::dropIfExists('perbaikan_it');
    }
}
