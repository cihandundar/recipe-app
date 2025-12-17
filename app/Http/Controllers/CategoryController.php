<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RecipeCategory;
use App\Models\Recipe;

class CategoryController extends Controller
{
    /**
     * Tüm kategorileri listeleyen ana sayfa
     * Ana kategoriler sayfasında tüm mevcut kategoriler gösterilir
     */
    public function index()
    {
        // Veritabanından aktif kategorileri çek
        $categories = RecipeCategory::active()->ordered()->get();
        
        // Kategoriler için görünüm formatına dönüştür
        $categoriesFormatted = $categories->map(function($category) {
            return [
                'id' => $category->id,
                'name' => $category->name,
                'slug' => $category->slug,
                'description' => $category->description,
                'icon' => $category->icon ?? 'fas fa-utensils',
                'color' => $this->getColorClass($category->color ?? '#ff6b35'),
                'recipe_count' => $category->published_recipes_count
            ];
        })->toArray();

        // Kategoriler sayfasını döndür
        return view('pages.categories', ['categories' => $categoriesFormatted]);
    }

    /**
     * Belirli bir kategoriye ait tarifleri gösteren sayfa
     * URL'den gelen kategori slug'ina göre o kategorideki tarifleri listeler
     */
    public function show($categorySlug)
    {
        // Veritabanından kategoriyi bul
        $category = RecipeCategory::where('slug', $categorySlug)
            ->where('is_active', true)
            ->firstOrFail();

        // Bu kategoriye ait yayınlanmış tarifleri çek (sayfalama ile)
        $recipes = Recipe::with(['recipeCategory', 'user'])
            ->published()
            ->where('recipe_category_id', $category->id)
            ->latest()
            ->paginate(12);

        // Kategori detay sayfasını döndür
        return view('pages.category-detail', compact('category', 'recipes'));
    }

    /**
     * Renk kodunu Bootstrap color class'ına dönüştür
     */
    private function getColorClass($color)
    {
        $colorMap = [
            '#ff6b35' => 'primary',
            '#e83e8c' => 'danger',
            '#17a2b8' => 'info',
            '#28a745' => 'success',
            '#ffc107' => 'warning',
            '#6c757d' => 'secondary',
        ];

        // Renk kodunu normalize et (büyük/küçük harf farkını kaldır)
        $normalizedColor = strtolower($color);
        
        return $colorMap[$normalizedColor] ?? 'primary';
    }
}
