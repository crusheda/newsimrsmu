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
        Schema::table('datalogs', function (Blueprint $table) {
            $table->integer('kategori_id')->after('user_id')->comment('ref_jenis TB Referensi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('datalogs', function (Blueprint $table) {
            $table->dropColumn('kategori_id');
        });
    }
};
