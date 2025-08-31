<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class BlogPost extends Model
{
    /**
     * Blog yazısı modeli - Blog içeriklerini yönetir
     */
    
    protected $fillable = [
        'title',
        'slug',
        'excerpt', 
        'content',
        'featured_image',
        'author_name',
        'author_title',
        'author_bio',
        'blog_category_id',
        'tags',
        'meta_title',
        'meta_description',
        'reading_time',
        'views',
        'is_featured',
        'is_published',
        'published_at'
    ];

    protected $casts = [
        'tags' => 'array',
        'views' => 'integer',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime'
    ];

    /**
     * Bu yazının kategorisi
     */
    public function blogCategory(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class);
    }

    /**
     * Yayinılanmış yazıları getir
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                     ->where('published_at', '<=', now());
    }

    /**
     * Öne çıkan yazıları getir
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Son yazıları getir
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('published_at', 'desc');
    }

    /**
     * Popüler yazıları getir (görüntülenme sayısına göre)
     */
    public function scopePopular($query)
    {
        return $query->orderBy('views', 'desc');
    }

    /**
     * Belirli kategorideki yazıları getir
     */
    public function scopeInCategory($query, $categoryId)
    {
        return $query->where('blog_category_id', $categoryId);
    }

    /**
     * Arama yap (başlık, özet ve içerikte)
     */
    public function scopeSearch($query, $term)
    {
        return $query->where(function($q) use ($term) {
            $q->where('title', 'like', "%{$term}%")
              ->orWhere('excerpt', 'like', "%{$term}%")
              ->orWhere('content', 'like', "%{$term}%");
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
     * Yayın tarihini formatlı olarak getir
     */
    public function getFormattedPublishedAtAttribute()
    {
        return $this->published_at ? $this->published_at->format('d M Y') : null;
    }

    /**
     * Özet metni kısalt
     */
    public function getShortExcerptAttribute($length = 150)
    {
        return strlen($this->excerpt) > $length 
            ? substr($this->excerpt, 0, $length) . '...' 
            : $this->excerpt;
    }

    /**
     * İlgili yazıları getir (aynı kategoriden)
     */
    public function getRelatedPostsAttribute($limit = 3)
    {
        return static::published()
            ->inCategory($this->blog_category_id)
            ->where('id', '!=', $this->id)
            ->latest()
            ->limit($limit)
            ->get();
    }

    /**
     * SEO başlığı - yoksa normal başlık kullan
     */
    public function getSeoTitleAttribute()
    {
        return $this->meta_title ?: $this->title;
    }

    /**
     * SEO açıklaması - yoksa özet kullan
     */
    public function getSeoDescriptionAttribute()
    {
        return $this->meta_description ?: $this->excerpt;
    }
}
