{{-- İletişim sayfası - Dark tema ile turuncu vurgu renkleri kullanılarak tasarlandı --}}
@extends('layouts.app')

@section('title', 'İletişim - Tarif Dünyası')

@section('content')
{{-- İletişim sayfası ana bölümü --}}
<div class="contact-page">
    {{-- Sayfa başlık bölümü - Hero section gradient arka plan ile --}}
    <div class="contact-header py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    {{-- Sayfa başlığı ve açıklama --}}
                    <div class="header-content">
                        <h1 class="display-4 fw-bold text-white mb-4">
                            <i class="fas fa-envelope me-3"></i>İletişim
                        </h1>
                        <p class="lead text-light mb-4">
                            Bizimle iletişime geçin! Sorularınız, önerileriniz ve tarif paylaşımlarınız için buradayız.
                        </p>
                        <div class="contact-stats row g-3 justify-content-center">
                            {{-- İstatistik kartları --}}
                            <div class="col-md-4">
                                <div class="stat-card">
                                    <i class="fas fa-clock fa-2x text-primary mb-2"></i>
                                    <h5 class="text-white">24 Saat İçinde</h5>
                                    <p class="text-muted small">Yanıt Veriyoruz</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stat-card">
                                    <i class="fas fa-users fa-2x text-primary mb-2"></i>
                                    <h5 class="text-white">Uzman Ekip</h5>
                                    <p class="text-muted small">Size Yardım Eder</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stat-card">
                                    <i class="fas fa-heart fa-2x text-primary mb-2"></i>
                                    <h5 class="text-white">Mutfak Tutkusu</h5>
                                    <p class="text-muted small">Bizimle Paylaşın</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Ana içerik bölümü --}}
    <div class="contact-content py-5">
        <div class="container">
            <div class="row g-5">
                {{-- Sol taraf - İletişim formu --}}
                <div class="col-lg-8">
                    <div class="contact-form-section">
                        <h2 class="fw-bold text-white mb-4">
                            <i class="fas fa-paper-plane me-2 text-primary"></i>
                            Bize Mesaj Gönderin
                        </h2>
                        <p class="text-muted mb-4">
                            Aşağıdaki formu doldurarak bizimle iletişime geçebilirsiniz. En kısa sürede size geri dönüş yapacağız.
                        </p>

                        {{-- Başarı ve hata mesajlarını göster --}}
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Kapat"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Kapat"></button>
                            </div>
                        @endif

                        {{-- İletişim formu --}}
                        <form action="{{ route('contact.store') }}" method="POST" class="contact-form">
                            @csrf
                            <div class="row g-3">
                                {{-- Ad Soyad alanı --}}
                                <div class="col-md-6">
                                    <label for="name" class="form-label fw-semibold">
                                        <i class="fas fa-user me-2 text-primary"></i>Ad Soyad
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name') }}"
                                           placeholder="Adınızı ve soyadınızı girin" 
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- E-mail alanı --}}
                                <div class="col-md-6">
                                    <label for="email" class="form-label fw-semibold">
                                        <i class="fas fa-envelope me-2 text-primary"></i>E-mail Adresi
                                    </label>
                                    <input type="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email') }}"
                                           placeholder="E-mail adresinizi girin" 
                                           required>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- Telefon alanı --}}
                                <div class="col-md-6">
                                    <label for="phone" class="form-label fw-semibold">
                                        <i class="fas fa-phone me-2 text-primary"></i>Telefon (İsteğe Bağlı)
                                    </label>
                                    <input type="tel" 
                                           class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone" 
                                           name="phone" 
                                           value="{{ old('phone') }}"
                                           placeholder="Telefon numaranızı girin">
                                    @error('phone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- Konu alanı --}}
                                <div class="col-md-6">
                                    <label for="subject" class="form-label fw-semibold">
                                        <i class="fas fa-tag me-2 text-primary"></i>Konu
                                    </label>
                                    <select class="form-select @error('subject') is-invalid @enderror" id="subject" name="subject" required>
                                        <option value="">Konu seçiniz</option>
                                        <option value="genel" {{ old('subject') == 'genel' ? 'selected' : '' }}>Genel Bilgi</option>
                                        <option value="tarif" {{ old('subject') == 'tarif' ? 'selected' : '' }}>Tarif Önerisi</option>
                                        <option value="teknik" {{ old('subject') == 'teknik' ? 'selected' : '' }}>Teknik Destek</option>
                                        <option value="reklam" {{ old('subject') == 'reklam' ? 'selected' : '' }}>Reklam ve İş Birliği</option>
                                        <option value="sikayet" {{ old('subject') == 'sikayet' ? 'selected' : '' }}>Şikayet</option>
                                        <option value="diger" {{ old('subject') == 'diger' ? 'selected' : '' }}>Diğer</option>
                                    </select>
                                    @error('subject')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- Mesaj alanı --}}
                                <div class="col-12">
                                    <label for="message" class="form-label fw-semibold">
                                        <i class="fas fa-comment me-2 text-primary"></i>Mesajınız
                                    </label>
                                    <textarea class="form-control @error('message') is-invalid @enderror" 
                                              id="message" 
                                              name="message" 
                                              rows="6" 
                                              placeholder="Mesajınızı buraya yazın..." 
                                              required>{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- Gönder butonu --}}
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-paper-plane me-2"></i>
                                        Mesajı Gönder
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Sağ taraf - İletişim bilgileri --}}
                <div class="col-lg-4">
                    <div class="contact-info-section">
                        <h3 class="fw-bold text-white mb-4">
                            <i class="fas fa-info-circle me-2 text-primary"></i>
                            İletişim Bilgileri
                        </h3>

                        {{-- İletişim kartları --}}
                        <div class="contact-cards">
                            {{-- Adres kartı --}}
                            <div class="contact-card mb-4">
                                <div class="card-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="card-content">
                                    <h5 class="fw-bold text-white mb-2">Adres</h5>
                                    <p class="text-muted mb-0">
                                        Tarif Dünyası Merkez Ofisi<br>
                                        Kadıköy, İstanbul<br>
                                        Türkiye 34710
                                    </p>
                                </div>
                            </div>

                            {{-- Telefon kartı --}}
                            <div class="contact-card mb-4">
                                <div class="card-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="card-content">
                                    <h5 class="fw-bold text-white mb-2">Telefon</h5>
                                    <p class="text-muted mb-1">
                                        <a href="tel:+905551234567" class="text-decoration-none">
                                            +90 555 123 4567
                                        </a>
                                    </p>
                                    <small class="text-muted">Pazartesi - Cuma: 09:00 - 18:00</small>
                                </div>
                            </div>

                            {{-- E-mail kartı --}}
                            <div class="contact-card mb-4">
                                <div class="card-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="card-content">
                                    <h5 class="fw-bold text-white mb-2">E-mail</h5>
                                    <p class="text-muted mb-1">
                                        <a href="mailto:info@tarifdunyasi.com" class="text-decoration-none">
                                            info@tarifdunyasi.com
                                        </a>
                                    </p>
                                    <p class="text-muted mb-0">
                                        <a href="mailto:destek@tarifdunyasi.com" class="text-decoration-none">
                                            destek@tarifdunyasi.com
                                        </a>
                                    </p>
                                </div>
                            </div>

                        </div>

                        {{-- Çalışma saatleri --}}
                        <div class="working-hours mt-5">
                            <h4 class="fw-bold text-white mb-3">
                                <i class="fas fa-clock me-2 text-primary"></i>
                                Çalışma Saatleri
                            </h4>
                            <div class="hours-list">
                                <div class="hour-item d-flex justify-content-between mb-2">
                                    <span class="text-muted">Pazartesi - Cuma:</span>
                                    <span class="text-white fw-semibold">09:00 - 18:00</span>
                                </div>
                                <div class="hour-item d-flex justify-content-between mb-2">
                                    <span class="text-muted">Cumartesi:</span>
                                    <span class="text-white fw-semibold">10:00 - 16:00</span>
                                </div>
                                <div class="hour-item d-flex justify-content-between">
                                    <span class="text-muted">Pazar:</span>
                                    <span class="text-warning fw-semibold">Kapalı</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SSS (Sık Sorulan Sorular) bölümü --}}
    <div class="faq-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-header text-center mb-5">
                        <h2 class="fw-bold text-white mb-3">
                            <i class="fas fa-question-circle me-2 text-primary"></i>
                            Sık Sorulan Sorular
                        </h2>
                        <p class="text-muted">
                            En çok merak edilen soruların yanıtlarını burada bulabilirsiniz.
                        </p>
                    </div>

                    {{-- Accordion FAQ --}}
                    <div class="accordion" id="faqAccordion">
                        {{-- FAQ 1 --}}
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    Nasıl tarif paylaşabilirim?
                                </button>
                            </h3>
                            <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Tarif paylaşmak için önce ücretsiz hesap oluşturmanız gerekiyor. Hesabınızı oluşturduktan sonra "Tarif Ekle" butonuna tıklayarak kendi lezzetli tariflerinizi paylaşabilirsiniz.
                                </div>
                            </div>
                        </div>

                        {{-- FAQ 2 --}}
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    Tarif Dünyası ücretsiz mi?
                                </button>
                            </h3>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Evet! Tarif Dünyası tamamen ücretsizdir. Tüm tarifleri görebilir, favorilerinize ekleyebilir ve kendi tariflerinizi paylaşabilirsiniz.
                                </div>
                            </div>
                        </div>

                        {{-- FAQ 3 --}}
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    Tarif önerisi nasıl gönderebilirim?
                                </button>
                            </h3>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Bu sayfadaki iletişim formunu kullanarak tarif önerilerinizi gönderebilirsiniz. Konu kısmından "Tarif Önerisi"ni seçmeyi unutmayın.
                                </div>
                            </div>
                        </div>

                        {{-- FAQ 4 --}}
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                    Teknik sorun yaşıyorum, ne yapmalıyım?
                                </button>
                            </h3>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Teknik sorunlar için destek@tarifdunyasi.com adresine e-mail gönderebilir veya iletişim formunda "Teknik Destek" konusunu seçebilirsiniz.
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

{{-- İletişim sayfası özel CSS stilleri - Dark tema ve turuncu vurgu renkleri --}}
@section('extra-css')
<style>
/* İletişim sayfası ana container */
.contact-page {
    background-color: var(--dark-bg);
    min-height: calc(100vh - 200px);
}

/* Sayfa başlık bölümü gradient arka plan */
.contact-header {
    background: linear-gradient(135deg, #1a1a1a 0%, #ff6b35 100%);
    position: relative;
    overflow: hidden;
}

.contact-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="%23ffffff" opacity="0.05"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    pointer-events: none;
}

/* İstatistik kartları */
.stat-card {
    text-align: center;
    padding: 20px;
    border-radius: 15px;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 107, 53, 0.3);
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    background: rgba(255, 107, 53, 0.2);
    border-color: var(--primary-color);
}

/* İletişim formu stilleri */
.contact-form-section {
    background-color: var(--dark-card);
    padding: 40px;
    border-radius: 20px;
    border: 1px solid var(--border-dark);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

.contact-form .form-control,
.contact-form .form-select {
    background-color: var(--dark-secondary);
    border: 1px solid var(--border-dark);
    color: var(--text-light);
    padding: 12px 15px;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.contact-form .form-control:focus,
.contact-form .form-select:focus {
    background-color: var(--dark-secondary);
    border-color: var(--primary-color);
    color: var(--text-light);
    box-shadow: 0 0 0 0.25rem rgba(255, 107, 53, 0.25);
}

.contact-form .form-control::placeholder {
    color: var(--text-muted);
}

.contact-form .form-label {
    color: var(--text-light);
    font-weight: 600;
    margin-bottom: 8px;
}

/* İletişim bilgileri bölümü */
.contact-info-section {
    background-color: var(--dark-card);
    padding: 40px;
    border-radius: 20px;
    border: 1px solid var(--border-dark);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    height: fit-content;
}

/* İletişim kartları */
.contact-card {
    display: flex;
    align-items: flex-start;
    padding: 20px;
    background-color: var(--dark-secondary);
    border-radius: 15px;
    border: 1px solid var(--border-dark);
    transition: all 0.3s ease;
}

.contact-card:hover {
    border-color: var(--primary-color);
    transform: translateX(5px);
    box-shadow: 0 5px 15px rgba(255, 107, 53, 0.2);
}

.contact-card .card-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    flex-shrink: 0;
}

.contact-card .card-icon i {
    color: white;
    font-size: 1.2rem;
}

.contact-card .card-content a {
    color: var(--primary-color);
    transition: color 0.3s ease;
}

.contact-card .card-content a:hover {
    color: var(--secondary-color);
}

/* Sosyal medya linkleri */
.social-links-contact .social-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    background-color: var(--dark-bg);
    border: 2px solid var(--border-dark);
    border-radius: 50%;
    color: var(--text-muted);
    transition: all 0.3s ease;
    text-decoration: none;
}

.social-links-contact .social-link:hover {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
    color: white;
    transform: translateY(-3px);
}

/* Çalışma saatleri */
.working-hours {
    background-color: var(--dark-secondary);
    padding: 25px;
    border-radius: 15px;
    border: 1px solid var(--border-dark);
}

.hour-item {
    padding: 8px 0;
    border-bottom: 1px solid var(--border-dark);
}

.hour-item:last-child {
    border-bottom: none;
}

/* FAQ Accordion stilleri */
.faq-section {
    background-color: var(--dark-secondary);
}

.accordion-item {
    background-color: var(--dark-card);
    border: 1px solid var(--border-dark);
    border-radius: 10px !important;
    margin-bottom: 15px;
}

.accordion-button {
    background-color: var(--dark-card);
    color: var(--text-light);
    border: none;
    font-weight: 600;
    padding: 20px 25px;
    border-radius: 10px !important;
}

.accordion-button:not(.collapsed) {
    background-color: var(--primary-color);
    color: white;
    box-shadow: none;
}

.accordion-button:focus {
    box-shadow: 0 0 0 0.25rem rgba(255, 107, 53, 0.25);
    border-color: var(--primary-color);
}

.accordion-button::after {
    filter: brightness(0) invert(1);
}

.accordion-button:not(.collapsed)::after {
    filter: brightness(0) invert(1);
}

.accordion-body {
    background-color: var(--dark-secondary);
    color: var(--text-light);
    padding: 20px 25px;
    border-top: 1px solid var(--border-dark);
}

/* Responsive tasarım düzenlemeleri */
@media (max-width: 768px) {
    .contact-form-section,
    .contact-info-section {
        padding: 25px;
        margin-bottom: 30px;
    }
    
    .contact-header .display-4 {
        font-size: 2.5rem;
    }
    
    .stat-card {
        margin-bottom: 20px;
    }
    
    .contact-card {
        flex-direction: column;
        text-align: center;
    }
    
    .contact-card .card-icon {
        margin: 0 auto 15px auto;
    }
}

/* Form animasyonları */
.contact-form .form-control:focus,
.contact-form .form-select:focus {
    transform: translateY(-2px);
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    border: none;
    padding: 15px 30px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(255, 107, 53, 0.4);
}

/* Alert mesajları */
.alert {
    border: none;
    border-radius: 15px;
    padding: 20px 25px;
    font-weight: 500;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.alert-success {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
}

.alert-danger {
    background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);
    color: white;
}

.alert .btn-close {
    filter: brightness(0) invert(1);
    opacity: 0.8;
}

.alert .btn-close:hover {
    opacity: 1;
}

/* Form validation stilleri */
.form-control.is-invalid,
.form-select.is-invalid {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
}

.invalid-feedback {
    color: #dc3545;
    font-weight: 500;
    font-size: 0.875rem;
    margin-top: 5px;
}
</style>
@endsection