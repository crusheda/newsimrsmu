<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('berita', function (Blueprint $table) {
            $table->string('gambar_lampiran_1')->nullable()->after('gambar');
            $table->string('gambar_lampiran_2')->nullable()->after('gambar_lampiran_1');
            $table->string('gambar_lampiran_3')->nullable()->after('gambar_lampiran_2');
            $table->string('gambar_lampiran_4')->nullable()->after('gambar_lampiran_3');
            $table->string('gambar_lampiran_5')->nullable()->after('gambar_lampiran_4');
        });
    }

    public function down(): void
    {
        Schema::table('berita', function (Blueprint $table) {
            $table->dropColumn([
                'gambar_lampiran_1',
                'gambar_lampiran_2',
                'gambar_lampiran_3',
                'gambar_lampiran_4',
                'gambar_lampiran_5',
            ]);
        });
    }
};
