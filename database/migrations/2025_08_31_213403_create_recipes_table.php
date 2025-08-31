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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Tarif başlığı
            $table->string('slug')->unique(); // SEO dostu URL
            $table->text('description'); // Kısa açıklama
            $table->longText('instructions'); // Yapılış talimatları
            $table->json('ingredients'); // Malzemeler listesi (JSON format)
            $table->string('featured_image')->nullable(); // Ana görsel
            $table->json('gallery_images')->nullable(); // Galeri görselleri (JSON)
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Tarifi ekleyen kullanıcı
            $table->foreignId('recipe_category_id')->constrained()->onDelete('cascade'); // Kategori ilişkisi
            $table->integer('prep_time')->nullable(); // Hazırlama süresi (dakika)
            $table->integer('cook_time')->nullable(); // Pişirme süresi (dakika)
            $table->integer('total_time')->nullable(); // Toplam süre (dakika)
            $table->integer('servings')->default(4); // Kaç kişilik
            $table->enum('difficulty', ['kolay', 'orta', 'zor'])->default('orta'); // Zorluk seviyesi
            $table->json('tags')->nullable(); // Etiketler (JSON format)
            $table->text('chef_notes')->nullable(); // Şef notları
            $table->string('nutrition_info')->nullable(); // Beslenme bilgisi
            $table->decimal('rating', 3, 2)->default(0.00); // Ortalama puan (0.00-5.00)
            $table->unsignedInteger('rating_count')->default(0); // Oy sayısı
            $table->unsignedInteger('views')->default(0); // Görüntülenme sayısı
            $table->unsignedInteger('favorites_count')->default(0); // Favori sayısı
            $table->boolean('is_featured')->default(false); // Öne çıkarılmış
            $table->boolean('is_published')->default(false); // Yayınlandı mı
            $table->timestamp('published_at')->nullable(); // Yayın tarihi
            $table->timestamps();
            
            // İndeksler - Performans için
            $table->index(['is_published', 'published_at']);
            $table->index('is_featured');
            $table->index('recipe_category_id');
            $table->index('user_id');
            $table->index('rating');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
