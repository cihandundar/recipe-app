<footer class="footer-section bg-dark text-white py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Logo ve Açıklama -->
            <div class="col-lg-4 col-md-6">
                <div class="footer-brand">
                    <h4 class="fw-bold mb-3">
                        <i class="fas fa-utensils me-2 text-primary"></i>
                        Tarif Dünyası
                    </h4>
                    <p class="text-light-emphasis mb-3">
                        Lezzetli tariflerin ve mutfak deneyimlerinin buluşma noktası. 
                        En iyi tariflerle sofranızı zenginleştirin.
                    </p>
                    <div class="social-links">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook fa-lg"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-twitter fa-lg"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-youtube fa-lg"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-pinterest fa-lg"></i></a>
                    </div>
                </div>
            </div>
            
            <!-- Hızlı Linkler -->
            <div class="col-lg-2 col-md-6">
                <h5 class="fw-bold mb-3">Hızlı Linkler</h5>
                <ul class="list-unstyled footer-links">
                    <li><a href="{{ route('home') }}" class="text-light-emphasis">Ana Sayfa</a></li>
                    <li><a href="{{ route('recipes.index') }}" class="text-light-emphasis">Tarifler</a></li>
                    <li><a href="{{ route('categories') }}" class="text-light-emphasis">Kategoriler</a></li>
                    <li><a href="{{ route('blog.index') }}" class="text-light-emphasis">Blog</a></li>
                    <li><a href="{{ route('contact') }}" class="text-light-emphasis">İletişim</a></li>
                </ul>
            </div>
            
            <!-- Kategoriler -->
            <div class="col-lg-2 col-md-6">
                <h5 class="fw-bold mb-3">Kategoriler</h5>
                <ul class="list-unstyled footer-links">
                    <li><a href="{{ route('category', 'ana-yemek') }}" class="text-light-emphasis">Ana Yemek</a></li>
                    <li><a href="{{ route('category', 'tatli') }}" class="text-light-emphasis">Tatlı</a></li>
                    <li><a href="{{ route('category', 'corba') }}" class="text-light-emphasis">Çorba</a></li>
                    <li><a href="{{ route('category', 'salata') }}" class="text-light-emphasis">Salata</a></li>
                    <li><a href="{{ route('category', 'icecek') }}" class="text-light-emphasis">İçecek</a></li>
                </ul>
            </div>
            
            <!-- İletişim Bilgileri -->
            <div class="col-lg-4 col-md-6">
                <h5 class="fw-bold mb-3">İletişim</h5>
                <div class="contact-info">
                    <div class="contact-item mb-2">
                        <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                        <span class="text-light-emphasis">İstanbul, Türkiye</span>
                    </div>
                    <div class="contact-item mb-2">
                        <i class="fas fa-phone me-2 text-primary"></i>
                        <span class="text-light-emphasis">+90 555 123 4567</span>
                    </div>
                    <div class="contact-item mb-3">
                        <i class="fas fa-envelope me-2 text-primary"></i>
                        <span class="text-light-emphasis">info@tarifdunyasi.com</span>
                    </div>
                </div>
                
                <!-- Newsletter -->
                <div class="newsletter-form">
                    <h6 class="fw-bold mb-2">Bülten</h6>
                    <p class="text-light-emphasis small mb-3">Yeni tariflerden haberdar olun</p>
                    <form class="d-flex">
                        <input type="email" 
                               class="form-control me-2" 
                               placeholder="E-mail adresiniz" 
                               required>
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Alt Kısım -->
        <hr class="my-4 border-secondary">
        <div class="row align-items-center">
            <div class="col-md-6">
                <p class="mb-0 text-light-emphasis">
                    &copy; {{ date('Y') }} Tarif Dünyası. Tüm hakları saklıdır.
                </p>
            </div>
            <div class="col-md-6">
                <div class="footer-bottom-links text-md-end">
                    <a href="#" class="text-light-emphasis me-3">Gizlilik Politikası</a>
                    <a href="#" class="text-light-emphasis me-3">Kullanım Şartları</a>
                    <a href="#" class="text-light-emphasis">Çerez Politikası</a>
                </div>
            </div>
        </div>
    </div>
</footer>