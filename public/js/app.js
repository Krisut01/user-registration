// Fallback JavaScript in case Vite build fails
console.log('Fallback JS loaded - Vite build may have failed');

// Basic Alpine.js fallback
if (typeof Alpine === 'undefined') {
    console.warn('Alpine.js not loaded, using basic fallbacks');

    // Basic password toggle functionality
    window.togglePassword = function(inputId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(inputId + '-icon');

        if (input && icon) {
            input.type = input.type === 'password' ? 'text' : 'password';
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        }
    };

    // Basic form validation
    document.addEventListener('DOMContentLoaded', function() {
        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                const submitBtn = form.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = 'Processing...';
                }
            });
        });
    });
} else {
    console.log('Alpine.js loaded successfully');
}