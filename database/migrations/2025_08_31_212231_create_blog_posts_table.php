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
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Makale başlığı
            $table->string('slug')->unique(); // SEO dostu URL
            $table->text('excerpt'); // Kısa özet
            $table->longText('content'); // Ana içerik
            $table->string('featured_image')->nullable(); // Öne çıkan görsel
            $table->string('author_name'); // Yazar adı
            $table->string('author_title')->nullable(); // Yazar unvanı
            $table->text('author_bio')->nullable(); // Yazar biyografisi
            $table->foreignId('blog_category_id')->constrained()->onDelete('cascade'); // Kategori ilişkisi
            $table->json('tags')->nullable(); // Etiketler (JSON format)
            $table->string('meta_title')->nullable(); // SEO başlık
            $table->text('meta_description')->nullable(); // SEO açıklama
            $table->string('reading_time')->default('5 dakika'); // Okuma süresi
            $table->unsignedInteger('views')->default(0); // Görüntülenme sayısı
            $table->boolean('is_featured')->default(false); // Öne çıkarılmış
            $table->boolean('is_published')->default(false); // Yayınlandı mı
            $table->timestamp('published_at')->nullable(); // Yayın tarihi
            $table->timestamps();
            
            // İndeksler - Performans için
            $table->index(['is_published', 'published_at']);
            $table->index('is_featured');
            $table->index('blog_category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
