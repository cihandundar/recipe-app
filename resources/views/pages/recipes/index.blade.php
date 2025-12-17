{{-- Tarifler ana sayfası - Dark tema ile turuncu vurgu renkleri --}}
@extends('layouts.app')

@section('title', 'Tarifler - Tarif Dünyası')

@section('content')
{{-- Tarifler ana sayfası container --}}
<div class="recipes-page">
    {{-- Tarifler başlık bölümü - Hero section --}}
    <div class="recipes-header py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="header-content">
                        <h1 class="display-4 fw-bold text-white mb-4">
                            <i class="fas fa-utensils me-3"></i>Tarifler
                        </h1>
                        <p class="lead text-light mb-4">
                            Binlerce nefis tarif keşfedin, kendi tariflerinizi paylaşın ve mutfakta yeni deneyimler yaşayın!
                        </p>
                        <div class="recipes-stats row g-3 justify-content-center">
                            <div class="col-md-4">
                                <div class="stat-card">
                                    <i class="fas fa-book-open fa-2x text-primary mb-2"></i>
                                    <h5 class="text-white">{{ $recipes->total() }}+ Tarif</h5>
                                    <p class="text-muted small">Lezzetli Tarifler</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stat-card">
                                    <i class="fas fa-folder fa-2x text-primary mb-2"></i>
                                    <h5 class="text-white">{{ count($categories) }} Kategori</h5>
                                    <p class="text-muted small">Farklı Kategoriler</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stat-card">
                                    <i class="fas fa-star fa-2x text-primary mb-2"></i>
                                    <h5 class="text-white">En İyi Tarifler</h5>
                                    <p class="text-muted small">Yüksek Puanlı</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Arama ve filtre bölümü --}}
    <div class="filters-section py-4 border-bottom border-secondary">
        <div class="container">
            <form action="{{ route('recipes.index') }}" method="GET" class="row g-3">
                {{-- Arama kutusu --}}
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-dark border-secondary text-white">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" 
                               class="form-control bg-dark border-secondary text-white" 
                               name="search" 
                               placeholder="Tarif ara..." 
                               value="{{ request('search') }}">
                    </div>
                </div>

                {{-- Kategori filtresi --}}
                <div class="col-md-3">
                    <select name="category" class="form-select bg-dark border-secondary text-white">
                        <option value="">Tüm Kategoriler</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Zorluk filtresi --}}
                <div class="col-md-2">
                    <select name="difficulty" class="form-select bg-dark border-secondary text-white">
                        <option value="">Tüm Zorluklar</option>
                        <option value="kolay" {{ request('difficulty') == 'kolay' ? 'selected' : '' }}>Kolay</option>
                        <option value="orta" {{ request('difficulty') == 'orta' ? 'selected' : '' }}>Orta</option>
                        <option value="zor" {{ request('difficulty') == 'zor' ? 'selected' : '' }}>Zor</option>
                    </select>
                </div>

                {{-- Sıralama --}}
                <div class="col-md-2">
                    <select name="sort" class="form-select bg-dark border-secondary text-white">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>En Yeni</option>
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Popüler</option>
                        <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>En Çok Beğenilen</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>En Eski</option>
                    </select>
                </div>

                {{-- Filtrele butonu --}}
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-filter"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Ana içerik bölümü --}}
    <div class="recipes-content py-5">
        <div class="container">
            <div class="row">
                {{-- Sol taraf - Tarif listesi --}}
                <div class="col-lg-9">
                    {{-- Öne çıkan tarifler --}}
                    @php
                        $featuredRecipes = $recipes->where('is_featured', true);
                    @endphp
                    
                    @if($featuredRecipes->count() > 0)
                        <div class="featured-recipes mb-5">
                            <h2 class="section-title mb-4">
                                <i class="fas fa-star me-2 text-warning"></i>
                                Öne Çıkan Tarifler
                            </h2>
                            <div class="row g-4">
                                @foreach($featuredRecipes->take(2) as $recipe)
                                    <div class="col-md-6">
                                        <article class="featured-recipe-card h-100">
                                            <div class="recipe-image">
                                                @if($recipe->featured_image)
                                                    <img src="{{ $recipe->featured_image }}" alt="{{ $recipe->title }}" class="img-fluid">
                                                @else
                                                    <div class="placeholder-image">
                                                        <i class="fas fa-utensils fa-3x text-primary"></i>
                                                    </div>
                                                @endif
                                                <div class="recipe-badge">
                                                    <span class="badge bg-warning text-dark">
                                                        <i class="fas fa-star me-1"></i>Öne Çıkan
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="recipe-content">
                                                <div class="recipe-meta mb-2">
                                                    <span class="category-tag" style="color: {{ $recipe->recipeCategory->color ?? '#ff6b35' }};">
                                                        <i class="{{ $recipe->recipeCategory->icon ?? 'fas fa-tag' }} me-1"></i>
                                                        {{ $recipe->recipeCategory->name }}
                                                    </span>
                                                    <span class="text-muted mx-2">•</span>
                                                    <span class="text-muted">{{ $recipe->published_at ? $recipe->published_at->format('d M Y') : '' }}</span>
                                                </div>
                                                <h3 class="recipe-title">
                                                    <a href="{{ route('recipes.show', $recipe->slug) }}" class="text-decoration-none">
                                                        {{ $recipe->title }}
                                                    </a>
                                                </h3>
                                                <p class="recipe-description text-muted">{{ Str::limit($recipe->description, 100) }}</p>
                                                <div class="recipe-footer">
                                                    <div class="recipe-stats">
                                                        <span class="text-muted">
                                                            <i class="fas fa-clock me-1"></i>{{ $recipe->total_time ?? ($recipe->prep_time + $recipe->cook_time) }} dk
                                                        </span>
                                                        <span class="text-muted ms-3">
                                                            <i class="fas fa-users me-1"></i>{{ $recipe->servings }} kişi
                                                        </span>
                                                        <span class="text-muted ms-3">
                                                            <i class="fas fa-star me-1 text-warning"></i>{{ number_format($recipe->rating, 1) }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Tüm tarifler --}}
                    <div class="all-recipes">
                        <h2 class="section-title mb-4">
                            <i class="fas fa-list me-2 text-primary"></i>
                            Tüm Tarifler
                        </h2>
                        
                        @if($recipes->count() > 0)
                            <div class="recipes-grid">
                                @foreach($recipes as $recipe)
                                    <article class="recipe-card mb-4">
                                        <div class="row g-0">
                                            <div class="col-md-4">
                                                <div class="recipe-image">
                                                    @if($recipe->featured_image)
                                                        <img src="{{ $recipe->featured_image }}" alt="{{ $recipe->title }}" class="img-fluid">
                                                    @else
                                                        <div class="placeholder-image">
                                                            <i class="fas fa-utensils fa-2x text-primary"></i>
                                                        </div>
                                                    @endif
                                                    @if($recipe->is_featured)
                                                        <div class="recipe-badge">
                                                            <span class="badge bg-warning text-dark">
                                                                <i class="fas fa-star me-1"></i>Öne Çıkan
                                                            </span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="recipe-content">
                                                    <div class="recipe-meta mb-2">
                                                        <span class="category-tag" style="color: {{ $recipe->recipeCategory->color ?? '#ff6b35' }};">
                                                            <i class="{{ $recipe->recipeCategory->icon ?? 'fas fa-tag' }} me-1"></i>
                                                            {{ $recipe->recipeCategory->name }}
                                                        </span>
                                                        <span class="text-muted mx-2">•</span>
                                                        <span class="text-muted">{{ $recipe->published_at ? $recipe->published_at->format('d M Y') : '' }}</span>
                                                    </div>
                                                    <h3 class="recipe-title">
                                                        <a href="{{ route('recipes.show', $recipe->slug) }}" class="text-decoration-none">
                                                            {{ $recipe->title }}
                                                        </a>
                                                    </h3>
                                                    <p class="recipe-description text-muted">{{ Str::limit($recipe->description, 120) }}</p>
                                                    <div class="recipe-footer">
                                                        <div class="recipe-stats">
                                                            <span class="text-muted">
                                                                <i class="fas fa-clock me-1"></i>{{ $recipe->total_time ?? ($recipe->prep_time + $recipe->cook_time) }} dk
                                                            </span>
                                                            <span class="text-muted ms-3">
                                                                <i class="fas fa-users me-1"></i>{{ $recipe->servings }} kişi
                                                            </span>
                                                            <span class="text-muted ms-3">
                                                                <i class="fas fa-signal me-1"></i>{{ ucfirst($recipe->difficulty) }}
                                                            </span>
                                                            <span class="text-muted ms-3">
                                                                <i class="fas fa-star me-1 text-warning"></i>{{ number_format($recipe->rating, 1) }}
                                                            </span>
                                                            <span class="text-muted ms-3">
                                                                <i class="fas fa-eye me-1"></i>{{ number_format($recipe->views) }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <a href="{{ route('recipes.show', $recipe->slug) }}" class="btn btn-outline-primary btn-sm mt-3">
                                                        <i class="fas fa-arrow-right me-2"></i>Tarifi Gör
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-info text-center">
                                <i class="fas fa-info-circle me-2"></i>
                                Aradığınız kriterlere uygun tarif bulunamadı.
                            </div>
                        @endif
                    </div>

                    {{-- Sayfalama --}}
                    @if($recipes->hasPages())
                        <div class="pagination-wrapper mt-5">
                            {{ $recipes->links() }}
                        </div>
                    @endif
                </div>

                {{-- Sağ taraf - Sidebar --}}
                <div class="col-lg-3">
                    <div class="recipes-sidebar">
                        {{-- Kategoriler widget --}}
                        <div class="widget categories-widget mb-4">
                            <h4 class="widget-title">
                                <i class="fas fa-folder me-2 text-primary"></i>
                                Kategoriler
                            </h4>
                            <div class="widget-content">
                                @foreach($categories as $category)
                                    <a href="{{ route('recipes.index', ['category' => $category->slug]) }}" class="category-item">
                                        <i class="fas fa-tag me-2" style="color: {{ $category->color ?? '#ff6b35' }};"></i>
                                        {{ $category->name }}
                                        <span class="recipe-count">{{ $category->published_recipes_count }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        {{-- Yeni tarif ekle widget --}}
                        @auth
                        <div class="widget add-recipe-widget mb-4">
                            <h4 class="widget-title">
                                <i class="fas fa-plus me-2 text-primary"></i>
                                Tarifinizi Paylaşın
                            </h4>
                            <div class="widget-content text-center">
                                <p class="text-muted">Kendi tarifinizi ekleyerek topluluğa katkıda bulunun!</p>
                                <a href="{{ route('recipes.create') }}" class="btn btn-primary w-100">
                                    <i class="fas fa-plus me-2"></i>Tarif Ekle
                                </a>
                            </div>
                        </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-css')
<style>
/* Tarifler sayfası özel stilleri */
.recipes-header {
    background: linear-gradient(135deg, #1a1a1a 0%, #ff6b35 100%);
}

.stat-card {
    padding: 1.5rem;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 10px;
    transition: transform 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    background: rgba(255, 255, 255, 0.15);
}

.section-title {
    color: var(--text-light);
    font-weight: bold;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid var(--primary-color);
}

.featured-recipe-card,
.recipe-card {
    background-color: var(--dark-card);
    border: 1px solid var(--border-dark);
    border-radius: 10px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.featured-recipe-card:hover,
.recipe-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(255, 107, 53, 0.2);
}

.recipe-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.recipe-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.placeholder-image {
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, var(--dark-secondary) 0%, var(--dark-card) 100%);
}

.recipe-badge {
    position: absolute;
    top: 10px;
    right: 10px;
}

.recipe-content {
    padding: 1.5rem;
}

.recipe-meta {
    font-size: 0.875rem;
}

.category-tag {
    font-weight: 500;
}

.recipe-title {
    margin-bottom: 0.75rem;
}

.recipe-title a {
    color: var(--text-light);
    transition: color 0.3s ease;
}

.recipe-title a:hover {
    color: var(--primary-color);
}

.recipe-description {
    font-size: 0.9rem;
    margin-bottom: 1rem;
}

.recipe-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 1rem;
}

.recipe-stats {
    font-size: 0.875rem;
}

/* Sidebar stilleri */
.widget {
    background-color: var(--dark-card);
    border: 1px solid var(--border-dark);
    border-radius: 10px;
    padding: 1.5rem;
}

.widget-title {
    color: var(--text-light);
    font-weight: bold;
    margin-bottom: 1rem;
    padding-bottom: 0.75rem;
    border-bottom: 2px solid var(--border-dark);
}

.category-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0.75rem 0;
    color: var(--text-light);
    text-decoration: none;
    border-bottom: 1px solid var(--border-dark);
    transition: color 0.3s ease;
}

.category-item:last-child {
    border-bottom: none;
}

.category-item:hover {
    color: var(--primary-color);
}

.recipe-count {
    background-color: var(--dark-secondary);
    color: var(--primary-color);
    padding: 0.25rem 0.5rem;
    border-radius: 15px;
    font-size: 0.75rem;
    font-weight: bold;
}

/* Form stilleri */
.form-select,
.form-control {
    background-color: var(--dark-secondary);
    border-color: var(--border-dark);
    color: var(--text-light);
}

.form-select:focus,
.form-control:focus {
    background-color: var(--dark-secondary);
    border-color: var(--primary-color);
    color: var(--text-light);
    box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25);
}

.input-group-text {
    background-color: var(--dark-secondary);
    border-color: var(--border-dark);
}
</style>
@endsection
