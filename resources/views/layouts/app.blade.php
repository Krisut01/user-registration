<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'User Registration System') }} - {{ isset($pageTitle) ? $pageTitle : 'Enterprise Authentication Platform' }}</title>
    <meta name="description" content="Professional user authentication system with enterprise security, built with Laravel and TailwindCSS.">
    <meta name="keywords" content="authentication, user registration, Laravel, TailwindCSS, enterprise security, professional">
    <meta name="author" content="User Registration System Pro">
    <meta name="robots" content="index, follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="theme-color" content="#0f766e">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    @stack('styles')
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100">
    @yield('content')
    
    <script>
        // Optimized password toggle
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(`${inputId}-icon`);

            if (input && icon) {
                input.type = input.type === 'password' ? 'text' : 'password';
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
            }
        }

        // Performance optimizations
        document.addEventListener('DOMContentLoaded', function() {
            // Lazy load images if any
            const images = document.querySelectorAll('img[loading="lazy"]');
            images.forEach(img => {
                img.setAttribute('loading', 'lazy');
            });

            // Remove any loading states
            document.body.classList.remove('loading');

            // Add error handling for forms
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const submitBtn = form.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Processing...';
                    }
                });
            });
        });

        // Debounce scroll events for better performance
        let scrollTimeout;
        window.addEventListener('scroll', function() {
            clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(function() {
                // Handle scroll-based animations here if needed
            }, 16); // ~60fps
        });

        // Handle form validation feedback
        document.addEventListener('input', function(e) {
            if (e.target.classList.contains('input-field')) {
                const errorElement = e.target.parentNode.querySelector('.text-red-500');
                if (errorElement && e.target.value.trim() !== '') {
                    errorElement.style.opacity = '0.5';
                }
            }
        });
    </script>
    @stack('scripts')
</body>
</html>