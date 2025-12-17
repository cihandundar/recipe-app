{{-- Blog ana sayfası - Dark tema ile turuncu vurgu renkleri --}}
@extends('layouts.app')

@section('title', 'Blog - Mutfak Dünyası')

@section('content')
{{-- Blog ana sayfası container --}}
<div class="blog-page">
    {{-- Blog başlık bölümü - Hero section --}}
    <div class="blog-header py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="header-content">
                        <h1 class="display-4 fw-bold text-white mb-4">
                            <i class="fas fa-blog me-3"></i>Mutfak Blogu
                        </h1>
                        <p class="lead text-light mb-4">
                            Mutfak dünyasının en güncel haberleri, tarifler, ipuçları ve uzman önerileri burada!
                        </p>
                        <div class="blog-stats row g-3 justify-content-center">
                            <div class="col-md-4">
                                <div class="stat-card">
                                    <i class="fas fa-newspaper fa-2x text-primary mb-2"></i>
                                    <h5 class="text-white">{{ count($posts) }}+ Makale</h5>
                                    <p class="text-muted small">Uzman İçerikler</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stat-card">
                                    <i class="fas fa-users fa-2x text-primary mb-2"></i>
                                    <h5 class="text-white">{{ count($categories) }} Kategori</h5>
                                    <p class="text-muted small">Farklı Konular</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stat-card">
                                    <i class="fas fa-clock fa-2x text-primary mb-2"></i>
                                    <h5 class="text-white">Günlük Güncelleme</h5>
                                    <p class="text-muted small">Taze İçerikler</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Ana içerik bölümü --}}
    <div class="blog-content py-5">
        <div class="container">
            <div class="row">
                {{-- Sol taraf - Blog yazıları --}}
                <div class="col-lg-8">
                    {{-- Öne çıkan yazılar --}}
                    @php
                        $featuredPosts = $posts->where('is_featured', true);
                    @endphp
                    
                    @if($featuredPosts->count() > 0)
                        <div class="featured-posts mb-5">
                            <h2 class="section-title mb-4">
                                <i class="fas fa-star me-2 text-warning"></i>
                                Öne Çıkan Yazılar
                            </h2>
                            <div class="row g-4">
                                @foreach($featuredPosts->take(2) as $post)
                                    <div class="col-md-6">
                                        <article class="featured-post-card h-100">
                                            <div class="post-image">
                                                @if($post->featured_image)
                                                    <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="img-fluid">
                                                @else
                                                    <div class="placeholder-image">
                                                        <i class="fas fa-blog fa-3x text-primary"></i>
                                                    </div>
                                                @endif
                                                <div class="post-badge">
                                                    <span class="badge bg-warning text-dark">
                                                        <i class="fas fa-star me-1"></i>Öne Çıkan
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="post-content">
                                                <div class="post-meta mb-2">
                                                    <span class="text-primary">{{ $post->blogCategory->name }}</span>
                                                    <span class="text-muted mx-2">•</span>
                                                    <span class="text-muted">{{ $post->formatted_published_at }}</span>
                                                </div>
                                                <h3 class="post-title">
                                                    <a href="{{ route('blog.show', $post->slug) }}" class="text-decoration-none">
                                                        {{ $post->title }}
                                                    </a>
                                                </h3>
                                                <p class="post-excerpt text-muted">{{ $post->excerpt }}</p>
                                                <div class="post-footer">
                                                    <div class="author-info">
                                                        <i class="fas fa-user-circle text-primary me-2"></i>
                                                        <span class="text-light">{{ $post->author_name }}</span>
                                                    </div>
                                                    <div class="post-stats">
                                                        <span class="text-muted">
                                                            <i class="fas fa-clock me-1"></i>{{ $post->reading_time }}
                                                        </span>
                                                        <span class="text-muted ms-3">
                                                            <i class="fas fa-eye me-1"></i>{{ $post->views }}
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

                    {{-- Tüm blog yazıları --}}
                    <div class="all-posts">
                        <h2 class="section-title mb-4">
                            <i class="fas fa-list me-2 text-primary"></i>
                            Tüm Yazılar
                        </h2>
                        <div class="posts-grid">
                            @foreach($posts as $post)
                                <article class="post-card mb-4">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <div class="post-image">
                                                @if($post->featured_image)
                                                    <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="img-fluid">
                                                @else
                                                    <div class="placeholder-image">
                                                        <i class="fas fa-newspaper fa-2x text-primary"></i>
                                                    </div>
                                                @endif
                                                @if($post->is_featured)
                                                    <div class="post-badge">
                                                        <span class="badge bg-warning text-dark">
                                                            <i class="fas fa-star me-1"></i>Öne Çıkan
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="post-content">
                                                <div class="post-meta mb-2">
                                                    <span class="category-tag">{{ $post->blogCategory->name }}</span>
                                                    <span class="text-muted mx-2">•</span>
                                                    <span class="text-muted">{{ $post->formatted_published_at }}</span>
                                                </div>
                                                <h3 class="post-title">
                                                    <a href="{{ route('blog.show', $post->slug) }}" class="text-decoration-none">
                                                        {{ $post->title }}
                                                    </a>
                                                </h3>
                                                <p class="post-excerpt text-muted">{{ $post->excerpt }}</p>
                                                <div class="post-footer">
                                                    <div class="author-info">
                                                        <i class="fas fa-user-circle text-primary me-2"></i>
                                                        <span class="text-light">{{ $post->author_name }}</span>
                                                    </div>
                                                    <div class="post-stats">
                                                        <span class="text-muted">
                                                            <i class="fas fa-clock me-1"></i>{{ $post->reading_time }}
                                                        </span>
                                                        <span class="text-muted ms-3">
                                                            <i class="fas fa-eye me-1"></i>{{ number_format($post->views) }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-outline-primary btn-sm mt-3">
                                                    <i class="fas fa-arrow-right me-2"></i>Devamını Oku
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>

                    {{-- Sayfalama --}}
                    @if($posts->hasPages())
                        <div class="pagination-wrapper mt-5">
                            {{ $posts->links() }}
                        </div>
                    @endif
                </div>

                {{-- Sağ taraf - Sidebar --}}
                <div class="col-lg-4">
                    <div class="blog-sidebar">
                        {{-- Kategoriler widget --}}
                        <div class="widget categories-widget mb-4">
                            <h4 class="widget-title">
                                <i class="fas fa-folder me-2 text-primary"></i>
                                Kategoriler
                            </h4>
                            <div class="widget-content">
                                @foreach($categories as $category)
                                    <a href="#" class="category-item">
                                        <i class="fas fa-tag me-2 text-primary"></i>
                                        {{ $category->name }}
                                        <span class="post-count">{{ $category->published_posts_count }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        {{-- Popüler yazılar widget --}}
                        <div class="widget popular-posts-widget mb-4">
                            <h4 class="widget-title">
                                <i class="fas fa-fire me-2 text-primary"></i>
                                Popüler Yazılar
                            </h4>
                            <div class="widget-content">
                                @foreach($posts->where('views', '>', 1000)->take(5) as $index => $popularPost)
                                    <div class="popular-post-item">
                                        <div class="post-number">{{ $index + 1 }}</div>
                                        <div class="post-info">
                                            <h6 class="post-title">
                                                <a href="{{ route('blog.show', $popularPost->slug) }}" class="text-decoration-none">
                                                    {{ $popularPost->title }}
                                                </a>
                                            </h6>
                                            <div class="post-meta">
                                                <span class="text-muted">{{ $popularPost->formatted_published_at }}</span>
                                                <span class="mx-2">•</span>
                                                <span class="text-primary">{{ number_format($popularPost->views) }} görüntüleme</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Newsletter widget --}}
                        <div class="widget newsletter-widget mb-4">
                            <h4 class="widget-title">
                                <i class="fas fa-envelope me-2 text-primary"></i>
                                Bültenimize Katılın
                            </h4>
                            <div class="widget-content">
                                <p class="text-muted">Yeni tarifler ve mutfak ipuçları direkt e-mail kutunuzda!</p>
                                <form class="newsletter-form">
                                    <div class="input-group">
                                        <input type="email" class="form-control" placeholder="E-mail adresiniz">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-paper-plane"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- Sosyal medya widget --}}
                        <div class="widget social-widget">
                            <h4 class="widget-title">
                                <i class="fas fa-share-alt me-2 text-primary"></i>
                                Bizi Takip Edin
                            </h4>
                            <div class="widget-content">
                                <div class="social-links">
                                    <a href="#" class="social-link facebook" target="_blank">
                                        <i class="fab fa-facebook-f"></i>
                                        <span>Facebook</span>
                                    </a>
                                    <a href="#" class="social-link instagram" target="_blank">
                                        <i class="fab fa-instagram"></i>
                                        <span>Instagram</span>
                                    </a>
                                    <a href="#" class="social-link youtube" target="_blank">
                                        <i class="fab fa-youtube"></i>
                                        <span>YouTube</span>
                                    </a>
                                    <a href="#" class="social-link pinterest" target="_blank">
                                        <i class="fab fa-pinterest"></i>
                                        <span>Pinterest</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-css')
<style>
/* Pagination stilleri */
.pagination-wrapper {
    display: flex;
    justify-content: center;
}

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
    color: white;
}

.pagination .page-item.disabled .page-link {
    background-color: var(--dark-secondary);
    border-color: var(--border-dark);
    color: var(--text-muted);
    cursor: not-allowed;
}
</style>
@endsection