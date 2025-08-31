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
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Kategori adı (örn: "Sağlıklı Beslenme")
            $table->string('slug')->unique(); // SEO dostu URL (örn: "saglikli-beslenme")
            $table->text('description')->nullable(); // Kategori açıklaması
            $table->string('color', 7)->default('#ff6b35'); // Kategori rengi (hex kod)
            $table->string('icon')->nullable(); // FontAwesome ikon sınıfı
            $table->boolean('is_active')->default(true); // Aktif/pasif durumu
            $table->integer('sort_order')->default(0); // Sıralama düzeni
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_categories');
    }
};
