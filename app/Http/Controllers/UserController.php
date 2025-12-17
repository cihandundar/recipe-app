<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Kullanıcı profil sayfası
     */
    public function profile()
    {
        $user = Auth::user();
        $totalRecipes = $user->recipes()->count();
        $publishedRecipes = $user->recipes()->where('is_published', true)->count();
        $totalViews = $user->recipes()->sum('views');
        $recentRecipes = $user->recipes()->latest()->limit(5)->get();

        return view('pages.profile', compact('user', 'totalRecipes', 'publishedRecipes', 'totalViews', 'recentRecipes'));
    }

    /**
     * Kullanıcının tarifleri
     */
    public function myRecipes(Request $request)
    {
        $user = Auth::user();
        
        $query = $user->recipes()->with(['recipeCategory'])->latest();

        // Filtreleme
        if ($request->has('status')) {
            if ($request->status == 'published') {
                $query->where('is_published', true);
            } elseif ($request->status == 'draft') {
                $query->where('is_published', false);
            }
        }

        // Arama
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $recipes = $query->paginate(12)->appends($request->query());

        return view('pages.my-recipes', compact('recipes'));
    }

    /**
     * Kullanıcının favorileri
     */
    public function favorites()
    {
        $user = Auth::user();
        
        $recipes = $user->favoriteRecipes()
            ->with(['recipeCategory', 'user'])
            ->published()
            ->latest()
            ->paginate(12);

        return view('pages.favorites', compact('recipes'));
    }

    /**
     * Favorilere ekle/çıkar
     */
    public function toggleFavorite($recipe)
    {
        $user = Auth::user();
        $recipe = Recipe::findOrFail($recipe);
        
        // Favorilerde var mı kontrol et
        $isFavorited = $user->favoriteRecipes()->where('recipe_id', $recipe->id)->exists();
        
        if ($isFavorited) {
            // Favorilerden çıkar
            $user->favoriteRecipes()->detach($recipe->id);
            $recipe->decrementFavorites();
            $message = 'Tarif favorilerden çıkarıldı.';
            $type = 'success';
        } else {
            // Favorilere ekle
            $user->favoriteRecipes()->attach($recipe->id);
            $recipe->incrementFavorites();
            $message = 'Tarif favorilere eklendi!';
            $type = 'success';
        }
        
        return back()->with($type, $message);
    }
}
