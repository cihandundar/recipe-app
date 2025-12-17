{{-- Kullanıcı profil sayfası --}}
@extends('layouts.app')

@section('title', 'Profilim - Tarif Dünyası')

@section('content')
<div class="profile-page py-5">
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
                <li class="breadcrumb-item active text-primary" aria-current="page">Profilim</li>
            </ol>
        </nav>

        {{-- Profil Başlığı --}}
        <div class="profile-header mb-5">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="display-5 fw-bold text-white mb-3">
                        <i class="fas fa-user me-2 text-primary"></i>Profilim
                    </h1>
                    <p class="lead text-muted">Profil bilgilerinizi görüntüleyin ve yönetin.</p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-edit me-2"></i>Profili Düzenle
                    </a>
                </div>
            </div>
        </div>

        {{-- Kullanıcı Bilgileri --}}
        <div class="row mb-5">
            <div class="col-md-4">
                <div class="card border-0 shadow-lg">
                    <div class="card-body text-center">
                        <div class="profile-avatar mb-3">
                            <div class="avatar-circle">
                                <i class="fas fa-user fa-4x text-primary"></i>
                            </div>
                        </div>
                        <h3 class="text-white mb-1">{{ $user->name }}</h3>
                        <p class="text-muted mb-3">{{ $user->email }}</p>
                        <div class="profile-stats">
                            <div class="stat-item mb-2">
                                <i class="fas fa-book text-primary me-2"></i>
                                <span class="text-white">{{ $totalRecipes }} Tarif</span>
                            </div>
                            <div class="stat-item mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span class="text-white">{{ $publishedRecipes }} Yayınlanan</span>
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-eye text-info me-2"></i>
                                <span class="text-white">{{ number_format($totalViews) }} Görüntülenme</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card border-0 shadow-lg">
                    <div class="card-body">
                        <h4 class="text-white mb-4">
                            <i class="fas fa-info-circle me-2 text-primary"></i>Profil Bilgileri
                        </h4>
                        <div class="profile-info">
                            <div class="info-item mb-3">
                                <label class="text-muted small">Ad Soyad</label>
                                <p class="text-white mb-0">{{ $user->name }}</p>
                            </div>
                            <div class="info-item mb-3">
                                <label class="text-muted small">E-posta Adresi</label>
                                <p class="text-white mb-0">{{ $user->email }}</p>
                            </div>
                            <div class="info-item mb-3">
                                <label class="text-muted small">Kayıt Tarihi</label>
                                <p class="text-white mb-0">{{ $user->created_at->format('d M Y') }}</p>
                            </div>
                            @if($user->email_verified_at)
                            <div class="info-item">
                                <label class="text-muted small">E-posta Doğrulama</label>
                                <p class="text-success mb-0">
                                    <i class="fas fa-check-circle me-2"></i>
                                    Doğrulanmış ({{ $user->email_verified_at->format('d M Y') }})
                                </p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Son Tarifler --}}
        @if($recentRecipes->count() > 0)
        <div class="recent-recipes-section">
            <h3 class="section-title mb-4">
                <i class="fas fa-clock me-2 text-primary"></i>Son Tariflerim
            </h3>
            <div class="row g-4">
                @foreach($recentRecipes as $recipe)
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
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        <i class="fas fa-eye me-1"></i>{{ number_format($recipe->views) }}
                                    </small>
                                    <a href="{{ route('recipes.edit', $recipe->slug) }}" 
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit me-1"></i>Düzenle
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('my-recipes') }}" class="btn btn-outline-primary">
                    Tüm Tariflerimi Gör <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@section('extra-css')
<style>
.profile-page {
    background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
    min-height: 100vh;
}

.card {
    background-color: var(--dark-card, #2d2d2d);
    border: 1px solid var(--border-dark, #404040);
}

.avatar-circle {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    border: 4px solid var(--dark-card, #2d2d2d);
}

.section-title {
    color: var(--text-light, #ffffff);
    border-bottom: 2px solid var(--primary-color, #ff6b35);
    padding-bottom: 10px;
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
