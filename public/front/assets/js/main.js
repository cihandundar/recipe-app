// Main JavaScript File for Recipe App

document.addEventListener('DOMContentLoaded', function() {
    
    // Search functionality
    initializeSearch();
    
    // Header scroll effects
    initializeHeaderScroll();
    
    // Mobile menu enhancements
    initializeMobileMenu();
    
});

// Search functionality
function initializeSearch() {
    const searchInput = document.querySelector('input[name="search"]');
    const searchForm = document.querySelector('.search-box form');
    
    if (searchInput && searchForm) {
        // Add search suggestions (can be enhanced with AJAX)
        searchInput.addEventListener('focus', function() {
            this.placeholder = 'Örn: Mercimek çorbası, tavuk, makarna...';
        });
        
        searchInput.addEventListener('blur', function() {
            this.placeholder = 'Tarif, malzeme veya kategori ara...';
        });
        
        // Prevent empty search
        searchForm.addEventListener('submit', function(e) {
            if (searchInput.value.trim() === '') {
                e.preventDefault();
                searchInput.focus();
            }
        });
    }
}

// Header scroll effects
function initializeHeaderScroll() {
    const header = document.querySelector('.header-section');
    
    if (header) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    }
}

// Mobile menu enhancements
function initializeMobileMenu() {
    const navbarToggler = document.querySelector('.navbar-toggler');
    const navbarCollapse = document.querySelector('.navbar-collapse');
    
    if (navbarToggler && navbarCollapse) {
        // Close mobile menu when clicking on a link
        const navLinks = navbarCollapse.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth < 992) {
                    const bsCollapse = new bootstrap.Collapse(navbarCollapse, {
                        toggle: false
                    });
                    bsCollapse.hide();
                }
            });
        });
    }
}

// Utility functions
function showToast(message, type = 'success') {
    // Create toast notification
    const toastHtml = `
        <div class="toast align-items-center text-white bg-${type} border-0" role="alert">
            <div class="d-flex">
                <div class="toast-body">
                    ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    `;
    
    // Add to toast container (create if doesn't exist)
    let toastContainer = document.querySelector('.toast-container');
    if (!toastContainer) {
        toastContainer = document.createElement('div');
        toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
        document.body.appendChild(toastContainer);
    }
    
    toastContainer.insertAdjacentHTML('beforeend', toastHtml);
    
    // Show toast
    const toastElement = toastContainer.lastElementChild;
    const toast = new bootstrap.Toast(toastElement);
    toast.show();
    
    // Remove toast element after hiding
    toastElement.addEventListener('hidden.bs.toast', function() {
        this.remove();
    });
}

// Form validation helper
function validateForm(formSelector) {
    const form = document.querySelector(formSelector);
    if (!form) return false;
    
    const requiredFields = form.querySelectorAll('[required]');
    let isValid = true;
    
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            field.classList.add('is-invalid');
            isValid = false;
        } else {
            field.classList.remove('is-invalid');
        }
    });
    
    return isValid;
}

// Loading spinner
function showLoading(element) {
    if (element) {
        const originalContent = element.innerHTML;
        element.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Yükleniyor...';
        element.disabled = true;
        
        return function hideLoading() {
            element.innerHTML = originalContent;
            element.disabled = false;
        };
    }
}

// Smooth scroll to element
function smoothScrollTo(targetSelector) {
    const target = document.querySelector(targetSelector);
    if (target) {
        target.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }
}