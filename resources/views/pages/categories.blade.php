{{-- Kategoriler ana sayfası - Tüm kategorilerin listelendiği sayfa --}}
@extends('layouts.app')

@section('title', 'Kategoriler - Tarif Dünyası')

@section('content')
{{-- Sayfa başlık bölümü - Dark tema ile --}}
<div class="page-header text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 fw-bold mb-3">
                    <i class="fas fa-list me-3"></i>
                    Tarif Kategorileri
                </h1>
                <p class="lead mb-0">
                    Aradığınız tarif türünü seçin ve lezzetli dünyaya adım atın
                </p>
            </div>
        </div>
    </div>
</div>

{{-- Ana kategori listesi bölümü --}}
<div class="categories-section py-5">
    <div class="container">
        <div class="row g-4">
            {{-- Her kategori için döngü başlatıyoruz --}}
            @foreach($categories as $category)
            <div class="col-lg-4 col-md-6">
                {{-- Kategori kartı - Her kategori için ayrı bir kart oluşturuyoruz --}}
                <div class="category-card card h-100 shadow-sm border-0">
                    <div class="card-body p-4 text-center">
                        {{-- Kategori ikonu --}}
                        <div class="category-icon mb-4">
                            <i class="{{ $category['icon'] }} fa-4x text-{{ $category['color'] }}"></i>
                        </div>
                        
                        {{-- Kategori başlığı --}}
                        <h3 class="card-title fw-bold mb-3">{{ $category['name'] }}</h3>
                        
                        {{-- Kategori açıklaması --}}
                        <p class="card-text text-muted mb-3">
                            {{ $category['description'] }}
                        </p>
                        
                        {{-- Tarif sayısı göstergesi --}}
                        <div class="recipe-count mb-4">
                            <span class="badge bg-{{ $category['color'] }}-subtle text-{{ $category['color'] }} fs-6">
                                <i class="fas fa-book-open me-1"></i>
                                {{ $category['recipe_count'] }} Tarif
                            </span>
                        </div>
                        
                        {{-- Kategori detay sayfasına git butonu --}}
                        <a href="{{ route('category', $category['slug']) }}" 
                           class="btn btn-{{ $category['color'] }} btn-lg">
                            <i class="fas fa-arrow-right me-2"></i>
                            Tarifleri Gör
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- İstatistik bölümü - Dark tema ile --}}
<div class="stats-section py-5">
    <div class="container">
        <div class="row text-center">
            <div class="col-12 mb-4">
                <h2 class="fw-bold mb-3 text-white">Kategori İstatistikleri</h2>
                <p class="text-muted">Tarif Dünyası'ndaki kategori dağılımı</p>
            </div>
        </div>
        
        <div class="row g-4">
            {{-- Toplam kategori sayısı --}}
            <div class="col-md-4">
                <div class="stat-card text-center p-4">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-layer-group fa-3x text-primary"></i>
                    </div>
                    <h3 class="fw-bold text-primary">{{ count($categories) }}</h3>
                    <p class="text-muted mb-0">Toplam Kategori</p>
                </div>
            </div>
            
            {{-- Toplam tarif sayısı --}}
            <div class="col-md-4">
                <div class="stat-card text-center p-4">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-book fa-3x text-success"></i>
                    </div>
                    <h3 class="fw-bold text-success">{{ collect($categories)->sum('recipe_count') }}</h3>
                    <p class="text-muted mb-0">Toplam Tarif</p>
                </div>
            </div>
            
            {{-- En popüler kategori --}}
            <div class="col-md-4">
                <div class="stat-card text-center p-4">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-star fa-3x text-warning"></i>
                    </div>
                    <h3 class="fw-bold text-warning">
                        @php
                            $popularCategory = collect($categories)->sortByDesc('recipe_count')->first();
                        @endphp
                        {{ $popularCategory['name'] }}
                    </h3>
                    <p class="text-muted mb-0">En Popüler Kategori</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- Sayfa özel CSS stilleri - Dark tema --}}
@section('extra-css')
<style>
/* Sayfa başlık bölümü gradyan arka planı */
.page-header {
    background: linear-gradient(135deg, #1a1a1a 0%, #ff6b35 100%);
}

/* Kategori kartlarının hover efektleri */
.category-card {
    transition: all 0.3s ease;
    border-radius: 15px;
    background-color: var(--dark-card);
    border: 1px solid var(--border-dark);
    color: var(--text-light);
}

.category-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 35px rgba(255, 107, 53, 0.2) !important;
}

/* Kategori ikonlarının hover efektleri */
.category-icon i {
    transition: transform 0.3s ease;
}

.category-card:hover .category-icon i {
    transform: scale(1.1);
}

/* Kategori başlıkları */
.category-card .card-title {
    color: var(--text-light);
}

/* İstatistik kartları */
.stat-card {
    background-color: var(--dark-card);
    border: 1px solid var(--border-dark);
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    transition: transform 0.3s ease;
    color: var(--text-light);
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(255, 107, 53, 0.1);
}

/* İstatistik sayiları */
.stat-card h3 {
    color: var(--text-light);
}

.stat-card h3.text-primary {
    color: var(--primary-color) !important;
}

.stat-card h3.text-success {
    color: #28a745 !important;
}

.stat-card h3.text-warning {
    color: #ffc107 !important;
}

/* Badge stilleri */
.badge {
    background-color: var(--dark-secondary) !important;
    color: var(--text-light) !important;
}

/* Responsive tasarım düzenlemeleri */
@media (max-width: 768px) {
    .page-header {
        padding: 3rem 0;
    }
    
    .category-icon i {
        font-size: 3rem !important;
    }
    
    .display-4 {
        font-size: 2rem;
    }
}
</style>
@endsection