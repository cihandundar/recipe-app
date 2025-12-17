{{-- Favoriler sayfası --}}
@extends('layouts.app')

@section('title', 'Favorilerim - Tarif Dünyası')

@section('content')
<div class="favorites-page py-5">
    <div class="container">
        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}" class="text-decoration-none">
                        <i class="fas fa-home me-1"></i>Ana Sayfa
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item active text-primary" aria-current="page">Favorilerim</li>
            </ol>
        </nav>

        {{-- Başlık --}}
        <div class="page-header mb-5">
            <h1 class="display-5 fw-bold text-white mb-3">
                <i class="fas fa-heart me-2 text-primary"></i>Favorilerim
            </h1>
            <p class="lead text-muted">Beğendiğiniz tarifleri burada bulabilirsiniz.</p>
        </div>

        {{-- Favoriler Listesi --}}
        @if($recipes->count() > 0)
            <div class="recipes-grid">
                <div class="row g-4">
                    @foreach($recipes as $recipe)
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
                                    <span class="badge bg-primary mb-2">
                                        {{ $recipe->recipeCategory->name ?? 'Kategori Yok' }}
                                    </span>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="empty-state text-center py-5">
                <div class="card border-0 shadow-lg">
                    <div class="card-body py-5">
                        <i class="fas fa-heart fa-4x text-muted mb-4"></i>
                        <h4 class="text-white mb-3">Henüz favori tarifiniz yok</h4>
                        <p class="text-muted mb-4">Beğendiğiniz tarifleri favorilerinize ekleyerek burada saklayabilirsiniz.</p>
                        <a href="{{ route('recipes.index') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-search me-2"></i>Tarif Keşfet
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@section('extra-css')
<style>
.favorites-page {
    background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
    min-height: 100vh;
}

.card {
    background-color: var(--dark-card, #2d2d2d);
    border: 1px solid var(--border-dark, #404040);
}

.recipe-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.recipe-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(255, 107, 53, 0.2) !important;
}

.breadcrumb {
    background-color: transparent;
}

.breadcrumb-item a {
    color: var(--primary-color, #ff6b35);
}

.breadcrumb-item.active {
    color: var(--text-light, #ffffff);
}
</style>
@endsection
