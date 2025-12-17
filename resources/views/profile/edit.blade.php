{{-- Profil düzenleme sayfası - Dark tema ile tasarlandı --}}
@extends('layouts.app')

@section('title', 'Profili Düzenle - Tarif Dünyası')

@section('content')
<div class="profile-edit-page py-5">
    <div class="container">
        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}" class="text-decoration-none">
                        <i class="fas fa-home me-1"></i>Ana Sayfa
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('profile') }}" class="text-decoration-none">Profilim</a>
                </li>
                <li class="breadcrumb-item active text-primary" aria-current="page">Profili Düzenle</li>
            </ol>
        </nav>

        {{-- Başlık --}}
        <div class="page-header mb-5">
            <h1 class="display-5 fw-bold text-white mb-3">
                <i class="fas fa-user-edit me-2 text-primary"></i>Profili Düzenle
            </h1>
            <p class="lead text-muted">Profil bilgilerinizi ve şifrenizi güncelleyin.</p>
        </div>

        <div class="row">
            <div class="col-lg-8 mx-auto">
                {{-- Başarı Mesajı --}}
                @if (session('status') === 'profile-updated')
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        <strong>Başarılı!</strong> Profil bilgileriniz güncellendi.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('status') === 'password-updated')
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        <strong>Başarılı!</strong> Şifreniz güncellendi.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Profil Bilgileri Formu --}}
                <div class="card border-0 shadow-lg mb-4">
                    <div class="card-body p-4">
                        <div class="section-header mb-4">
                            <h3 class="section-title mb-2">
                                <i class="fas fa-user me-2 text-primary"></i>Profil Bilgileri
                            </h3>
                            <p class="text-muted small mb-0">Hesap bilgilerinizi ve e-posta adresinizi güncelleyin.</p>
                        </div>

                        <form method="post" action="{{ route('profile.update') }}" class="mt-4">
                            @csrf
                            @method('patch')

                            {{-- Ad Soyad --}}
                            <div class="mb-4">
                                <label for="name" class="form-label fw-semibold">
                                    Ad Soyad <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', $user->name) }}" 
                                       required 
                                       autofocus 
                                       autocomplete="name"
                                       placeholder="Adınızı girin">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- E-posta --}}
                            <div class="mb-4">
                                <label for="email" class="form-label fw-semibold">
                                    E-posta Adresi <span class="text-danger">*</span>
                                </label>
                                <input type="email" 
                                       class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email', $user->email) }}" 
                                       required 
                                       autocomplete="username"
                                       placeholder="E-posta adresinizi girin">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                    <div class="mt-3">
                                        <div class="alert alert-warning">
                                            <p class="mb-2">
                                                <i class="fas fa-exclamation-triangle me-2"></i>
                                                <strong>E-posta adresiniz doğrulanmamış.</strong>
                                            </p>
                                            <form id="send-verification" method="post" action="{{ route('verification.send') }}" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-primary">
                                                    Doğrulama e-postasını tekrar gönder
                                                </button>
                                            </form>
                                        </div>

                                        @if (session('status') === 'verification-link-sent')
                                            <div class="alert alert-success mt-2">
                                                <i class="fas fa-check-circle me-2"></i>
                                                Yeni bir doğrulama bağlantısı e-posta adresinize gönderildi.
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            {{-- Kaydet Butonu --}}
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-save me-2"></i>Kaydet
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Şifre Güncelleme Formu --}}
                <div class="card border-0 shadow-lg mb-4">
                    <div class="card-body p-4">
                        <div class="section-header mb-4">
                            <h3 class="section-title mb-2">
                                <i class="fas fa-lock me-2 text-primary"></i>Şifre Güncelle
                            </h3>
                            <p class="text-muted small mb-0">Hesabınızın güvenliği için güçlü bir şifre kullanın.</p>
                        </div>

                        <form method="post" action="{{ route('password.update') }}" class="mt-4">
                            @csrf
                            @method('put')

                            {{-- Mevcut Şifre --}}
                            <div class="mb-4">
                                <label for="update_password_current_password" class="form-label fw-semibold">
                                    Mevcut Şifre <span class="text-danger">*</span>
                                </label>
                                <input type="password" 
                                       class="form-control form-control-lg @error('current_password', 'updatePassword') is-invalid @enderror" 
                                       id="update_password_current_password" 
                                       name="current_password" 
                                       autocomplete="current-password"
                                       placeholder="Mevcut şifrenizi girin">
                                @error('current_password', 'updatePassword')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Yeni Şifre --}}
                            <div class="mb-4">
                                <label for="update_password_password" class="form-label fw-semibold">
                                    Yeni Şifre <span class="text-danger">*</span>
                                </label>
                                <input type="password" 
                                       class="form-control form-control-lg @error('password', 'updatePassword') is-invalid @enderror" 
                                       id="update_password_password" 
                                       name="password" 
                                       autocomplete="new-password"
                                       placeholder="Yeni şifrenizi girin">
                                @error('password', 'updatePassword')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">En az 8 karakter olmalıdır.</small>
                            </div>

                            {{-- Şifre Onayı --}}
                            <div class="mb-4">
                                <label for="update_password_password_confirmation" class="form-label fw-semibold">
                                    Yeni Şifre (Tekrar) <span class="text-danger">*</span>
                                </label>
                                <input type="password" 
                                       class="form-control form-control-lg" 
                                       id="update_password_password_confirmation" 
                                       name="password_confirmation" 
                                       autocomplete="new-password"
                                       placeholder="Yeni şifrenizi tekrar girin">
                            </div>

                            {{-- Kaydet Butonu --}}
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-save me-2"></i>Şifreyi Güncelle
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Hesap Silme --}}
                <div class="card border-0 shadow-lg border-danger">
                    <div class="card-body p-4">
                        <div class="section-header mb-4">
                            <h3 class="section-title text-danger mb-2">
                                <i class="fas fa-exclamation-triangle me-2"></i>Hesabı Sil
                            </h3>
                            <p class="text-muted small mb-0">
                                Hesabınızı sildiğinizde, tüm verileriniz kalıcı olarak silinecektir. 
                                Lütfen silmeden önce önemli verilerinizi yedekleyin.
                            </p>
                        </div>

                        <button type="button" 
                                class="btn btn-danger btn-lg" 
                                data-bs-toggle="modal" 
                                data-bs-target="#deleteAccountModal">
                            <i class="fas fa-trash-alt me-2"></i>Hesabı Sil
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Hesap Silme Modal --}}
<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-danger">
                <h5 class="modal-title text-danger" id="deleteAccountModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>Hesabı Sil
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')
                <div class="modal-body">
                    <p class="mb-3">
                        <strong>Hesabınızı silmek istediğinizden emin misiniz?</strong>
                    </p>
                    <p class="text-muted small mb-4">
                        Hesabınız silindiğinde, tüm verileriniz kalıcı olarak silinecektir. 
                        Bu işlem geri alınamaz. Devam etmek için şifrenizi girin.
                    </p>
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">
                            Şifre <span class="text-danger">*</span>
                        </label>
                        <input type="password" 
                               class="form-control @error('password', 'userDeletion') is-invalid @enderror" 
                               id="password" 
                               name="password" 
                               placeholder="Şifrenizi girin"
                               required>
                        @error('password', 'userDeletion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>İptal
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash-alt me-2"></i>Hesabı Sil
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('extra-css')
<style>
.profile-edit-page {
    background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
    min-height: 100vh;
}

.card {
    background-color: var(--dark-card, #2d2d2d);
    border: 1px solid var(--border-dark, #404040);
}

.card.border-danger {
    border-color: #dc3545 !important;
}

.form-control, .form-select {
    background-color: var(--dark-secondary, #1a1a1a);
    border: 1px solid var(--border-dark, #404040);
    color: var(--text-light, #ffffff);
}

.form-control:focus, .form-select:focus {
    background-color: var(--dark-secondary, #1a1a1a);
    border-color: var(--primary-color, #ff6b35);
    color: var(--text-light, #ffffff);
    box-shadow: 0 0 0 0.25rem rgba(255, 107, 53, 0.15);
}

.form-label {
    color: var(--text-light, #ffffff);
}

.section-title {
    color: var(--text-light, #ffffff);
    border-bottom: 2px solid var(--primary-color, #ff6b35);
    padding-bottom: 10px;
}

.section-title.text-danger {
    border-bottom-color: #dc3545;
}

.alert {
    background-color: var(--dark-secondary, #1a1a1a);
    border: 1px solid var(--border-dark, #404040);
}

.alert-success {
    border-color: #28a745;
    color: #28a745;
}

.alert-warning {
    border-color: #ffc107;
    color: #ffc107;
}

.modal-content {
    background-color: var(--dark-card, #2d2d2d);
    border: 1px solid var(--border-dark, #404040);
    color: var(--text-light, #ffffff);
}

.modal-header {
    border-bottom-color: var(--border-dark, #404040);
}

.modal-footer {
    border-top-color: var(--border-dark, #404040);
}

.breadcrumb {
    background-color: transparent;
}

.breadcrumb-item a {
    color: var(--primary-color, #ff6b35);
}

.breadcrumb-item.active {
    color: var(--text-light, #ffffff);
}
</style>
@endsection
