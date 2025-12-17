{{-- Kategori detay sayfası - Belirli bir kategorideki tariflerin gösterildiği sayfa --}}
@extends('layouts.app')

@section('title', $category->name . ' Tarifleri - Tarif Dünyası')

@section('content')
{{-- Kategori başlık bölümü - Dark tema ile --}}
<div class="category-header text-white py-5" style="background: linear-gradient(135deg, #1a1a1a 0%, {{ $category->color ?? '#ff6b35' }} 100%);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                {{-- Geri dönüş linki --}}
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}" class="text-white-50">
                                <i class="fas fa-home me-1"></i>Ana Sayfa
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('categories') }}" class="text-white-50">Kategoriler</a>
                        </li>
                        <li class="breadcrumb-item active text-white" aria-current="page">
                            {{ $category->name }}
                        </li>
                    </ol>
                </nav>
                
                {{-- Kategori başlığı --}}
                <h1 class="display-4 fw-bold mb-3">
                    {{ $category->name }} Tarifleri
                </h1>
                <p class="lead mb-0">
                    {{ $category->description ?? 'En lezzetli ' . strtolower($category->name) . ' tariflerini keşfedin' }}
                </p>
            </div>
            
            {{-- Kategori istatistikleri --}}
            <div class="col-md-4 text-end">
                <div class="category-stats">
                    <div class="stat-item mb-2">
                        <i class="fas fa-book-open me-2"></i>
                        <span class="fw-bold">{{ $recipes->total() }}</span> Tarif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Tarif listesi bölümü --}}
<div class="recipes-section py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-0 text-muted">
                        <strong>{{ $recipes->total() }}</strong> tarif bulundu
                    </p>
                </div>
            </div>
        </div>
        
        <div class="row g-4">
            {{-- Her tarif için döngü başlatıyoruz --}}
            @forelse($recipes as $recipe)
            <div class="col-lg-3 col-md-6">
                {{-- Tarif kartı - Her tarif için ayrı bir kart oluşturuyoruz --}}
                <div class="recipe-card card h-100 shadow-sm border-0">
                    {{-- Tarif resmi --}}
                    <div class="recipe-image">
                        @if($recipe->featured_image)
                            <img src="{{ $recipe->featured_image }}" 
                                 class="card-img-top" 
                                 alt="{{ $recipe->title }}">
                        @else
                            {{-- Görsel yoksa ikon gösterelim --}}
                            <div class="card-img-top d-flex align-items-center justify-content-center" 
                                 style="height: 200px; background: linear-gradient(135deg, var(--dark-secondary) 0%, var(--dark-card) 100%); border-bottom: 2px solid {{ $category->color ?? '#ff6b35' }};">
                                <div class="text-center">
                                    <i class="{{ $category->icon ?? 'fas fa-utensils' }}" style="font-size: 60px; color: {{ $category->color ?? '#ff6b35' }}; opacity: 0.8;"></i>
                                    <p class="mt-2 mb-0 small text-muted">{{ $category->name }} Tarifi</p>
                                </div>
                            </div>
                        @endif
                        
                        @if($recipe->is_featured)
                        <div class="recipe-badge" style="position: absolute; top: 10px; right: 10px;">
                            <span class="badge bg-warning text-dark">
                                <i class="fas fa-star me-1"></i>Öne Çıkan
                            </span>
                        </div>
                        @endif
                    </div>
                    
                    {{-- Tarif bilgileri --}}
                    <div class="card-body p-3">
                        <h5 class="card-title mb-2">{{ $recipe->title }}</h5>
                        <p class="card-text text-muted small mb-3">
                            {{ Str::limit($recipe->description, 80) }}
                        </p>
                        
                        {{-- Tarif meta bilgileri --}}
                        <div class="recipe-meta d-flex justify-content-between align-items-center small text-muted mb-3">
                            <span><i class="fas fa-clock me-1"></i>{{ $recipe->total_time ?? ($recipe->prep_time + $recipe->cook_time) }} dk</span>
                            <span><i class="fas fa-star me-1 text-warning"></i>{{ number_format($recipe->rating, 1) }}</span>
                            <span><i class="fas fa-user me-1"></i>{{ $recipe->user->name ?? 'Bilinmiyor' }}</span>
                        </div>
                    </div>
                    
                    {{-- Tarif aksiyonları --}}
                    <div class="card-footer bg-transparent border-0 p-3 pt-0">
                        <div class="d-grid">
                            <a href="{{ route('recipes.show', $recipe->slug) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-eye me-1"></i>Tarifi Gör
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            {{-- Hiç tarif bulunamadığında gösterilecek mesaj --}}
            <div class="col-12">
                <div class="text-center py-5">
                    <div class="empty-state-container" 
                         style="background: linear-gradient(135deg, var(--dark-secondary) 0%, var(--dark-card) 100%); 
                                border-radius: 20px; 
                                padding: 60px 40px; 
                                border: 2px dashed var(--primary-color);">
                        <i class="fas fa-search fa-4x mb-4" style="color: var(--primary-color); opacity: 0.7;"></i>
                        <h3 class="text-white mb-3">Bu kategoride henüz tarif bulunmuyor</h3>
                        <p class="text-muted mb-4">{{ $category->name }} kategorisine ilk tarifi siz ekleyin!</p>
                        
                        <div class="d-flex gap-3 justify-content-center flex-wrap">
                            <a href="{{ route('recipes.create') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-plus me-2"></i>Tarif Ekle
                            </a>
                            <a href="{{ route('categories') }}" class="btn btn-outline-primary btn-lg">
                                <i class="fas fa-list me-2"></i>Diğer Kategoriler
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforelse
        </div>
        
        {{-- Sayfalama bölümü --}}
        @if($recipes->hasPages())
        <div class="row mt-5">
            <div class="col-12">
                {{ $recipes->links() }}
            </div>
        </div>
        @endif
    </div>
</div>

{{-- İlgili kategoriler bölümü - Dark tema ile --}}
<div class="related-categories py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-4">
                <h3 class="fw-bold text-white">Diğer Kategoriler</h3>
                <p class="text-muted">İlginizi çekebilecek diğer kategoriler</p>
            </div>
        </div>
        
        <div class="row g-3">
            @php
                $otherCategories = \App\Models\RecipeCategory::active()
                    ->where('slug', '!=', $category->slug)
                    ->ordered()
                    ->limit(4)
                    ->get();
            @endphp
            
            @foreach($otherCategories as $otherCategory)
            <div class="col-lg-3 col-md-6 col-6">
                <a href="{{ route('category', $otherCategory->slug) }}" 
                   class="btn btn-outline-primary w-100"
                   style="border-color: {{ $otherCategory->color ?? '#ff6b35' }}; color: {{ $otherCategory->color ?? '#ff6b35' }};">
                    <i class="{{ $otherCategory->icon ?? 'fas fa-tag' }} me-2"></i>
                    {{ $otherCategory->name }}
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

{{-- Sayfa özel CSS stilleri - Dark tema --}}
@section('extra-css')
<style>
/* Breadcrumb linkleri özelleştirmesi */
.breadcrumb-item a {
    text-decoration: none;
    transition: color 0.3s ease;
}

.breadcrumb-item a:hover {
    color: white !important;
}

/* Tarif kartları hover efektleri */
.recipe-card {
    transition: all 0.3s ease;
    border-radius: 15px;
    overflow: hidden;
    background-color: var(--dark-card);
    border: 1px solid var(--border-dark);
    color: var(--text-light);
}

.recipe-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(255, 107, 53, 0.2) !important;
}

/* Tarif resmi konteyner */
.recipe-image {
    position: relative;
    overflow: hidden;
}

.recipe-image img {
    height: 200px;
    width: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.recipe-card:hover .recipe-image img {
    transform: scale(1.05);
}

/* Tarif başlıkları */
.recipe-card .card-title {
    color: var(--text-light);
}

/* Hiç tarif olmadığında gösterilen mesaj */
.text-center h3 {
    color: var(--text-muted);
}

/* Sayfalama */
.pagination .page-link {
    background-color: var(--dark-card);
    border-color: var(--border-dark);
    color: var(--text-light);
}

.pagination .page-link:hover {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
    color: white;
}

.pagination .page-item.active .page-link {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}

.pagination .page-item.disabled .page-link {
    background-color: var(--dark-secondary);
    border-color: var(--border-dark);
    color: var(--text-muted);
}

/* Responsive tasarım düzenlemeleri */
@media (max-width: 768px) {
    .category-header {
        padding: 3rem 0;
    }
    
    .display-4 {
        font-size: 2rem;
    }
    
    .category-stats {
        text-align: left !important;
        margin-top: 1rem;
    }
}
</style>
@endsection
