{{-- Tarif detay sayfası - Dark tema ile tasarlandı --}}
@extends('layouts.app')

@section('title', $recipe->title . ' - Tarif Dünyası')

@section('content')
{{-- Tarif detay sayfası container --}}
<div class="recipe-detail-page">
    {{-- Breadcrumb --}}
    <div class="breadcrumb-section py-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-decoration-none">
                            <i class="fas fa-home me-1"></i>Ana Sayfa
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('recipes.index') }}" class="text-decoration-none">Tarifler</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('recipes.index', ['category' => $recipe->recipeCategory->slug]) }}" class="text-decoration-none">
                            {{ $recipe->recipeCategory->name }}
                        </a>
                    </li>
                    <li class="breadcrumb-item active text-primary" aria-current="page">
                        {{ $recipe->title }}
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container py-5">
        <div class="row">
            {{-- Sol taraf - Tarif içeriği --}}
            <div class="col-lg-8">
                <article class="recipe-article">
                    {{-- Tarif başlığı ve meta bilgileri --}}
                    <header class="recipe-header mb-4">
                        <div class="recipe-meta mb-3">
                            <span class="category-badge" style="color: {{ $recipe->recipeCategory->color ?? '#ff6b35' }};">
                                <i class="{{ $recipe->recipeCategory->icon ?? 'fas fa-tag' }} me-1"></i>
                                {{ $recipe->recipeCategory->name }}
                            </span>
                            <span class="text-muted mx-3">•</span>
                            <span class="publish-date text-muted">
                                <i class="fas fa-calendar me-1"></i>
                                {{ $recipe->published_at ? $recipe->published_at->format('d M Y') : '' }}
                            </span>
                            @if($recipe->total_time || ($recipe->prep_time && $recipe->cook_time))
                            <span class="text-muted mx-3">•</span>
                            <span class="prep-time text-muted">
                                <i class="fas fa-clock me-1"></i>
                                {{ $recipe->total_time ?? ($recipe->prep_time + $recipe->cook_time) }} dk
                            </span>
                            @endif
                        </div>
                        
                        <h1 class="recipe-title text-white mb-4">{{ $recipe->title }}</h1>
                        
                        <div class="recipe-stats-section">
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                                <div class="recipe-basic-info d-flex gap-4">
                                    @if($recipe->servings)
                                    <div class="stat-item">
                                        <i class="fas fa-users text-primary me-2"></i>
                                        <span class="text-muted">{{ $recipe->servings }} kişilik</span>
                                    </div>
                                    @endif
                                    @if($recipe->difficulty)
                                    <div class="stat-item">
                                        <i class="fas fa-signal text-primary me-2"></i>
                                        <span class="text-muted">{{ ucfirst($recipe->difficulty) }}</span>
                                    </div>
                                    @endif
                                    @if($recipe->rating > 0)
                                    <div class="stat-item">
                                        <i class="fas fa-star text-warning me-2"></i>
                                        <span class="text-muted">{{ number_format($recipe->rating, 1) }} ({{ $recipe->rating_count }} değerlendirme)</span>
                                    </div>
                                    @endif
                                </div>
                                <div class="recipe-views">
                                    <i class="fas fa-eye text-primary me-1"></i>
                                    <span class="text-muted">{{ number_format($recipe->views) }} görüntüleme</span>
                                </div>
                            </div>
                        </div>
                    </header>

                    {{-- Öne çıkan görsel --}}
                    <div class="featured-image mb-5">
                        @if($recipe->featured_image)
                            <img src="{{ $recipe->featured_image }}" alt="{{ $recipe->title }}" class="img-fluid rounded">
                        @else
                            <div class="placeholder-featured-image">
                                <i class="fas fa-utensils fa-5x text-primary"></i>
                                <p class="text-muted mt-3">{{ $recipe->title }}</p>
                            </div>
                        @endif
                    </div>

                    {{-- Tarif açıklaması --}}
                    @if($recipe->description)
                    <div class="recipe-description mb-5">
                        <p class="lead text-white">{{ $recipe->description }}</p>
                    </div>
                    @endif

                    {{-- Tarif bilgileri kartı --}}
                    <div class="recipe-info-cards mb-5">
                        <div class="row g-3">
                            @if($recipe->prep_time)
                            <div class="col-md-3 col-6">
                                <div class="info-card text-center p-3">
                                    <i class="fas fa-stopwatch fa-2x text-primary mb-2"></i>
                                    <h6 class="text-white mb-1">Hazırlık</h6>
                                    <p class="text-muted mb-0">{{ $recipe->prep_time }} dk</p>
                                </div>
                            </div>
                            @endif
                            @if($recipe->cook_time)
                            <div class="col-md-3 col-6">
                                <div class="info-card text-center p-3">
                                    <i class="fas fa-fire fa-2x text-danger mb-2"></i>
                                    <h6 class="text-white mb-1">Pişirme</h6>
                                    <p class="text-muted mb-0">{{ $recipe->cook_time }} dk</p>
                                </div>
                            </div>
                            @endif
                            @if($recipe->total_time)
                            <div class="col-md-3 col-6">
                                <div class="info-card text-center p-3">
                                    <i class="fas fa-clock fa-2x text-success mb-2"></i>
                                    <h6 class="text-white mb-1">Toplam</h6>
                                    <p class="text-muted mb-0">{{ $recipe->total_time }} dk</p>
                                </div>
                            </div>
                            @endif
                            @if($recipe->servings)
                            <div class="col-md-3 col-6">
                                <div class="info-card text-center p-3">
                                    <i class="fas fa-users fa-2x text-info mb-2"></i>
                                    <h6 class="text-white mb-1">Kişilik</h6>
                                    <p class="text-muted mb-0">{{ $recipe->servings }} kişi</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    {{-- Malzemeler listesi --}}
                    @if($recipe->ingredients && count($recipe->ingredients) > 0)
                    <div class="ingredients-section mb-5">
                        <h3 class="section-title mb-4">
                            <i class="fas fa-shopping-basket me-2 text-primary"></i>
                            Malzemeler
                        </h3>
                        <div class="ingredients-list">
                            <ul class="list-unstyled">
                                @foreach($recipe->ingredients as $ingredient)
                                <li class="ingredient-item mb-2">
                                    <i class="fas fa-check-circle text-primary me-2"></i>
                                    <span class="text-white">{{ $ingredient }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif

                    {{-- Yapılış talimatları --}}
                    @if($recipe->instructions)
                    <div class="instructions-section mb-5">
                        <h3 class="section-title mb-4">
                            <i class="fas fa-list-ol me-2 text-primary"></i>
                            Yapılışı
                        </h3>
                        <div class="instructions-content">
                            {!! $recipe->instructions !!}
                        </div>
                    </div>
                    @endif

                    {{-- Şef notları --}}
                    @if($recipe->chef_notes)
                    <div class="chef-notes-section mb-5 p-4 rounded" style="background-color: var(--dark-secondary); border-left: 4px solid var(--primary-color);">
                        <h5 class="text-white mb-3">
                            <i class="fas fa-lightbulb me-2 text-warning"></i>
                            Şef Notları
                        </h5>
                        <p class="text-muted mb-0">{{ $recipe->chef_notes }}</p>
                    </div>
                    @endif

                    {{-- Etiketler --}}
                    @if($recipe->tags && count($recipe->tags) > 0)
                        <div class="recipe-tags mt-5 pt-4 border-top border-secondary">
                            <h6 class="text-white mb-3">
                                <i class="fas fa-tags me-2 text-primary"></i>Etiketler:
                            </h6>
                            <div class="tags-list">
                                @foreach($recipe->tags as $tag)
                                    <span class="tag-item">
                                        <i class="fas fa-tag me-1"></i>{{ $tag }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Sosyal paylaşım --}}
                    <div class="social-share mt-5 pt-4 border-top border-secondary">
                        <h6 class="text-white mb-3">
                            <i class="fas fa-share-alt me-2 text-primary"></i>Bu Tarifi Paylaş:
                        </h6>
                        <div class="share-buttons">
                            <a href="#" class="share-btn facebook" target="_blank">
                                <i class="fab fa-facebook-f me-2"></i>Facebook
                            </a>
                            <a href="#" class="share-btn twitter" target="_blank">
                                <i class="fab fa-twitter me-2"></i>Twitter
                            </a>
                            <a href="#" class="share-btn whatsapp" target="_blank">
                                <i class="fab fa-whatsapp me-2"></i>WhatsApp
                            </a>
                            <a href="#" class="share-btn pinterest" target="_blank">
                                <i class="fab fa-pinterest me-2"></i>Pinterest
                            </a>
                        </div>
                    </div>
                </article>

                {{-- İlgili tarifler --}}
                @if(count($relatedRecipes) > 0)
                    <div class="related-recipes mt-5">
                        <h3 class="section-title mb-4">
                            <i class="fas fa-bookmark me-2 text-primary"></i>
                            İlgili Tarifler
                        </h3>
                        <div class="row g-4">
                            @foreach($relatedRecipes as $relatedRecipe)
                                <div class="col-md-6">
                                    <div class="related-recipe-card">
                                        <div class="recipe-image">
                                            @if($relatedRecipe->featured_image)
                                                <img src="{{ $relatedRecipe->featured_image }}" alt="{{ $relatedRecipe->title }}" class="img-fluid">
                                            @else
                                                <div class="placeholder-image">
                                                    <i class="fas fa-utensils fa-2x text-primary"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="recipe-content">
                                            <h5 class="recipe-title">
                                                <a href="{{ route('recipes.show', $relatedRecipe->slug) }}" class="text-decoration-none">
                                                    {{ $relatedRecipe->title }}
                                                </a>
                                            </h5>
                                            <p class="recipe-description text-muted">{{ Str::limit($relatedRecipe->description, 80) }}</p>
                                            <div class="recipe-meta">
                                                <span class="text-muted">
                                                    <i class="fas fa-clock me-1"></i>{{ $relatedRecipe->total_time ?? ($relatedRecipe->prep_time + $relatedRecipe->cook_time) }} dk
                                                </span>
                                                <span class="text-muted ms-3">
                                                    <i class="fas fa-star me-1 text-warning"></i>{{ number_format($relatedRecipe->rating, 1) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            {{-- Sağ taraf - Sidebar --}}
            <div class="col-lg-4">
                <div class="recipe-sidebar">
                    {{-- Tarif bilgileri özeti --}}
                    <div class="widget recipe-summary-widget mb-4">
                        <h4 class="widget-title">
                            <i class="fas fa-info-circle me-2 text-primary"></i>
                            Tarif Bilgileri
                        </h4>
                        <div class="widget-content">
                            <div class="summary-item mb-3 pb-3 border-bottom border-secondary">
                                <span class="text-muted d-block mb-1">Zorluk</span>
                                <span class="text-white">
                                    @if($recipe->difficulty == 'kolay')
                                        <span class="badge bg-success">Kolay</span>
                                    @elseif($recipe->difficulty == 'orta')
                                        <span class="badge bg-warning">Orta</span>
                                    @else
                                        <span class="badge bg-danger">Zor</span>
                                    @endif
                                </span>
                            </div>
                            @if($recipe->prep_time)
                            <div class="summary-item mb-3 pb-3 border-bottom border-secondary">
                                <span class="text-muted d-block mb-1">Hazırlama Süresi</span>
                                <span class="text-white">{{ $recipe->prep_time }} dakika</span>
                            </div>
                            @endif
                            @if($recipe->cook_time)
                            <div class="summary-item mb-3 pb-3 border-bottom border-secondary">
                                <span class="text-muted d-block mb-1">Pişirme Süresi</span>
                                <span class="text-white">{{ $recipe->cook_time }} dakika</span>
                            </div>
                            @endif
                            @if($recipe->servings)
                            <div class="summary-item mb-3 pb-3 border-bottom border-secondary">
                                <span class="text-muted d-block mb-1">Kişilik</span>
                                <span class="text-white">{{ $recipe->servings }} kişi</span>
                            </div>
                            @endif
                            @if($recipe->rating > 0)
                            <div class="summary-item">
                                <span class="text-muted d-block mb-1">Değerlendirme</span>
                                    <div class="rating-display">
                                    {!! $recipe->rating_stars !!}
                                    <span class="text-white ms-2">{{ number_format($recipe->rating, 1) }}</span>
                                    <span class="text-muted">({{ $recipe->rating_count }} oy)</span>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    {{-- Yazar/Tarifi ekleyen kişi --}}
                    <div class="widget author-widget mb-4">
                        <h4 class="widget-title">
                            <i class="fas fa-user me-2 text-primary"></i>
                            Tarifi Ekleyen
                        </h4>
                        <div class="widget-content">
                            <div class="author-card">
                                <div class="author-avatar">
                                    <i class="fas fa-user-circle fa-4x text-primary"></i>
                                </div>
                                <div class="author-info">
                                    <h5 class="author-name text-white">{{ $recipe->user->name }}</h5>
                                    <p class="author-email text-muted">{{ $recipe->user->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Kategori bilgisi --}}
                    <div class="widget category-widget mb-4">
                        <h4 class="widget-title">
                            <i class="fas fa-folder me-2 text-primary"></i>
                            Kategori
                        </h4>
                        <div class="widget-content">
                            <a href="{{ route('recipes.index', ['category' => $recipe->recipeCategory->slug]) }}" 
                               class="category-link"
                               style="color: {{ $recipe->recipeCategory->color ?? '#ff6b35' }};">
                                <i class="{{ $recipe->recipeCategory->icon ?? 'fas fa-tag' }} me-2"></i>
                                {{ $recipe->recipeCategory->name }}
                            </a>
                        </div>
                    </div>

                    {{-- Favorilere ekle --}}
                    @auth
                    <div class="widget favorite-widget mb-4">
                        <div class="widget-content text-center">
                            <form action="{{ route('toggle-favorite', $recipe->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn {{ $isFavorited ? 'btn-danger' : 'btn-primary' }} w-100">
                                    <i class="fas fa-heart me-2"></i>
                                    {{ $isFavorited ? 'Favorilerden Çıkar' : 'Favorilere Ekle' }}
                                </button>
                            </form>
                        </div>
                    </div>
                    @endauth

                    {{-- Yeni tarif ekle widget --}}
                    @auth
                    <div class="widget add-recipe-widget">
                        <h4 class="widget-title">
                            <i class="fas fa-plus me-2 text-primary"></i>
                            Tarifinizi Paylaşın
                        </h4>
                        <div class="widget-content text-center">
                            <p class="text-muted">Kendi tarifinizi ekleyerek topluluğa katkıda bulunun!</p>
                            <a href="{{ route('recipes.create') }}" class="btn btn-outline-primary w-100">
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
@endsection

@section('extra-css')
<style>
/* Tarif detay sayfası özel stilleri */
.breadcrumb-section {
    background-color: var(--dark-secondary);
    border-bottom: 1px solid var(--border-dark);
}

.breadcrumb {
    background-color: transparent;
    margin-bottom: 0;
}

.breadcrumb-item a {
    color: var(--text-light);
}

.breadcrumb-item.active {
    color: var(--primary-color);
}

.section-title {
    color: var(--text-light);
    font-weight: bold;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid var(--primary-color);
}

.recipe-header {
    padding-bottom: 1.5rem;
    border-bottom: 2px solid var(--border-dark);
}

.recipe-meta {
    font-size: 0.9rem;
}

.category-badge {
    font-weight: 500;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    background-color: rgba(255, 107, 53, 0.1);
}

.recipe-title {
    font-size: 2.5rem;
    font-weight: bold;
    color: var(--text-light);
}

.recipe-stats-section {
    margin-top: 1rem;
}

.stat-item {
    display: flex;
    align-items: center;
}

.placeholder-featured-image {
    background: linear-gradient(135deg, var(--dark-secondary) 0%, var(--dark-card) 100%);
    border: 2px dashed var(--primary-color);
    border-radius: 10px;
    padding: 4rem 2rem;
    text-align: center;
}

.featured-image img {
    width: 100%;
    height: auto;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
}

.recipe-info-cards .info-card {
    background-color: var(--dark-secondary);
    border: 1px solid var(--border-dark);
    border-radius: 10px;
    transition: transform 0.3s ease;
}

.recipe-info-cards .info-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 15px rgba(255, 107, 53, 0.2);
}

.ingredients-list {
    background-color: var(--dark-secondary);
    border-radius: 10px;
    padding: 2rem;
}

.ingredient-item {
    padding: 0.5rem 0;
    border-bottom: 1px solid var(--border-dark);
}

.ingredient-item:last-child {
    border-bottom: none;
}

.instructions-content {
    background-color: var(--dark-secondary);
    border-radius: 10px;
    padding: 2rem;
    color: var(--text-light);
    line-height: 1.8;
}

.instructions-content h3,
.instructions-content h4,
.instructions-content h5 {
    color: var(--primary-color);
    margin-top: 1.5rem;
    margin-bottom: 1rem;
}

.instructions-content h3:first-child,
.instructions-content h4:first-child,
.instructions-content h5:first-child {
    margin-top: 0;
}

.instructions-content p {
    margin-bottom: 1rem;
}

.instructions-content ul,
.instructions-content ol {
    margin-left: 1.5rem;
    margin-bottom: 1rem;
}

.instructions-content li {
    margin-bottom: 0.5rem;
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

.summary-item {
    font-size: 0.9rem;
}

.author-card {
    text-align: center;
}

.author-avatar {
    margin-bottom: 1rem;
}

.author-name {
    font-weight: bold;
    margin-bottom: 0.5rem;
}

.author-email {
    font-size: 0.875rem;
}

.category-link {
    display: inline-flex;
    align-items: center;
    padding: 0.5rem 1rem;
    background-color: rgba(255, 107, 53, 0.1);
    border-radius: 20px;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.category-link:hover {
    background-color: rgba(255, 107, 53, 0.2);
}

/* Tag stilleri */
.tags-list {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.tag-item {
    background-color: var(--dark-secondary);
    color: var(--text-light);
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.875rem;
    border: 1px solid var(--border-dark);
}

/* Share buttons */
.share-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.share-btn {
    padding: 0.5rem 1rem;
    border-radius: 5px;
    text-decoration: none;
    color: white;
    font-size: 0.875rem;
    transition: opacity 0.3s ease;
}

.share-btn:hover {
    opacity: 0.8;
    color: white;
}

.share-btn.facebook {
    background-color: #1877f2;
}

.share-btn.twitter {
    background-color: #1da1f2;
}

.share-btn.whatsapp {
    background-color: #25d366;
}

.share-btn.pinterest {
    background-color: #bd081c;
}

/* Related recipes */
.related-recipe-card {
    background-color: var(--dark-card);
    border: 1px solid var(--border-dark);
    border-radius: 10px;
    overflow: hidden;
    transition: transform 0.3s ease;
}

.related-recipe-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 15px rgba(255, 107, 53, 0.2);
}

.related-recipe-card .recipe-image {
    height: 150px;
    overflow: hidden;
}

.related-recipe-card .recipe-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.related-recipe-card .placeholder-image {
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, var(--dark-secondary) 0%, var(--dark-card) 100%);
}

.related-recipe-card .recipe-content {
    padding: 1rem;
}

.related-recipe-card .recipe-title {
    font-size: 1.1rem;
    margin-bottom: 0.5rem;
}

.related-recipe-card .recipe-title a {
    color: var(--text-light);
    transition: color 0.3s ease;
}

.related-recipe-card .recipe-title a:hover {
    color: var(--primary-color);
}

.related-recipe-card .recipe-description {
    font-size: 0.875rem;
    margin-bottom: 0.75rem;
}

.related-recipe-card .recipe-meta {
    font-size: 0.8rem;
}

/* Rating display */
.rating-display {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
}
</style>
@endsection
