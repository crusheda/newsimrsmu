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
        if (!Schema::hasColumn('users', 'last_update_password')) {
            Schema::table('users', function (Blueprint $table) {
                $table->datetime('last_update_password')->after('password')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('users', 'last_update_password')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('last_update_password');
            });
        }
    }
};
