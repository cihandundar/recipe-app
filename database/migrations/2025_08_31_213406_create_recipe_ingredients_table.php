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
        Schema::create('recipe_ingredients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_id')->constrained()->onDelete('cascade'); // Tarif ilişkisi
            $table->string('name'); // Malzeme adı
            $table->string('amount'); // Miktar (örn: "2", "1/2")
            $table->string('unit')->nullable(); // Birim (örn: "su bardağı", "yemek kaşığı")
            $table->text('notes')->nullable(); // Ek notlar (örn: "ince doğranmış")
            $table->integer('sort_order')->default(0); // Sıralama
            $table->boolean('is_optional')->default(false); // İsteğe bağlı mı
            $table->timestamps();
            
            // İndeks
            $table->index('recipe_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipe_ingredients');
    }
};
