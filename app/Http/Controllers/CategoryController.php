<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Tüm kategorileri listeleyen ana sayfa
     * Ana kategoriler sayfasında tüm mevcut kategoriler gösterilir
     */
    public function index()
    {
        // Şimdilik statik kategoriler kullanıyoruz, daha sonra veritabanından çekilecek
        $categories = [
            [
                'name' => 'Ana Yemek',
                'slug' => 'ana-yemek',
                'description' => 'Nefis ana yemek tarifleri',
                'icon' => 'fas fa-utensils',
                'color' => 'primary',
                'recipe_count' => 25
            ],
            [
                'name' => 'Tatlı',
                'slug' => 'tatli',
                'description' => 'Lâl ettiren tatlı tarifleri',
                'icon' => 'fas fa-birthday-cake',
                'color' => 'danger',
                'recipe_count' => 18
            ],
            [
                'name' => 'Çorba',
                'slug' => 'corba',
                'description' => 'Işıtan çorba tarifleri',
                'icon' => 'fas fa-bowl-hot',
                'color' => 'warning',
                'recipe_count' => 12
            ],
            [
                'name' => 'Salata',
                'slug' => 'salata',
                'description' => 'Sağlıklı salata tarifleri',
                'icon' => 'fas fa-leaf',
                'color' => 'success',
                'recipe_count' => 15
            ],
            [
                'name' => 'İçecek',
                'slug' => 'icecek',
                'description' => 'Serinleten içecek tarifleri',
                'icon' => 'fas fa-glass-whiskey',
                'color' => 'info',
                'recipe_count' => 8
            ],
            [
                'name' => 'Aperitif',
                'slug' => 'aperitif',
                'description' => 'Lezzetli aperitif tarifleri',
                'icon' => 'fas fa-cheese',
                'color' => 'secondary',
                'recipe_count' => 10
            ]
        ];

        // Kategoriler sayfasını döndür
        return view('pages.categories', compact('categories'));
    }

    /**
     * Belirli bir kategoriye ait tarifleri gösteren sayfa
     * URL'den gelen kategori slug'ina göre o kategorideki tarifleri listeler
     */
    public function show($categorySlug)
    {
        // Şimdilik statik kategori bilgisi kullanıyoruz
        $categoryNames = [
            'ana-yemek' => 'Ana Yemek',
            'tatli' => 'Tatlı',
            'corba' => 'Çorba',
            'salata' => 'Salata',
            'icecek' => 'İçecek',
            'aperitif' => 'Aperitif'
        ];

        // Eğer kategori bulunamazsa 404 hatası ver
        if (!isset($categoryNames[$categorySlug])) {
            abort(404, 'Kategori bulunamadı');
        }

        $categoryName = $categoryNames[$categorySlug];
        
        // Şimdilik örnek tarifler oluşturuyoruz, sonra veritabanından çekilecek
        $recipes = [];
        
        // Kategori tipine göre ikon seçimi
        $categoryIcons = [
            'ana-yemek' => 'fas fa-drumstick-bite',
            'tatli' => 'fas fa-birthday-cake', 
            'corba' => 'fas fa-bowl-hot',
            'salata' => 'fas fa-leaf',
            'icecek' => 'fas fa-coffee',
            'aperitif' => 'fas fa-cheese'
        ];
        
        $categoryIcon = $categoryIcons[$categorySlug] ?? 'fas fa-utensils';
        
        for ($i = 1; $i <= 8; $i++) {
            $recipes[] = [
                'id' => $i,
                'title' => $categoryName . ' Tarifi ' . $i,
                'description' => 'Bu harika ' . strtolower($categoryName) . ' tarifinde nefis lezzetler sizleri bekliyor...',
                'image' => null, // Artik ikon kullanacagız
                'icon' => $categoryIcon, // İkon bilgisi eklendi
                'prep_time' => rand(15, 60) . ' dk',
                'rating' => number_format(rand(30, 50) / 10, 1),
                'author' => 'Chef ' . ['Ali', 'Ayşe', 'Mehmet', 'Fatma', 'Ahmet', 'Zeynep'][rand(0, 5)],
                'created_at' => now()->subDays(rand(1, 30))
            ];
        }

        // Kategori detay sayfasını döndür
        return view('pages.category-detail', compact('categoryName', 'categorySlug', 'recipes'));
    }
}
