<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RecipeCategory extends Model
{
    /**
     * Tarif kategorisi modeli - Tariflerin kategorizasyonu için
     */
    
    protected $fillable = [
        'name',
        'slug', 
        'description',
        'color',
        'icon',
        'featured_image',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    /**
     * Bu kategoriye ait tarifleri getir
     */
    public function recipes(): HasMany
    {
        return $this->hasMany(Recipe::class);
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
     * Bu kategorideki yayınlanmış tarif sayısı
     */
    public function getPublishedRecipesCountAttribute()
    {
        return $this->recipes()->where('is_published', true)->count();
    }

    /**
     * Kategori görseli varsa URL, yoksa placeholder ikon
     */
    public function getImageOrIconAttribute()
    {
        return $this->featured_image ?: $this->icon;
    }
}
