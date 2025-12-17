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
     * Not: Favoriler sistemi henüz tam implement edilmedi
     */
    public function favorites()
    {
        // Şimdilik boş liste döndürüyoruz
        // Favoriler için pivot tablo oluşturulduğunda bu metod güncellenecek
        $recipes = collect([]);

        return view('pages.favorites', compact('recipes'));
    }

    /**
     * Favorilere ekle/çıkar
     * Not: Favoriler sistemi henüz tam implement edilmedi
     */
    public function toggleFavorite($recipe)
    {
        // Şimdilik basit bir mesaj döndürüyoruz
        // Favoriler için pivot tablo oluşturulduğunda bu metod güncellenecek
        
        $recipe = Recipe::findOrFail($recipe);
        
        return back()->with('info', 'Favoriler özelliği yakında eklenecek!');
    }
}
