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
        Schema::create('video_meetings', function (Blueprint $table) {

            $table->id();

            $table->unsignedInteger('created_by');

            $table->string('title');

            $table->string('room_name')
                ->unique();

            $table->dateTime('start_at')
                ->nullable();

            $table->dateTime('end_at')
                ->nullable();

            $table->boolean('status')
                ->default(1);

            $table->timestamps();


            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_meetings');
    }
};
