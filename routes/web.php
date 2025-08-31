<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;

// Ana Sayfa
Route::get('/', [HomeController::class, 'index'])->name('home');

// Tarif Routes
Route::prefix('recipes')->name('recipes.')->group(function () {
    Route::get('/', [RecipeController::class, 'index'])->name('index');
    Route::get('/search', [RecipeController::class, 'search'])->name('search');
    Route::get('/create', [RecipeController::class, 'create'])->name('create')->middleware('auth');
    Route::post('/', [RecipeController::class, 'store'])->name('store')->middleware('auth');
    Route::get('/{recipe}', [RecipeController::class, 'show'])->name('show');
    Route::get('/{recipe}/edit', [RecipeController::class, 'edit'])->name('edit')->middleware('auth');
    Route::put('/{recipe}', [RecipeController::class, 'update'])->name('update')->middleware('auth');
    Route::delete('/{recipe}', [RecipeController::class, 'destroy'])->name('destroy')->middleware('auth');
});

// Kategori Routes - Kategori ile ilgili tüm route'lar burada tanımlanıyor
Route::prefix('categories')->name('category.')->group(function () {
    // Tüm kategorileri listeleyen sayfa - /categories
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    // Belirli bir kategorideki tarifleri gösteren sayfa - /categories/{category}
    Route::get('/{category}', [CategoryController::class, 'show'])->name('show');
});

// Kategori kısa route'ları - Header'da kullanılan özel kategori linkleri
Route::get('/categories', [CategoryController::class, 'index'])->name('categories'); // Ana kategoriler sayfası
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category'); // Kategori detay sayfası

// Blog Routes
Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/{post}', [BlogController::class, 'show'])->name('show');
});

// Dashboard (Breeze'den)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Kullanıcı Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/my-recipes', [UserController::class, 'myRecipes'])->name('my-recipes');
    Route::get('/favorites', [UserController::class, 'favorites'])->name('favorites');
    Route::post('/recipes/{recipe}/favorite', [UserController::class, 'toggleFavorite'])->name('toggle-favorite');
    
    // Profile Routes (Breeze'den)
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// İletişim Routes - İletişim sayfası ve form işlemleri
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::view('/about', 'pages.about')->name('about');

// Auth Routes (Breeze auth dosyası)
require __DIR__.'/auth.php';
