@extends('layouts.app')

@section('title', 'Giriş Yap - Tarif Dünyası')

@section('content')
<div class="auth-section py-5 bg-light min-vh-100 d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="auth-card card shadow border-0">
                    <div class="card-body p-5">
                        <!-- Logo ve Başlık -->
                        <div class="text-center mb-4">
                            <h3 class="fw-bold text-primary mb-2">
                                <i class="fas fa-utensils me-2"></i>
                                Tarif Dünyası
                            </h3>
                            <h4 class="fw-bold mb-2">Giriş Yap</h4>
                            <p class="text-muted">Hesabınıza giriş yapın</p>
                        </div>

                        <!-- Session Status -->
                        @if (session('status'))
                            <div class="alert alert-success mb-4">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email Address -->
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">E-mail Adresi</label>
                                <input id="email" 
                                       type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       required 
                                       autofocus 
                                       autocomplete="username"
                                       placeholder="E-mail adresinizi girin">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold">Şifre</label>
                                <input id="password" 
                                       type="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       name="password" 
                                       required 
                                       autocomplete="current-password"
                                       placeholder="Şifrenizi girin">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Remember Me -->
                            <div class="form-check mb-3">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       id="remember_me" 
                                       name="remember">
                                <label class="form-check-label" for="remember_me">
                                    Beni hatırla
                                </label>
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-sign-in-alt me-2"></i>
                                    Giriş Yap
                                </button>
                            </div>

                            <div class="text-center">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-decoration-none">
                                        Şifremi unuttum
                                    </a>
                                @endif
                            </div>
                        </form>

                        <!-- Kayıt Linki -->
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-0">Hesabınız yok mu?</p>
                            <a href="{{ route('register') }}" class="btn btn-outline-primary mt-2">
                                <i class="fas fa-user-plus me-2"></i>
                                Kayıt Ol
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- Login sayfası özel CSS stilleri - Dark tema --}}
@section('extra-css')
<style>
/* Auth sayfaları arka plan gradyanı */
.auth-section {
    background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
}

/* Auth kartları */
.auth-card {
    border-radius: 15px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    background-color: var(--dark-card);
    border: 1px solid var(--border-dark);
}

.auth-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(255, 107, 53, 0.2) !important;
}

/* Form elemanları özelleştirmesi */
.form-control {
    border-radius: 10px;
    border: 1px solid var(--border-dark);
    padding: 12px 15px;
    transition: all 0.3s ease;
    background-color: var(--dark-secondary);
    color: var(--text-light);
}

.form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.25rem rgba(255, 107, 53, 0.15);
    background-color: var(--dark-secondary);
    color: var(--text-light);
}

.form-control::placeholder {
    color: var(--text-muted);
}

/* Form etiketleri */
.form-label {
    color: var(--text-light);
    font-weight: 600;
}

/* Başlıklar */
.auth-card h3,
.auth-card h4 {
    color: var(--text-light);
}

.auth-card h3.text-primary {
    color: var(--primary-color) !important;
}

/* Butonlar */
.btn {
    border-radius: 10px;
    font-weight: 500;
    padding: 12px 20px;
}

/* Alert mesajları */
.alert-success {
    background-color: var(--dark-secondary);
    border-color: var(--primary-color);
    color: var(--primary-color);
}

/* Checkbox */
.form-check-input:checked {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}

.form-check-label {
    color: var(--text-light);
}

/* Linkler */
a {
    color: var(--primary-color);
    text-decoration: none;
}

a:hover {
    color: var(--secondary-color);
}
</style>
@endsection
