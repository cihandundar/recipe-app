{{-- Kullanıcının tarifleri sayfası --}}
@extends('layouts.app')

@section('title', 'Tariflerim - Tarif Dünyası')

@section('content')
<div class="my-recipes-page py-5">
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
                <li class="breadcrumb-item active text-primary" aria-current="page">Tariflerim</li>
            </ol>
        </nav>

        {{-- Başlık --}}
        <div class="page-header mb-5">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="display-5 fw-bold text-white mb-3">
                        <i class="fas fa-book-open me-2 text-primary"></i>Tariflerim
                    </h1>
                    <p class="lead text-muted">Eklediğiniz tüm tarifleri görüntüleyin ve yönetin.</p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="{{ route('recipes.create') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-plus-circle me-2"></i>Yeni Tarif Ekle
                    </a>
                </div>
            </div>
        </div>

        {{-- Filtreler --}}
        <div class="filters-section mb-4">
            <div class="card border-0 shadow-lg">
                <div class="card-body">
                    <form action="{{ route('my-recipes') }}" method="GET" class="row g-3">
                        <div class="col-md-6">
                            <input type="text" 
                                   class="form-control" 
                                   name="search" 
                                   placeholder="Tarif ara..." 
                                   value="{{ request('search') }}">
                        </div>
                        <div class="col-md-4">
                            <select name="status" class="form-select">
                                <option value="">Tüm Durumlar</option>
                                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Yayınlanan</option>
                                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Taslak</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-search me-2"></i>Ara
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Tarifler Listesi --}}
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
                                    <div class="recipe-meta d-flex justify-content-between align-items-center mb-3">
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
                                            <small class="text-muted">
                                                {{ $recipe->created_at->format('d M Y') }}
                                            </small>
                                        </div>
                                    </div>
                                    <div class="recipe-actions d-flex gap-2">
                                        <a href="{{ route('recipes.show', $recipe->slug) }}" 
                                           class="btn btn-sm btn-outline-primary flex-fill">
                                            <i class="fas fa-eye me-1"></i>Görüntüle
                                        </a>
                                        <a href="{{ route('recipes.edit', $recipe->slug) }}" 
                                           class="btn btn-sm btn-outline-success flex-fill">
                                            <i class="fas fa-edit me-1"></i>Düzenle
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Sayfalama --}}
                <div class="mt-4">
                    {{ $recipes->links() }}
                </div>
            </div>
        @else
            <div class="empty-state text-center py-5">
                <div class="card border-0 shadow-lg">
                    <div class="card-body py-5">
                        <i class="fas fa-book-open fa-4x text-muted mb-4"></i>
                        <h4 class="text-white mb-3">Henüz tarif eklemediniz</h4>
                        <p class="text-muted mb-4">İlk tarifinizi ekleyerek başlayın!</p>
                        <a href="{{ route('recipes.create') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-plus-circle me-2"></i>Yeni Tarif Ekle
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
.my-recipes-page {
    background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
    min-height: 100vh;
}

.card {
    background-color: var(--dark-card, #2d2d2d);
    border: 1px solid var(--border-dark, #404040);
}

.form-control, .form-select {
    background-color: var(--dark-secondary, #1a1a1a);
    border: 1px solid var(--border-dark, #404040);
    color: var(--text-light, #ffffff);
}

.form-control:focus, .form-select:focus {
    background-color: var(--dark-secondary, #1a1a1a);
    border-color: var(--primary-color, #ff6b35);
    color: var(--text-light, #ffffff);
    box-shadow: 0 0 0 0.25rem rgba(255, 107, 53, 0.15);
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
