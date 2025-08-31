{{-- Kategori detay sayfası - Belirli bir kategorideki tariflerin gösterildiği sayfa --}}
@extends('layouts.app')

@section('title', $categoryName . ' Tarifleri - Tarif Dünyası')

@section('content')
{{-- Kategori başlık bölümü - Dark tema ile --}}
<div class="category-header text-white py-5">
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
                            {{ $categoryName }}
                        </li>
                    </ol>
                </nav>
                
                {{-- Kategori başlığı --}}
                <h1 class="display-4 fw-bold mb-3">
                    {{ $categoryName }} Tarifleri
                </h1>
                <p class="lead mb-0">
                    En lezzetli {{ strtolower($categoryName) }} tariflerini keşfedin
                </p>
            </div>
            
            {{-- Kategori istatistikleri --}}
            <div class="col-md-4 text-end">
                <div class="category-stats">
                    <div class="stat-item mb-2">
                        <i class="fas fa-book-open me-2"></i>
                        <span class="fw-bold">{{ count($recipes) }}</span> Tarif
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-users me-2"></i>
                        <span class="fw-bold">{{ rand(50, 200) }}</span> Takipçi
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Filtre ve sıralama bölümü - Dark tema ile --}}
<div class="filters-section py-3 border-bottom">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                {{-- Sonuç sayısı göstergesi --}}
                <p class="mb-0 text-muted">
                    <strong>{{ count($recipes) }}</strong> tarif bulundu
                </p>
            </div>
            <div class="col-md-6">
                {{-- Sıralama seçenekleri --}}
                <div class="d-flex justify-content-end align-items-center">
                    <label class="form-label me-2 mb-0 text-white">Sırala:</label>
                    <select class="form-select form-select-sm" style="width: auto;">
                        <option>En Yeni</option>
                        <option>En Popüler</option>
                        <option>En Çok Beğenilen</option>
                        <option>Hazırlama Süresi</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Tarif listesi bölümü --}}
<div class="recipes-section py-5">
    <div class="container">
        <div class="row g-4">
            {{-- Her tarif için döngü başlatıyoruz --}}
            @forelse($recipes as $recipe)
            <div class="col-lg-3 col-md-6">
                {{-- Tarif kartı - Her tarif için ayrı bir kart oluşturuyoruz --}}
                <div class="recipe-card card h-100 shadow-sm border-0">
                    {{-- Tarif resmi yerine ikon kullanıyoruz --}}
                    <div class="recipe-image">
                        @if(isset($recipe['image']) && $recipe['image'])
                            <img src="{{ $recipe['image'] }}" 
                                 class="card-img-top" 
                                 alt="{{ $recipe['title'] }}">
                        @else
                            {{-- Görsel yoksa ikon gösterelim --}}
                            <div class="card-img-top d-flex align-items-center justify-content-center" 
                                 style="height: 200px; background: linear-gradient(135deg, var(--dark-secondary) 0%, var(--dark-card) 100%); border-bottom: 2px solid var(--primary-color);">
                                <div class="text-center">
                                    <i class="{{ $recipe['icon'] ?? 'fas fa-utensils' }}" style="font-size: 60px; color: var(--primary-color); opacity: 0.8;"></i>
                                    <p class="mt-2 mb-0 small text-muted">{{ $categoryName }} Tarifi</p>
                                </div>
                            </div>
                        @endif
                        
                        {{-- Favori ekleme butonu --}}
                        <button class="btn btn-sm btn-outline-light favorite-btn">
                            <i class="fas fa-heart"></i>
                        </button>
                    </div>
                    
                    {{-- Tarif bilgileri --}}
                    <div class="card-body p-3">
                        <h5 class="card-title mb-2">{{ $recipe['title'] }}</h5>
                        <p class="card-text text-muted small mb-3">
                            {{ $recipe['description'] }}
                        </p>
                        
                        {{-- Tarif meta bilgileri --}}
                        <div class="recipe-meta d-flex justify-content-between align-items-center small text-muted mb-3">
                            <span><i class="fas fa-clock me-1"></i>{{ $recipe['prep_time'] }}</span>
                            <span><i class="fas fa-star me-1 text-warning"></i>{{ $recipe['rating'] }}</span>
                            <span><i class="fas fa-user me-1"></i>{{ $recipe['author'] }}</span>
                        </div>
                    </div>
                    
                    {{-- Tarif aksiyonları --}}
                    <div class="card-footer bg-transparent border-0 p-3 pt-0">
                        <div class="d-grid">
                            <a href="#" class="btn btn-primary btn-sm">
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
                        <p class="text-muted mb-4">{{ $categoryName }} kategorisine ilk tarifi siz ekleyin!</p>
                        
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
        
        {{-- Sayfalama bölümü - Gelecekte sayfalama eklendiğinde kullanılacak --}}
        @if(count($recipes) > 0)
        <div class="row mt-5">
            <div class="col-12">
                <nav aria-label="Tarif sayfalama">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <span class="page-link">Önceki</span>
                        </li>
                        <li class="page-item active">
                            <span class="page-link">1</span>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">Sonraki</a>
                        </li>
                    </ul>
                </nav>
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
            {{-- İlgili kategoriler için örnek linkler --}}
            @php
                $otherCategories = [
                    ['name' => 'Ana Yemek', 'slug' => 'ana-yemek', 'color' => 'primary'],
                    ['name' => 'Tatlı', 'slug' => 'tatli', 'color' => 'danger'],
                    ['name' => 'Çorba', 'slug' => 'corba', 'color' => 'warning'],
                    ['name' => 'Salata', 'slug' => 'salata', 'color' => 'success']
                ];
                $filteredCategories = array_filter($otherCategories, function($cat) use ($categorySlug) {
                    return $cat['slug'] !== $categorySlug;
                });
            @endphp
            
            @foreach(array_slice($filteredCategories, 0, 4) as $category)
            <div class="col-lg-3 col-md-6 col-6">
                <a href="{{ route('category', $category['slug']) }}" 
                   class="btn btn-outline-{{ $category['color'] }} w-100">
                    {{ $category['name'] }}
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
/* Kategori başlık bölümü gradyan arka planı */
.category-header {
    background: linear-gradient(135deg, #1a1a1a 0%, #ff6b35 100%);
}

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
    object-fit: cover;
    transition: transform 0.3s ease;
}

.recipe-card:hover .recipe-image img {
    transform: scale(1.05);
}

/* Favori butonu */
.favorite-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    backdrop-filter: blur(10px);
    background: rgba(0,0,0,0.3);
    border: 1px solid rgba(255,255,255,0.2);
    transition: all 0.3s ease;
    color: white;
}

.favorite-btn:hover {
    background: var(--primary-color);
    color: white;
    transform: scale(1.1);
    border-color: var(--primary-color);
}

/* Filtre bölümü */
.filters-section {
    background-color: var(--dark-secondary);
    border-bottom: 1px solid var(--border-dark) !important;
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
    
    .filters-section .row > div {
        text-align: center;
        margin-bottom: 1rem;
    }
}
</style>
@endsection

{{-- Sayfa özel JavaScript kodları --}}
@section('extra-js')
<script>
// Favori butonuna tıklama olayları
document.addEventListener('DOMContentLoaded', function() {
    // Tüm favori butonlarını seç
    const favoriteButtons = document.querySelectorAll('.favorite-btn');
    
    favoriteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Buton durumunu değiştir
            const icon = this.querySelector('i');
            if (icon.classList.contains('fas')) {
                // Favorilerden çıkar
                icon.classList.remove('fas');
                icon.classList.add('far');
                this.classList.remove('btn-danger');
                this.classList.add('btn-outline-light');
            } else {
                // Favorilere ekle
                icon.classList.remove('far');
                icon.classList.add('fas');
                this.classList.remove('btn-outline-light');
                this.classList.add('btn-danger');
            }
            
            // Buton animasyonu
            this.style.transform = 'scale(0.9)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 150);
        });
    });
    
    // Sıralama seçimi değiştiğinde
    const sortSelect = document.querySelector('.form-select');
    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            // Burada AJAX ile tarifleri yeniden yükleyebiliriz
            console.log('Sıralama değişti:', this.value);
        });
    }
});
</script>
@endsection