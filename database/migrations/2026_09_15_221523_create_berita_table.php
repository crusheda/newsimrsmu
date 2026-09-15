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
        Schema::create('berita', function (Blueprint $table) {
            $table->id();

            $table->string('judul');
            $table->string('slug')->unique();

            $table->string('gambar')->nullable();

            $table->text('ringkasan')->nullable();
            $table->longText('isi');

            $table->string('penulis')->nullable();

            $table->boolean('is_published')
                ->default(true)
                ->index();

            $table->timestamp('published_at')
                ->nullable()
                ->index();

            $table->unsignedBigInteger('views')
                ->default(0);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};
