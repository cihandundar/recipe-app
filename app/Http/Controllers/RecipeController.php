<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\RecipeCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    /**
     * Tarif listesi sayfasını göster - Tüm yayınlanmış tarifleri listele
     * MySQL veritabanından veri çekerek dark tema ile gösterir
     */
    public function index(Request $request)
    {
        // Tarif sorgusunu başlat
        $query = Recipe::with(['recipeCategory', 'user'])
            ->published()
            ->latest();

        // Kategori filtresi
        if ($request->has('category') && $request->category) {
            $query->whereHas('recipeCategory', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Zorluk filtresi
        if ($request->has('difficulty') && $request->difficulty) {
            $query->byDifficulty($request->difficulty);
        }

        // Arama
        if ($request->has('search') && $request->search) {
            $query->search($request->search);
        }

        // Sıralama
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'popular':
                $query->popular();
                break;
            case 'rating':
                $query->topRated();
                break;
            case 'oldest':
                $query->orderBy('published_at', 'asc');
                break;
            default:
                $query->latest();
        }

        // Sayfalama ile getir ve filtreleri query string'e ekle
        $recipes = $query->paginate(12)->appends($request->query());

        // Kategorileri getir (filtreleme için)
        $categories = RecipeCategory::active()->ordered()->get();

        return view('pages.recipes.index', compact('recipes', 'categories'));
    }

    /**
     * Arama fonksiyonu - Ajax ile çalışır
     */
    public function search(Request $request)
    {
        $searchTerm = $request->get('search');
        
        if (empty($searchTerm)) {
            return redirect()->route('recipes.index');
        }

        // Arama sonuçlarını getir
        $recipes = Recipe::with(['recipeCategory', 'user'])
            ->published()
            ->search($searchTerm)
            ->latest()
            ->paginate(12)
            ->appends(['search' => $searchTerm]);

        $categories = RecipeCategory::active()->ordered()->get();

        return view('pages.recipes.index', compact('recipes', 'categories'))
            ->with('searchTerm', $searchTerm);
    }

    /**
     * Tarif detay sayfasını göster
     * Slug ile tarifi bul ve görüntülenme sayısını artır
     */
    public function show($slug)
    {
        // Slug ile tarifi bul
        $recipe = Recipe::with(['recipeCategory', 'user', 'recipeIngredients', 'ratings.user'])
            ->where('slug', $slug)
            ->published()
            ->firstOrFail();

        // Görüntülenme sayısını artır
        $recipe->incrementViews();

        // İlgili tarifleri getir (aynı kategoriden)
        $relatedRecipes = Recipe::published()
            ->inCategory($recipe->recipe_category_id)
            ->where('id', '!=', $recipe->id)
            ->latest()
            ->limit(4)
            ->get();

        return view('pages.recipes.show', compact('recipe', 'relatedRecipes'));
    }

    /**
     * Yeni tarif ekleme formu
     * Sadece giriş yapmış kullanıcılar erişebilir
     */
    public function create()
    {
        // Kategorileri getir
        $categories = RecipeCategory::active()->ordered()->get();

        return view('pages.recipes.create', compact('categories'));
    }

    /**
     * Yeni tarifi veritabanına kaydet
     */
    public function store(Request $request)
    {
        // Form validasyonu
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'recipe_category_id' => 'required|exists:recipe_categories,id',
            'prep_time' => 'nullable|integer|min:1',
            'cook_time' => 'nullable|integer|min:1',
            'servings' => 'required|integer|min:1|max:20',
            'difficulty' => 'required|in:kolay,orta,zor',
            'ingredients' => 'required|array|min:1',
            'ingredients.*' => 'required|string',
            'instructions' => 'required|string|min:50',
            'chef_notes' => 'nullable|string|max:500',
            'tags' => 'nullable|string',
            'featured_image' => 'nullable|image|max:2048'
        ], [
            'title.required' => 'Tarif başlığı gereklidir.',
            'description.required' => 'Tarif açıklaması gereklidir.',
            'recipe_category_id.required' => 'Kategori seçimi gereklidir.',
            'ingredients.required' => 'En az bir malzeme eklemelisiniz.',
            'instructions.required' => 'Yapılış talimatları gereklidir.',
            'instructions.min' => 'Yapılış talimatları en az 50 karakter olmalıdır.'
        ]);

        // Slug oluştur
        $slug = Str::slug($validated['title']);
        $originalSlug = $slug;
        $counter = 1;
        
        // Eşsiz slug kontrolü
        while (Recipe::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        // Etiketleri işle
        $tags = [];
        if (!empty($validated['tags'])) {
            $tags = array_map('trim', explode(',', $validated['tags']));
        }

        // Toplam süreyi hesapla
        $totalTime = ($validated['prep_time'] ?: 0) + ($validated['cook_time'] ?: 0);

        // Görsel yükleme
        $featuredImage = null;
        if ($request->hasFile('featured_image')) {
            $featuredImage = $request->file('featured_image')->store('recipes', 'public');
        }

        // Tarifi oluştur
        $recipe = Recipe::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'description' => $validated['description'],
            'instructions' => $validated['instructions'],
            'ingredients' => $validated['ingredients'],
            'featured_image' => $featuredImage,
            'user_id' => Auth::id(),
            'recipe_category_id' => $validated['recipe_category_id'],
            'prep_time' => $validated['prep_time'],
            'cook_time' => $validated['cook_time'],
            'total_time' => $totalTime,
            'servings' => $validated['servings'],
            'difficulty' => $validated['difficulty'],
            'tags' => $tags,
            'chef_notes' => $validated['chef_notes'],
            'is_published' => true,
            'published_at' => now()
        ]);

        return redirect()->route('recipes.show', $recipe->slug)
            ->with('success', 'Tarifin başarıyla eklendi!');
    }

    /**
     * Tarif düzenleme formu
     */
    public function edit($slug)
    {
        $recipe = Recipe::where('slug', $slug)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $categories = RecipeCategory::active()->ordered()->get();

        return view('pages.recipes.edit', compact('recipe', 'categories'));
    }

    /**
     * Tarif güncelleme
     */
    public function update(Request $request, $slug)
    {
        $recipe = Recipe::where('slug', $slug)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Validation aynı store metodundaki gibi...
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'recipe_category_id' => 'required|exists:recipe_categories,id',
            'prep_time' => 'nullable|integer|min:1',
            'cook_time' => 'nullable|integer|min:1',
            'servings' => 'required|integer|min:1|max:20',
            'difficulty' => 'required|in:kolay,orta,zor',
            'ingredients' => 'required|array|min:1',
            'ingredients.*' => 'required|string',
            'instructions' => 'required|string|min:50',
            'chef_notes' => 'nullable|string|max:500',
            'tags' => 'nullable|string',
            'featured_image' => 'nullable|image|max:2048'
        ]);

        // Slug güncellemesi gerekiyorsa
        if ($recipe->title !== $validated['title']) {
            $slug = Str::slug($validated['title']);
            $originalSlug = $slug;
            $counter = 1;
            
            while (Recipe::where('slug', $slug)->where('id', '!=', $recipe->id)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }
            $recipe->slug = $slug;
        }

        // Güncelle
        $recipe->update($validated);

        return redirect()->route('recipes.show', $recipe->slug)
            ->with('success', 'Tarif başarıyla güncellendi!');
    }

    /**
     * Tarif silme
     */
    public function destroy($slug)
    {
        $recipe = Recipe::where('slug', $slug)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $recipe->delete();

        return redirect()->route('recipes.index')
            ->with('success', 'Tarif başarıyla silindi!');
    }
}
