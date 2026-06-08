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
        Schema::create('epinjam_asal', function (Blueprint $table) {
            $table->id();

            $table->string('unit', 500);

            $table->integer('user')->nullable();
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
        Schema::dropIfExists('epinjam_asal');
    }
};
