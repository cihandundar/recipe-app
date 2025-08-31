@extends('layouts.app')

@section('title', 'Ana Sayfa - Tarif Dünyası')

@section('content')
{{-- Ana sayfa hero bölümü - Siyah ve turuncu tema ile --}}
<div class="hero-section text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Tarif Dünyasına Hoş Geldiniz!</h1>
                <p class="lead mb-4">
                    En lezzetli tarifleri keşfedin, kendi tariflerinizi paylaşın ve 
                    mutfakta yeni deneyimler yaşayın.
                </p>
                <div class="hero-actions">
                    <a href="{{ route('recipes.index') }}" class="btn btn-primary btn-lg me-3">
                        <i class="fas fa-search me-2"></i>Tarifleri Keşfet
                    </a>
                    <a href="{{ route('recipes.create') }}" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-plus me-2"></i>Tarif Ekle
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                {{-- Placeholder görsel yerine büyük ikon kullanalım --}}
                <div class="hero-image-placeholder d-flex align-items-center justify-content-center" 
                     style="height: 400px; background: linear-gradient(135deg, rgba(255, 107, 53, 0.1) 0%, rgba(255, 107, 53, 0.3) 100%); border-radius: 15px; border: 2px dashed var(--primary-color);">
                    <div class="text-center">
                        <i class="fas fa-utensils" style="font-size: 120px; color: var(--primary-color); opacity: 0.8;"></i>
                        <h4 class="mt-3 text-white">Lezzetli Tarifler</h4>
                        <p class="text-muted">Binlerce nefis tarif sizleri bekliyor</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="features-section py-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-12">
                <h2 class="fw-bold mb-3">Neden Tarif Dünyası?</h2>
                <p class="lead text-muted">Mutfağınızı daha keyifli hale getiren özellikler</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card text-center p-4 h-100 border rounded">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-book-open fa-3x text-primary"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Binlerce Tarif</h4>
                    <p class="text-muted">
                        Ana yemekten tatlıya, çorbadan içeceğe kadar 
                        binlerce farklı tarif sizleri bekliyor.
                    </p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="feature-card text-center p-4 h-100 border rounded">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-users fa-3x text-success"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Topluluk</h4>
                    <p class="text-muted">
                        Yemek severlerin bir araya geldiği samimi 
                        toplulukta deneyimlerinizi paylaşın.
                    </p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="feature-card text-center p-4 h-100 border rounded">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-star fa-3x text-warning"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Değerlendirmeler</h4>
                    <p class="text-muted">
                        Kullanıcı değerlendirmeleri ile en iyi 
                        tarifleri kolayca keşfedin.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Popüler tarifler bölümü - Koyu tema ile --}}
<div class="popular-recipes-section py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="fw-bold mb-3 text-white">Popüler Tarifler</h2>
                <p class="text-muted">Bu hafta en çok beğenilen tarifler</p>
            </div>
        </div>
        
        <div class="row g-4">
            @for($i = 1; $i <= 6; $i++)
            <div class="col-lg-4 col-md-6">
                <div class="recipe-card card h-100 shadow-sm">
                    {{-- Placeholder tarif görseli yerine ikon kullanalım --}}
                    <div class="card-img-top d-flex align-items-center justify-content-center" 
                         style="height: 200px; background: linear-gradient(135deg, var(--dark-secondary) 0%, var(--dark-card) 100%); border-bottom: 2px solid var(--primary-color);">
                        <div class="text-center">
                            @if($i <= 2)
                                <i class="fas fa-birthday-cake" style="font-size: 60px; color: var(--primary-color); opacity: 0.8;"></i>
                                <p class="mt-2 mb-0 small text-muted">Tatlı Tarifleri</p>
                            @elseif($i <= 4)
                                <i class="fas fa-drumstick-bite" style="font-size: 60px; color: var(--primary-color); opacity: 0.8;"></i>
                                <p class="mt-2 mb-0 small text-muted">Ana Yemek</p>
                            @else
                                <i class="fas fa-coffee" style="font-size: 60px; color: var(--primary-color); opacity: 0.8;"></i>
                                <p class="mt-2 mb-0 small text-muted">İçecek Tarifleri</p>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-white">Örnek Tarif {{ $i }}</h5>
                        <p class="card-text text-muted">
                            Bu harika tarifte nefis lezzetler sizleri bekliyor...
                        </p>
                        <div class="recipe-meta d-flex justify-content-between text-muted small">
                            <span><i class="fas fa-clock me-1"></i>30 dk</span>
                            <span><i class="fas fa-star me-1 text-warning"></i>4.5</span>
                            <span><i class="fas fa-user me-1"></i>Chef Ali</span>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent">
                        <a href="#" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-eye me-1"></i>Tarifi Gör
                        </a>
                        <a href="#" class="btn btn-outline-danger btn-sm float-end">
                            <i class="fas fa-heart me-1"></i>Favorile
                        </a>
                    </div>
                </div>
            </div>
            @endfor
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('recipes.index') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-arrow-right me-2"></i>Tüm Tarifleri Gör
            </a>
        </div>
    </div>
</div>

<div class="categories-section py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="fw-bold mb-3">Kategoriler</h2>
                <p class="text-muted">Aradığınız tarif türünü seçin</p>
            </div>
        </div>
        
        <div class="row g-4">
            @php
                $categories = [
                    ['name' => 'Ana Yemek', 'icon' => 'fas fa-utensils', 'color' => 'primary'],
                    ['name' => 'Tatlı', 'icon' => 'fas fa-birthday-cake', 'color' => 'danger'],
                    ['name' => 'Çorba', 'icon' => 'fas fa-bowl-hot', 'color' => 'warning'],
                    ['name' => 'Salata', 'icon' => 'fas fa-leaf', 'color' => 'success'],
                    ['name' => 'İçecek', 'icon' => 'fas fa-glass-whiskey', 'color' => 'info'],
                    ['name' => 'Aperitif', 'icon' => 'fas fa-cheese', 'color' => 'secondary']
                ];
            @endphp
            
            @foreach($categories as $category)
            <div class="col-lg-2 col-md-4 col-6">
                <a href="#" class="text-decoration-none">
                    <div class="category-card text-center p-3 border rounded h-100 hover-card">
                        <div class="category-icon mb-2">
                            <i class="{{ $category['icon'] }} fa-2x text-{{ $category['color'] }}"></i>
                        </div>
                        <h6 class="fw-bold mb-0">{{ $category['name'] }}</h6>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection

{{-- Ana sayfa özel CSS stilleri - Dark tema ile --}}
@section('extra-css')
<style>
/* Hero bölüm gradyan arka planı - Siyah ve turuncu */
.hero-section {
    background: linear-gradient(135deg, #1a1a1a 0%, #ff6b35 100%);
}

/* Özellik, tarif ve kategori kartları hover efektleri */
.feature-card,
.recipe-card,
.category-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    background-color: var(--dark-card);
    border: 1px solid var(--border-dark);
    color: var(--text-light);
}

.feature-card:hover,
.recipe-card:hover,
.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(255, 107, 53, 0.2) !important;
}

/* Tarif kart resmi boyutu */
.recipe-card .card-img-top {
    height: 200px;
    object-fit: cover;
}

/* Kategori kartları */
.category-card {
    border: 2px solid transparent;
    background-color: var(--dark-card);
}

.category-card:hover {
    border-color: var(--primary-color);
}

/* Özellik kartları başlıkları */
.feature-card h4 {
    color: var(--text-light);
}

/* Kategori isimleri */
.category-card h6 {
    color: var(--text-light);
}

/* Hero bölümündeki outline buton */
.btn-outline-light {
    border-color: rgba(255,255,255,0.5);
    color: white;
}

.btn-outline-light:hover {
    background-color: rgba(255,255,255,0.1);
    border-color: white;
    color: white;
}

/* Responsive tasarım düzenlemeleri */
@media (max-width: 768px) {
    .hero-section {
        padding: 3rem 0;
    }
    
    .display-4 {
        font-size: 2rem;
    }
}
</style>
@endsection