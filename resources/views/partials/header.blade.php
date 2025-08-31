{{-- Ana header - Desktop için 2 katmanlı, mobil için hamburger menü --}}
<header class="header-section bg-white shadow-sm">
    {{-- Desktop için üst katman - İletişim bilgileri (sadece desktop'ta görünür) --}}

    <div class="container">
        {{-- Desktop için ana header satırı --}}
        <div class="main-header py-3 d-none d-lg-block">
            <div class="row align-items-center">
                {{-- Sol taraf - Logo --}}
                <div class="col-lg-3">
                    <div class="logo">
                        <a href="{{ route('home') }}" class="text-decoration-none">
                            <h3 class="mb-0 text-primary fw-bold">
                                <i class="fas fa-utensils me-2"></i>
                                Tarif Dünyası
                            </h3>
                        </a>
                    </div>
                </div>
                
                {{-- Orta - Navigasyon linkleri --}}
                <div class="col-lg-6">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="navbar-nav mx-auto">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Ana Sayfa</a>
                            <a class="nav-link {{ request()->routeIs('recipes.*') ? 'active' : '' }}" href="{{ route('recipes.index') }}">Tarifler</a>
                            
                            {{-- Kategoriler dropdown --}}
                            <div class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                    Kategoriler
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('category', 'ana-yemek') }}">Ana Yemek</a></li>
                                    <li><a class="dropdown-item" href="{{ route('category', 'tatli') }}">Tatlı</a></li>
                                    <li><a class="dropdown-item" href="{{ route('category', 'corba') }}">Çorba</a></li>
                                    <li><a class="dropdown-item" href="{{ route('category', 'salata') }}">Salata</a></li>
                                    <li><a class="dropdown-item" href="{{ route('category', 'icecek') }}">İçecek</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="{{ route('categories') }}">Tüm Kategoriler</a></li>
                                </ul>
                            </div>
                            
                            <a class="nav-link {{ request()->routeIs('blog.*') ? 'active' : '' }}" href="{{ route('blog.index') }}">Blog</a>
                            <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">İletişim</a>
                        </div>
                    </nav>
                </div>
                
                {{-- Sağ taraf - Kullanıcı işlemleri --}}
                <div class="col-lg-3 text-end">
                    <div class="user-actions">
                        @auth
                            {{-- Giriş yapmış kullanıcı için tek dropdown --}}
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-user me-2"></i>{{ Auth::user()->name }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="fas fa-user me-2"></i>Profilim</a></li>
                                    <li><a class="dropdown-item" href="{{ route('my-recipes') }}"><i class="fas fa-book me-2"></i>Tariflerim</a></li>
                                    <li><a class="dropdown-item" href="{{ route('favorites') }}"><i class="fas fa-heart me-2"></i>Favorilerim</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-success fw-semibold" href="{{ route('recipes.create') }}"><i class="fas fa-plus me-2"></i>Tarif Ekle</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button class="dropdown-item" type="submit">
                                                <i class="fas fa-sign-out-alt me-2"></i>Çıkış Yap
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @else
                            {{-- Giriş yapmamış kullanıcı için --}}
                            <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">
                                <i class="fas fa-sign-in-alt me-2"></i>Giriş Yap
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-primary">
                                <i class="fas fa-user-plus me-2"></i>Kayıt Ol
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        {{-- Mobil header - Sadece mobilde görünür --}}
        <div class="mobile-header py-3 d-lg-none">
            <div class="d-flex align-items-center justify-content-between">
                {{-- Sol taraf - Logo bölümü --}}
                <div class="mobile-logo">
                    <a href="{{ route('home') }}" class="text-decoration-none">
                        <h5 class="mb-0 text-primary fw-bold">
                            <i class="fas fa-utensils me-2"></i>
                            Tarif Dünyası
                        </h5>
                    </a>
                </div>
                                {{-- Sağ taraf - Hamburger menü butonu --}}
                <div class="mobile-menu-toggle">
                    <button class="hamburger-menu" 
                            type="button" 
                            data-bs-toggle="offcanvas" 
                            data-bs-target="#mobileMenu" 
                            aria-controls="mobileMenu"
                            aria-expanded="false" 
                            aria-label="Menüyü aç">
                        {{-- Hamburger icon - 3 çizgi --}}
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Mobil offcanvas menü - Sağdan açılacak --}}
    <div class="offcanvas offcanvas-end" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
        {{-- Offcanvas header - Menü başlığı ve kapatma butonu --}}
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="mobileMenuLabel">
                <i class="fas fa-utensils me-2 text-primary"></i>
                Tarif Dünyası
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Kapat"></button>
        </div>
        
        {{-- Offcanvas body - Menü içeriği --}}
        <div class="offcanvas-body">
            {{-- Arama kutusu - Mobil için --}}
            <div class="search-section mb-4">
                <form action="{{ route('recipes.search') }}" method="GET">
                    <div class="input-group">
                        <input type="text" 
                               name="search" 
                               class="form-control" 
                               placeholder="Tarif, malzeme ara..."
                               value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>

            {{-- Ana navigasyon menü linkleri --}}
            <nav class="mobile-nav">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" 
                           href="{{ route('home') }}"
                           data-bs-dismiss="offcanvas">
                            <i class="fas fa-home me-2"></i>Ana Sayfa
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('recipes.*') ? 'active' : '' }}" 
                           href="{{ route('recipes.index') }}"
                           data-bs-dismiss="offcanvas">
                            <i class="fas fa-book-open me-2"></i>Tarifler
                        </a>
                    </li>
                    
                    {{-- Kategoriler dropdown --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" 
                           href="#" 
                           role="button" 
                           data-bs-toggle="dropdown" 
                           aria-expanded="false">
                            <i class="fas fa-list me-2"></i>Kategoriler
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('category', 'ana-yemek') }}" data-bs-dismiss="offcanvas">Ana Yemek</a></li>
                            <li><a class="dropdown-item" href="{{ route('category', 'tatli') }}" data-bs-dismiss="offcanvas">Tatlı</a></li>
                            <li><a class="dropdown-item" href="{{ route('category', 'corba') }}" data-bs-dismiss="offcanvas">Çorba</a></li>
                            <li><a class="dropdown-item" href="{{ route('category', 'salata') }}" data-bs-dismiss="offcanvas">Salata</a></li>
                            <li><a class="dropdown-item" href="{{ route('category', 'icecek') }}" data-bs-dismiss="offcanvas">İçecek</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('categories') }}" data-bs-dismiss="offcanvas">Tüm Kategoriler</a></li>
                        </ul>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('blog.*') ? 'active' : '' }}" 
                           href="{{ route('blog.index') }}"
                           data-bs-dismiss="offcanvas">
                            <i class="fas fa-newspaper me-2"></i>Blog
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" 
                           href="{{ route('contact') }}"
                           data-bs-dismiss="offcanvas">
                            <i class="fas fa-envelope me-2"></i>İletişim
                        </a>
                    </li>
                </ul>
            </nav>

            {{-- Kullanıcı işlemleri bölümü --}}
            <div class="user-section mt-4 pt-4 border-top">
                @auth
                    {{-- Giriş yapmış kullanıcı için --}}
                    <div class="user-info mb-3">
                        <div class="d-flex align-items-center">
                            <div class="user-avatar me-3">
                                <i class="fas fa-user-circle fa-2x text-primary"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                                <small class="text-muted">Hoş geldiniz!</small>
                            </div>
                        </div>
                    </div>
                    
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile') }}" data-bs-dismiss="offcanvas">
                                <i class="fas fa-user me-2"></i>Profilim
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('my-recipes') }}" data-bs-dismiss="offcanvas">
                                <i class="fas fa-book me-2"></i>Tariflerim
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('favorites') }}" data-bs-dismiss="offcanvas">
                                <i class="fas fa-heart me-2"></i>Favorilerim
                            </a>
                        </li>
                        <li class="nav-item">
                            <hr class="my-2 border-secondary">
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-success text-white mt-2" 
                               href="{{ route('recipes.create') }}" 
                               data-bs-dismiss="offcanvas">
                                <i class="fas fa-plus me-2"></i>Tarif Ekle
                            </a>
                        </li>
                        <li class="nav-item">
                            <hr class="my-2 border-secondary">
                        </li>
                        <li class="nav-item mt-3">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="nav-link btn btn-outline-danger w-100" type="submit">
                                    <i class="fas fa-sign-out-alt me-2"></i>Çıkış Yap
                                </button>
                            </form>
                        </li>
                    </ul>
                @else
                    {{-- Giriş yapmamış kullanıcı için --}}
                    <div class="guest-actions">
                        <a href="{{ route('login') }}" 
                           class="btn btn-outline-primary w-100 mb-2"
                           data-bs-dismiss="offcanvas">
                            <i class="fas fa-sign-in-alt me-2"></i>Giriş Yap
                        </a>
                        <a href="{{ route('register') }}" 
                           class="btn btn-primary w-100"
                           data-bs-dismiss="offcanvas">
                            <i class="fas fa-user-plus me-2"></i>Kayıt Ol
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</header>