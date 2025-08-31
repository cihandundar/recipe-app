<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BlogCategory extends Model
{
    /**
     * Blog kategorisi modeli - Blog yazılarının kategorizasyonu için
     */
    
    protected $fillable = [
        'name',
        'slug', 
        'description',
        'color',
        'icon',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    /**
     * Bu kategoriye ait blog yazılarını getir
     */
    public function blogPosts(): HasMany
    {
        return $this->hasMany(BlogPost::class);
    }

    /**
     * Aktif kategorileri getir
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Sıralanmış kategorileri getir
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('name', 'asc');
    }

    /**
     * Kategori rengi için CSS sınıfı oluştur
     */
    public function getColorStyleAttribute()
    {
        return "background-color: {$this->color}; color: white;";
    }

    /**
     * Bu kategorideki yayınlanmış yazı sayısı
     */
    public function getPublishedPostsCountAttribute()
    {
        return $this->blogPosts()->where('is_published', true)->count();
    }
}
