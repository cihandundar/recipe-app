<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Carbon\Carbon;

class Recipe extends Model
{
    /**
     * Tarif modeli - Tarif içeriklerini yönetir
     */
    
    protected $fillable = [
        'title',
        'slug',
        'description', 
        'instructions',
        'ingredients',
        'featured_image',
        'gallery_images',
        'user_id',
        'recipe_category_id',
        'prep_time',
        'cook_time',
        'total_time',
        'servings',
        'difficulty',
        'tags',
        'chef_notes',
        'nutrition_info',
        'rating',
        'rating_count',
        'views',
        'favorites_count',
        'is_featured',
        'is_published',
        'published_at'
    ];

    protected $casts = [
        'ingredients' => 'array',
        'gallery_images' => 'array',
        'tags' => 'array',
        'prep_time' => 'integer',
        'cook_time' => 'integer',
        'total_time' => 'integer',
        'servings' => 'integer',
        'rating' => 'decimal:2',
        'rating_count' => 'integer',
        'views' => 'integer',
        'favorites_count' => 'integer',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime'
    ];

    /**
     * Bu tarifin kategorisi
     */
    public function recipeCategory(): BelongsTo
    {
        return $this->belongsTo(RecipeCategory::class);
    }

    /**
     * Bu tarifi ekleyen kullanıcı
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Bu tarifin malzemeleri
     */
    public function recipeIngredients(): HasMany
    {
        return $this->hasMany(RecipeIngredient::class)->orderBy('sort_order');
    }

    /**
     * Bu tarifin puanları
     */
    public function ratings(): HasMany
    {
        return $this->hasMany(RecipeRating::class);
    }

    /**
     * Bu tarifi favorilere ekleyen kullanıcılar
     */
    public function favoritedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'recipe_favorites')
                    ->withTimestamps();
    }

    /**
     * Yayınlanmış tarifleri getir
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                     ->where('published_at', '<=', now());
    }

    /**
     * Öne çıkan tarifleri getir
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Son tarifleri getir
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('published_at', 'desc');
    }

    /**
     * Popüler tarifleri getir (görüntülenme sayısına göre)
     */
    public function scopePopular($query)
    {
        return $query->orderBy('views', 'desc');
    }

    /**
     * En yüksek puanlı tarifleri getir
     */
    public function scopeTopRated($query)
    {
        return $query->orderBy('rating', 'desc');
    }

    /**
     * Belirli kategorideki tarifleri getir
     */
    public function scopeInCategory($query, $categoryId)
    {
        return $query->where('recipe_category_id', $categoryId);
    }

    /**
     * Zorluk seviyesine göre filtrele
     */
    public function scopeByDifficulty($query, $difficulty)
    {
        return $query->where('difficulty', $difficulty);
    }

    /**
     * Arama yap (başlık, açıklama ve malzemelerde)
     */
    public function scopeSearch($query, $term)
    {
        return $query->where(function($q) use ($term) {
            $q->where('title', 'like', "%{$term}%")
              ->orWhere('description', 'like', "%{$term}%")
              ->orWhere('instructions', 'like', "%{$term}%")
              ->orWhereJsonContains('ingredients', $term);
        });
    }

    /**
     * Görüntülenme sayısını artır
     */
    public function incrementViews()
    {
        $this->increment('views');
    }

    /**
     * Favorilere eklenme sayısını artır
     */
    public function incrementFavorites()
    {
        $this->increment('favorites_count');
    }

    /**
     * Favorilere eklenme sayısını azalt
     */
    public function decrementFavorites()
    {
        $this->decrement('favorites_count');
    }

    /**
     * Yayın tarihini formatlı olarak getir
     */
    public function getFormattedPublishedAtAttribute()
    {
        return $this->published_at ? $this->published_at->format('d M Y') : null;
    }

    /**
     * Toplam süreyi hesapla (hazırlama + pişirme)
     */
    public function getCalculatedTotalTimeAttribute()
    {
        return ($this->prep_time ?: 0) + ($this->cook_time ?: 0);
    }

    /**
     * Süreyi güzel formatta göster
     */
    public function getFormattedTotalTimeAttribute()
    {
        $total = $this->calculated_total_time;
        if ($total < 60) {
            return $total . ' dakika';
        }
        $hours = floor($total / 60);
        $minutes = $total % 60;
        return $hours . ' saat' . ($minutes > 0 ? ' ' . $minutes . ' dakika' : '');
    }

    /**
     * Zorluk seviyesini Türkçe olarak getir
     */
    public function getDifficultyLabelAttribute()
    {
        $labels = [
            'kolay' => 'Kolay',
            'orta' => 'Orta',
            'zor' => 'Zor'
        ];
        return $labels[$this->difficulty] ?? 'Orta';
    }

    /**
     * Puan yıldızları için HTML getir
     */
    public function getRatingStarsAttribute()
    {
        $fullStars = floor($this->rating);
        $hasHalfStar = ($this->rating - $fullStars) >= 0.5;
        $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);
        
        $html = '';
        
        // Dolu yıldızlar
        for ($i = 0; $i < $fullStars; $i++) {
            $html .= '<i class="fas fa-star text-warning"></i>';
        }
        
        // Yarım yıldız
        if ($hasHalfStar) {
            $html .= '<i class="fas fa-star-half-alt text-warning"></i>';
        }
        
        // Boş yıldızlar
        for ($i = 0; $i < $emptyStars; $i++) {
            $html .= '<i class="far fa-star text-warning"></i>';
        }
        
        return $html;
    }

    /**
     * İlgili tarifleri getir (aynı kategoriden)
     */
    public function getRelatedRecipesAttribute($limit = 4)
    {
        return static::published()
            ->inCategory($this->recipe_category_id)
            ->where('id', '!=', $this->id)
            ->latest()
            ->limit($limit)
            ->get();
    }
}
