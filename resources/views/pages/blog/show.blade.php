{{-- Blog yazısı detay sayfası - Dark tema ile tasarlandı --}}
@extends('layouts.app')

@section('title', $post->seo_title . ' - Blog')

@section('content')
{{-- Blog detay sayfası container --}}
<div class="blog-detail-page">
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
                        <a href="{{ route('blog.index') }}" class="text-decoration-none">Blog</a>
                    </li>
                    <li class="breadcrumb-item active text-primary" aria-current="page">
                        {{ $post->title }}
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container py-5">
        <div class="row">
            {{-- Sol taraf - Blog yazısı içeriği --}}
            <div class="col-lg-8">
                <article class="blog-article">
                    {{-- Makale başlığı ve meta bilgileri --}}
                    <header class="article-header mb-4">
                        <div class="article-meta mb-3">
                            <span class="category-badge">
                                <i class="fas fa-folder me-1"></i>{{ $post->blogCategory->name }}
                            </span>
                            <span class="text-muted mx-3">•</span>
                            <span class="publish-date text-muted">
                                <i class="fas fa-calendar me-1"></i>
                                {{ $post->formatted_published_at }}
                            </span>
                            <span class="text-muted mx-3">•</span>
                            <span class="read-time text-muted">
                                <i class="fas fa-clock me-1"></i>{{ $post->reading_time }}
                            </span>
                        </div>
                        
                        <h1 class="article-title text-white mb-4">{{ $post->title }}</h1>
                        
                        <div class="author-section">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="author-info">
                                    <div class="author-avatar">
                                        <i class="fas fa-user-circle fa-3x text-primary"></i>
                                    </div>
                                    <div class="author-details">
                                        <h6 class="author-name text-white mb-1">{{ $post->author_name }}</h6>
                                        <p class="author-role text-muted mb-0">{{ $post->author_title ?: 'Mutfak Uzmanı' }}</p>
                                    </div>
                                </div>
                                <div class="article-stats">
                                    <div class="stat-item">
                                        <i class="fas fa-eye text-primary me-1"></i>
                                        <span class="text-muted">{{ number_format($post->views) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>

                    {{-- Öne çıkan görsel --}}
                    <div class="featured-image mb-5">
                        @if($post->featured_image)
                            <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="img-fluid rounded">
                        @else
                            <div class="placeholder-featured-image">
                                <i class="fas fa-image fa-5x text-primary"></i>
                                <p class="text-muted mt-3">{{ $post->title }}</p>
                            </div>
                        @endif
                    </div>

                    {{-- Makale içeriği --}}
                    <div class="article-content">
                        {!! $post->content !!}
                    </div>

                    {{-- Etiketler --}}
                    @if($post->tags && count($post->tags) > 0)
                        <div class="article-tags mt-5 pt-4 border-top border-secondary">
                            <h6 class="text-white mb-3">
                                <i class="fas fa-tags me-2 text-primary"></i>Etiketler:
                            </h6>
                            <div class="tags-list">
                                @foreach($post->tags as $tag)
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
                            <i class="fas fa-share-alt me-2 text-primary"></i>Bu Yazıyı Paylaş:
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

                {{-- İlgili yazılar --}}
                @if(count($relatedPosts) > 0)
                    <div class="related-posts mt-5">
                        <h3 class="section-title mb-4">
                            <i class="fas fa-bookmark me-2 text-primary"></i>
                            İlgili Yazılar
                        </h3>
                        <div class="row g-4">
                            @foreach($relatedPosts as $relatedPost)
                                <div class="col-md-6">
                                    <div class="related-post-card">
                                        <div class="post-image">
                                            <div class="placeholder-image">
                                                <i class="fas fa-newspaper fa-2x text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="post-content">
                                            <h5 class="post-title">
                                                <a href="{{ route('blog.show', $relatedPost->slug) }}" class="text-decoration-none">
                                                    {{ $relatedPost->title }}
                                                </a>
                                            </h5>
                                            <p class="post-excerpt text-muted">{{ $relatedPost->excerpt }}</p>
                                            <div class="post-meta">
                                                <span class="text-muted">
                                                    <i class="fas fa-clock me-1"></i>{{ $relatedPost->reading_time }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Yorum bölümü --}}
                <div class="comments-section mt-5">
                    <h3 class="section-title mb-4">
                        <i class="fas fa-comments me-2 text-primary"></i>
                        Yorumlar <span class="text-muted">(3)</span>
                    </h3>

                    {{-- Yorum yazma formu --}}
                    <div class="comment-form mb-5">
                        <h5 class="text-white mb-3">Yorum Yap</h5>
                        <form>
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="Adınız" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" placeholder="E-mail adresiniz" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" rows="4" placeholder="Yorumunuzu yazın..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane me-2"></i>Yorum Gönder
                            </button>
                        </form>
                    </div>

                    {{-- Yorumlar listesi --}}
                    <div class="comments-list">
                        {{-- Yorum 1 --}}
                        <div class="comment-item mb-4">
                            <div class="comment-avatar">
                                <i class="fas fa-user-circle fa-3x text-primary"></i>
                            </div>
                            <div class="comment-content">
                                <div class="comment-header">
                                    <h6 class="commenter-name text-white">Ayşe K.</h6>
                                    <span class="comment-date text-muted">3 gün önce</span>
                                </div>
                                <p class="comment-text text-muted">
                                    Harika bir tarif! Ben de denedim ve gerçekten çok lezzetli oldu. Teşekkürler!
                                </p>
                                <div class="comment-actions">
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-thumbs-up me-1"></i>Beğen (5)
                                    </button>
                                    <button class="btn btn-sm btn-outline-secondary ms-2">
                                        <i class="fas fa-reply me-1"></i>Yanıtla
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Yorum 2 --}}
                        <div class="comment-item mb-4">
                            <div class="comment-avatar">
                                <i class="fas fa-user-circle fa-3x text-primary"></i>
                            </div>
                            <div class="comment-content">
                                <div class="comment-header">
                                    <h6 class="commenter-name text-white">Mehmet D.</h6>
                                    <span class="comment-date text-muted">1 hafta önce</span>
                                </div>
                                <p class="comment-text text-muted">
                                    Maya miktarını biraz artırdım ve daha güzel oldu. Öneri için teşekkürler.
                                </p>
                                <div class="comment-actions">
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-thumbs-up me-1"></i>Beğen (2)
                                    </button>
                                    <button class="btn btn-sm btn-outline-secondary ms-2">
                                        <i class="fas fa-reply me-1"></i>Yanıtla
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Yorum 3 --}}
                        <div class="comment-item">
                            <div class="comment-avatar">
                                <i class="fas fa-user-circle fa-3x text-primary"></i>
                            </div>
                            <div class="comment-content">
                                <div class="comment-header">
                                    <h6 class="commenter-name text-white">Fatma S.</h6>
                                    <span class="comment-date text-muted">2 hafta önce</span>
                                </div>
                                <p class="comment-text text-muted">
                                    İlk defa ekmek yapıyorum ve bu tarif sayesinde başardım! Çok net anlatılmış.
                                </p>
                                <div class="comment-actions">
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-thumbs-up me-1"></i>Beğen (8)
                                    </button>
                                    <button class="btn btn-sm btn-outline-secondary ms-2">
                                        <i class="fas fa-reply me-1"></i>Yanıtla
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sağ taraf - Sidebar --}}
            <div class="col-lg-4">
                <div class="blog-sidebar">
                    {{-- Yazar bilgisi --}}
                    <div class="widget author-widget mb-4">
                        <h4 class="widget-title">
                            <i class="fas fa-user me-2 text-primary"></i>
                            Yazar Hakkında
                        </h4>
                        <div class="widget-content">
                            <div class="author-card">
                                <div class="author-avatar">
                                    <i class="fas fa-user-circle fa-4x text-primary"></i>
                                </div>
                                <div class="author-info">
                                    <h5 class="author-name text-white">{{ $post->author_name }}</h5>
                                    <p class="author-title text-primary">{{ $post->author_title ?: 'Mutfak Uzmanı' }}</p>
                                    <p class="author-bio text-muted">
                                        {{ $post->author_bio ?: '15 yıllık deneyime sahip mutfak uzmanı. Geleneksel lezzetleri modern tekniklerle harmanlayarak benzersiz tarifler oluşturuyor. Yemek pişirme sanatını sizlerle paylaşmaktan mutluluk duyuyor.' }}
                                    </p>
                                    <div class="author-social">
                                        <a href="#" class="social-link me-2" title="Instagram">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                        <a href="#" class="social-link me-2" title="YouTube">
                                            <i class="fab fa-youtube"></i>
                                        </a>
                                        <a href="#" class="social-link" title="Twitter">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Son yazılar --}}
                    <div class="widget recent-posts-widget mb-4">
                        <h4 class="widget-title">
                            <i class="fas fa-clock me-2 text-primary"></i>
                            Son Yazılar
                        </h4>
                        <div class="widget-content">
                            @for($i = 1; $i <= 4; $i++)
                                <div class="recent-post-item">
                                    <div class="post-image">
                                        <div class="placeholder-image">
                                            <i class="fas fa-newspaper text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="post-info">
                                        <h6 class="post-title">
                                            <a href="#" class="text-decoration-none">
                                                Örnek Blog Yazısı {{ $i }}
                                            </a>
                                        </h6>
                                        <div class="post-meta">
                                            <span class="text-muted">{{ rand(1, 7) }} gün önce</span>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>

                    {{-- Newsletter --}}
                    <div class="widget newsletter-widget">
                        <h4 class="widget-title">
                            <i class="fas fa-envelope me-2 text-primary"></i>
                            Bültenimize Katılın
                        </h4>
                        <div class="widget-content">
                            <p class="text-muted">Yeni yazılarımızdan haberdar olmak için e-mail listemize katılın!</p>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection