{{-- Dashboard sayfası - Kullanıcı kontrol paneli --}}
@extends('layouts.app')

@section('title', 'Dashboard - Tarif Dünyası')

@section('content')
<div class="dashboard-page py-5">
    <div class="container">
        {{-- Hoş Geldiniz Bölümü --}}
        <div class="welcome-section mb-5">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="display-5 fw-bold text-white mb-3">
                        <i class="fas fa-tachometer-alt me-2 text-primary"></i>Hoş Geldiniz, {{ Auth::user()->name }}!
                    </h1>
                    <p class="lead text-muted">Tarif dünyanıza hoş geldiniz. Tariflerinizi yönetin ve yeni lezzetler keşfedin.</p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="{{ route('recipes.create') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-plus-circle me-2"></i>Yeni Tarif Ekle
                    </a>
                </div>
            </div>
        </div>

        {{-- İstatistikler --}}
        <div class="stats-section mb-5">
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="stat-card card border-0 shadow-lg">
                        <div class="card-body text-center">
                            <div class="stat-icon mb-3">
                                <i class="fas fa-book fa-3x text-primary"></i>
                            </div>
                            <h3 class="stat-number text-white mb-1">{{ $totalRecipes }}</h3>
                            <p class="stat-label text-muted mb-0">Toplam Tarif</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card card border-0 shadow-lg">
                        <div class="card-body text-center">
                            <div class="stat-icon mb-3">
                                <i class="fas fa-check-circle fa-3x text-success"></i>
                            </div>
                            <h3 class="stat-number text-white mb-1">{{ $publishedRecipes }}</h3>
                            <p class="stat-label text-muted mb-0">Yayınlanan Tarif</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card card border-0 shadow-lg">
                        <div class="card-body text-center">
                            <div class="stat-icon mb-3">
                                <i class="fas fa-eye fa-3x text-info"></i>
                            </div>
                            <h3 class="stat-number text-white mb-1">{{ number_format($totalViews) }}</h3>
                            <p class="stat-label text-muted mb-0">Toplam Görüntülenme</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card card border-0 shadow-lg">
                        <div class="card-body text-center">
                            <div class="stat-icon mb-3">
                                <i class="fas fa-star fa-3x text-warning"></i>
                            </div>
                            <h3 class="stat-number text-white mb-1">
                                {{ $totalRecipes > 0 ? number_format($myRecipes->avg('rating') ?? 0, 1) : '0.0' }}
                            </h3>
                            <p class="stat-label text-muted mb-0">Ortalama Puan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Hızlı Erişim --}}
        <div class="quick-actions mb-5">
            <h3 class="section-title mb-4">
                <i class="fas fa-bolt me-2 text-primary"></i>Hızlı Erişim
            </h3>
            <div class="row g-3">
                <div class="col-md-3">
                    <a href="{{ route('recipes.create') }}" class="quick-action-card card border-0 shadow-lg text-decoration-none">
                        <div class="card-body text-center">
                            <i class="fas fa-plus-circle fa-2x text-primary mb-3"></i>
                            <h5 class="text-white mb-0">Yeni Tarif Ekle</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('my-recipes') }}" class="quick-action-card card border-0 shadow-lg text-decoration-none">
                        <div class="card-body text-center">
                            <i class="fas fa-book-open fa-2x text-primary mb-3"></i>
                            <h5 class="text-white mb-0">Tariflerim</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('favorites') }}" class="quick-action-card card border-0 shadow-lg text-decoration-none">
                        <div class="card-body text-center">
                            <i class="fas fa-heart fa-2x text-primary mb-3"></i>
                            <h5 class="text-white mb-0">Favorilerim</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('profile.edit') }}" class="quick-action-card card border-0 shadow-lg text-decoration-none">
                        <div class="card-body text-center">
                            <i class="fas fa-user-cog fa-2x text-primary mb-3"></i>
                            <h5 class="text-white mb-0">Profil Ayarları</h5>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        {{-- Son Tariflerim --}}
        <div class="recent-recipes-section">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="section-title mb-0">
                    <i class="fas fa-clock me-2 text-primary"></i>Son Tariflerim
                </h3>
                @if($totalRecipes > 6)
                    <a href="{{ route('my-recipes') }}" class="btn btn-outline-primary">
                        Tümünü Gör <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                @endif
            </div>

            @if($myRecipes->count() > 0)
                <div class="row g-4">
                    @foreach($myRecipes as $recipe)
                        <div class="col-md-4">
                            <div class="recipe-card card border-0 shadow-lg h-100">
                                @if($recipe->featured_image)
                                    <img src="{{ $recipe->featured_image }}" 
                                         class="card-img-top" 
                                         alt="{{ $recipe->title }}"
                                         style="height: 200px; object-fit: cover;">
                                @else
                                    <div class="card-img-top bg-dark d-flex align-items-center justify-content-center" 
                                         style="height: 200px;">
                                        <i class="fas fa-utensils fa-3x text-primary"></i>
                                    </div>
                                @endif
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <span class="badge bg-primary">
                                            {{ $recipe->recipeCategory->name ?? 'Kategori Yok' }}
                                        </span>
                                        @if($recipe->is_published)
                                            <span class="badge bg-success">
                                                <i class="fas fa-check me-1"></i>Yayında
                                            </span>
                                        @else
                                            <span class="badge bg-warning">
                                                <i class="fas fa-clock me-1"></i>Taslak
                                            </span>
                                        @endif
                                    </div>
                                    <h5 class="card-title text-white mb-2">
                                        <a href="{{ route('recipes.show', $recipe->slug) }}" 
                                           class="text-decoration-none text-white">
                                            {{ Str::limit($recipe->title, 50) }}
                                        </a>
                                    </h5>
                                    <p class="card-text text-muted small mb-3">
                                        {{ Str::limit($recipe->description, 80) }}
                                    </p>
                                    <div class="recipe-meta d-flex justify-content-between align-items-center">
                                        <div class="meta-item">
                                            <i class="fas fa-eye text-primary me-1"></i>
                                            <small class="text-muted">{{ number_format($recipe->views) }}</small>
                                        </div>
                                        @if($recipe->rating > 0)
                                            <div class="meta-item">
                                                <i class="fas fa-star text-warning me-1"></i>
                                                <small class="text-muted">{{ number_format($recipe->rating, 1) }}</small>
                                            </div>
                                        @endif
                                        <div class="meta-item">
                                            <a href="{{ route('recipes.edit', $recipe->slug) }}" 
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-edit me-1"></i>Düzenle
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state text-center py-5">
                    <i class="fas fa-book-open fa-4x text-muted mb-4"></i>
                    <h4 class="text-white mb-3">Henüz tarif eklemediniz</h4>
                    <p class="text-muted mb-4">İlk tarifinizi ekleyerek başlayın!</p>
                    <a href="{{ route('recipes.create') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-plus-circle me-2"></i>Yeni Tarif Ekle
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('extra-css')
<style>
.dashboard-page {
    background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
    min-height: 100vh;
}

.stat-card {
    background: linear-gradient(135deg, #2d2d2d 0%, #1a1a1a 100%);
    border: 1px solid var(--border-dark, #404040);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(255, 107, 53, 0.2) !important;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: bold;
    color: var(--primary-color, #ff6b35);
}

.stat-label {
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.quick-action-card {
    background: linear-gradient(135deg, #2d2d2d 0%, #1a1a1a 100%);
    border: 1px solid var(--border-dark, #404040);
    transition: all 0.3s ease;
}

.quick-action-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(255, 107, 53, 0.2) !important;
    border-color: var(--primary-color, #ff6b35);
}

.section-title {
    color: var(--text-light, #ffffff);
    border-bottom: 2px solid var(--primary-color, #ff6b35);
    padding-bottom: 10px;
}

.recipe-card {
    background-color: var(--dark-card, #2d2d2d);
    border: 1px solid var(--border-dark, #404040);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.recipe-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(255, 107, 53, 0.2) !important;
}

.empty-state {
    background-color: rgba(0, 0, 0, 0.2);
    border-radius: 15px;
    border: 2px dashed var(--border-dark, #404040);
}
</style>
@endsection
