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
        Schema::create('kabar_jemaats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('kategori_id');
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('gambar')->nullable();
            $table->string('sumber_gambar')->nullable();
            $table->text('excerpt');
            $table->text('isi');
            $table->string('sumber')->nullable();
            $table->string('status_publikasi')->default('published');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kabar_jemaats');
    }
};
