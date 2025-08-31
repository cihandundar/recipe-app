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
        Schema::create('recipe_ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_id')->constrained()->onDelete('cascade'); // Tarif ilişkisi
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Kullanıcı ilişkisi
            $table->tinyInteger('rating')->unsigned(); // Puan (1-5)
            $table->text('comment')->nullable(); // Yorum
            $table->timestamps();
            
            // Bir kullanıcı bir tarife sadece bir kez puan verebilir
            $table->unique(['recipe_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipe_ratings');
    }
};
