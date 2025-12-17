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
        Schema::create('recipe_favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_id')->constrained()->onDelete('cascade'); // Tarif ilişkisi
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Kullanıcı ilişkisi
            $table->timestamps();
            
            // Bir kullanıcı bir tarifi sadece bir kez favorilere ekleyebilir
            $table->unique(['recipe_id', 'user_id']);
            
            // İndeksler - Performans için
            $table->index('recipe_id');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipe_favorites');
    }
};
