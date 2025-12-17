{{-- Tarif ekleme sayfası - Dark tema ile tasarlandı --}}
@extends('layouts.app')

@section('title', 'Yeni Tarif Ekle - Tarif Dünyası')

@section('content')
<div class="recipe-create-page py-5">
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
                    <a href="{{ route('recipes.index') }}" class="text-decoration-none">Tarifler</a>
                </li>
                <li class="breadcrumb-item active text-primary" aria-current="page">Yeni Tarif Ekle</li>
            </ol>
        </nav>

        {{-- Başlık --}}
        <div class="page-header mb-5">
            <h1 class="display-5 fw-bold text-white mb-3">
                <i class="fas fa-plus-circle me-2 text-primary"></i>Yeni Tarif Ekle
            </h1>
            <p class="text-muted">Lezzetli tarifinizi paylaşın ve diğer kullanıcılarla deneyimlerinizi paylaşın.</p>
        </div>

        {{-- Form --}}
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-4">
                        @if ($errors->any())
                            <div class="alert alert-danger mb-4">
                                <h5 class="alert-heading">
                                    <i class="fas fa-exclamation-triangle me-2"></i>Lütfen aşağıdaki hataları düzeltin:
                                </h5>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data" id="recipe-form">
                            @csrf

                            {{-- Temel Bilgiler --}}
                            <div class="form-section mb-5">
                                <h3 class="section-title mb-4">
                                    <i class="fas fa-info-circle me-2 text-primary"></i>Temel Bilgiler
                                </h3>

                                {{-- Tarif Başlığı --}}
                                <div class="mb-4">
                                    <label for="title" class="form-label fw-semibold">
                                        Tarif Başlığı <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-lg @error('title') is-invalid @enderror" 
                                           id="title" 
                                           name="title" 
                                           value="{{ old('title') }}" 
                                           required 
                                           placeholder="Örn: Klasik İstanbul Böreği">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Kategori --}}
                                <div class="mb-4">
                                    <label for="recipe_category_id" class="form-label fw-semibold">
                                        Kategori <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select form-select-lg @error('recipe_category_id') is-invalid @enderror" 
                                            id="recipe_category_id" 
                                            name="recipe_category_id" 
                                            required>
                                        <option value="">Kategori Seçin</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('recipe_category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('recipe_category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Açıklama --}}
                                <div class="mb-4">
                                    <label for="description" class="form-label fw-semibold">
                                        Tarif Açıklaması <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                              id="description" 
                                              name="description" 
                                              rows="4" 
                                              required 
                                              placeholder="Tarifiniz hakkında kısa bir açıklama yazın...">{{ old('description') }}</textarea>
                                    <small class="form-text text-muted">Maksimum 1000 karakter</small>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Öne Çıkan Görsel --}}
                                <div class="mb-4">
                                    <label for="featured_image" class="form-label fw-semibold">
                                        Öne Çıkan Görsel
                                    </label>
                                    <input type="file" 
                                           class="form-control @error('featured_image') is-invalid @enderror" 
                                           id="featured_image" 
                                           name="featured_image" 
                                           accept="image/*">
                                    <small class="form-text text-muted">Maksimum 2MB, JPG, PNG veya GIF formatında</small>
                                    @error('featured_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div id="image-preview" class="mt-3" style="display: none;">
                                        <img src="" alt="Preview" class="img-thumbnail" style="max-width: 300px; max-height: 300px;">
                                    </div>
                                </div>
                            </div>

                            {{-- Zaman ve Porsiyon Bilgileri --}}
                            <div class="form-section mb-5">
                                <h3 class="section-title mb-4">
                                    <i class="fas fa-clock me-2 text-primary"></i>Zaman ve Porsiyon
                                </h3>

                                <div class="row g-3">
                                    {{-- Hazırlama Süresi --}}
                                    <div class="col-md-4">
                                        <label for="prep_time" class="form-label fw-semibold">Hazırlama Süresi (dakika)</label>
                                        <input type="number" 
                                               class="form-control @error('prep_time') is-invalid @enderror" 
                                               id="prep_time" 
                                               name="prep_time" 
                                               value="{{ old('prep_time') }}" 
                                               min="1" 
                                               placeholder="30">
                                        @error('prep_time')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Pişirme Süresi --}}
                                    <div class="col-md-4">
                                        <label for="cook_time" class="form-label fw-semibold">Pişirme Süresi (dakika)</label>
                                        <input type="number" 
                                               class="form-control @error('cook_time') is-invalid @enderror" 
                                               id="cook_time" 
                                               name="cook_time" 
                                               value="{{ old('cook_time') }}" 
                                               min="1" 
                                               placeholder="45">
                                        @error('cook_time')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Porsiyon --}}
                                    <div class="col-md-4">
                                        <label for="servings" class="form-label fw-semibold">
                                            Porsiyon <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" 
                                               class="form-control @error('servings') is-invalid @enderror" 
                                               id="servings" 
                                               name="servings" 
                                               value="{{ old('servings', 4) }}" 
                                               min="1" 
                                               max="20" 
                                               required>
                                        @error('servings')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Zorluk Seviyesi --}}
                                    <div class="col-md-12">
                                        <label for="difficulty" class="form-label fw-semibold">
                                            Zorluk Seviyesi <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-select @error('difficulty') is-invalid @enderror" 
                                                id="difficulty" 
                                                name="difficulty" 
                                                required>
                                            <option value="">Seçin</option>
                                            <option value="kolay" {{ old('difficulty') == 'kolay' ? 'selected' : '' }}>Kolay</option>
                                            <option value="orta" {{ old('difficulty') == 'orta' ? 'selected' : '' }}>Orta</option>
                                            <option value="zor" {{ old('difficulty') == 'zor' ? 'selected' : '' }}>Zor</option>
                                        </select>
                                        @error('difficulty')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Malzemeler --}}
                            <div class="form-section mb-5">
                                <h3 class="section-title mb-4">
                                    <i class="fas fa-shopping-basket me-2 text-primary"></i>Malzemeler
                                    <span class="text-danger">*</span>
                                </h3>

                                <div id="ingredients-container">
                                    <div class="ingredient-item mb-3">
                                        <div class="input-group">
                                            <input type="text" 
                                                   class="form-control ingredient-input" 
                                                   name="ingredients[]" 
                                                   placeholder="Örn: 2 su bardağı un" 
                                                   required>
                                            <button type="button" class="btn btn-outline-danger remove-ingredient" style="display: none;">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-outline-primary" id="add-ingredient">
                                    <i class="fas fa-plus me-2"></i>Malzeme Ekle
                                </button>

                                @error('ingredients')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                                @error('ingredients.*')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Yapılış --}}
                            <div class="form-section mb-5">
                                <h3 class="section-title mb-4">
                                    <i class="fas fa-list-ol me-2 text-primary"></i>Yapılış
                                    <span class="text-danger">*</span>
                                </h3>

                                <div class="mb-4">
                                    <textarea class="form-control @error('instructions') is-invalid @enderror" 
                                              id="instructions" 
                                              name="instructions" 
                                              rows="10" 
                                              required 
                                              placeholder="Tarifin yapılış adımlarını detaylı olarak yazın...">{{ old('instructions') }}</textarea>
                                    <small class="form-text text-muted">En az 50 karakter olmalıdır</small>
                                    @error('instructions')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Ek Bilgiler --}}
                            <div class="form-section mb-5">
                                <h3 class="section-title mb-4">
                                    <i class="fas fa-info-circle me-2 text-primary"></i>Ek Bilgiler
                                </h3>

                                {{-- Şef Notları --}}
                                <div class="mb-4">
                                    <label for="chef_notes" class="form-label fw-semibold">Şef Notları</label>
                                    <textarea class="form-control @error('chef_notes') is-invalid @enderror" 
                                              id="chef_notes" 
                                              name="chef_notes" 
                                              rows="3" 
                                              placeholder="Tarif hakkında özel ipuçları, püf noktaları...">{{ old('chef_notes') }}</textarea>
                                    <small class="form-text text-muted">Maksimum 500 karakter</small>
                                    @error('chef_notes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Etiketler --}}
                                <div class="mb-4">
                                    <label for="tags" class="form-label fw-semibold">Etiketler</label>
                                    <input type="text" 
                                           class="form-control @error('tags') is-invalid @enderror" 
                                           id="tags" 
                                           name="tags" 
                                           value="{{ old('tags') }}" 
                                           placeholder="Örn: hızlı, pratik, sağlıklı (virgülle ayırın)">
                                    <small class="form-text text-muted">Etiketleri virgülle ayırın</small>
                                    @error('tags')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Form Butonları --}}
                            <div class="form-actions d-flex gap-3 justify-content-end">
                                <a href="{{ route('recipes.index') }}" class="btn btn-outline-secondary btn-lg">
                                    <i class="fas fa-times me-2"></i>İptal
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-save me-2"></i>Tarifi Kaydet
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-css')
<style>
.recipe-create-page {
    background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
    min-height: 100vh;
}

.card {
    background-color: var(--dark-card, #2d2d2d);
    border: 1px solid var(--border-dark, #404040);
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

.form-section {
    padding: 20px;
    background-color: rgba(0, 0, 0, 0.2);
    border-radius: 10px;
    border: 1px solid var(--border-dark, #404040);
}

.ingredient-item {
    position: relative;
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

@section('extra-js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Malzeme ekleme/çıkarma
    const addIngredientBtn = document.getElementById('add-ingredient');
    const ingredientsContainer = document.getElementById('ingredients-container');

    addIngredientBtn.addEventListener('click', function() {
        const newIngredient = document.createElement('div');
        newIngredient.className = 'ingredient-item mb-3';
        newIngredient.innerHTML = `
            <div class="input-group">
                <input type="text" 
                       class="form-control ingredient-input" 
                       name="ingredients[]" 
                       placeholder="Örn: 2 su bardağı un" 
                       required>
                <button type="button" class="btn btn-outline-danger remove-ingredient">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        ingredientsContainer.appendChild(newIngredient);

        // İlk malzeme için remove butonu göster
        if (ingredientsContainer.children.length > 1) {
            ingredientsContainer.querySelectorAll('.remove-ingredient').forEach(btn => {
                btn.style.display = 'block';
            });
        }
    });

    // Malzeme silme
    ingredientsContainer.addEventListener('click', function(e) {
        if (e.target.closest('.remove-ingredient')) {
            const ingredientItem = e.target.closest('.ingredient-item');
            ingredientItem.remove();

            // Eğer tek malzeme kaldıysa remove butonunu gizle
            if (ingredientsContainer.children.length === 1) {
                ingredientsContainer.querySelector('.remove-ingredient').style.display = 'none';
            }
        }
    });

    // Görsel önizleme
    const featuredImageInput = document.getElementById('featured_image');
    const imagePreview = document.getElementById('image-preview');
    const previewImg = imagePreview.querySelector('img');

    featuredImageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                imagePreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.style.display = 'none';
        }
    });
});
</script>
@endsection
