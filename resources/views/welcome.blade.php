@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100">
    <!-- Professional Header -->
    <div class="bg-white shadow-lg border-b border-slate-200/60">
        <div class="max-w-7xl mx-auto px-6 py-5">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-5">
                    <div class="w-12 h-12 bg-gradient-to-br from-teal-600 to-cyan-600 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-layer-group text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold bg-gradient-to-r from-slate-900 to-slate-700 bg-clip-text text-transparent">User Registration System</h1>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="status-badge px-4 py-2 rounded-full text-sm font-semibold">
                        <i class="fas fa-code mr-2"></i>Laravel + TailwindCSS
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <div class="max-w-7xl mx-auto px-6 py-16">
        <div class="text-center">
            <!-- Main Icon -->
            <div class="w-20 h-20 bg-gradient-to-r from-teal-600 to-cyan-600 rounded-full flex items-center justify-center mx-auto mb-8 shadow-2xl">
                <i class="fas fa-users text-white text-3xl"></i>
            </div>

            <!-- Main Heading -->
            <h1 class="text-5xl lg:text-7xl font-bold mb-6">
                <span class="bg-gradient-to-r from-slate-900 via-slate-800 to-slate-700 bg-clip-text text-transparent">
                    Welcome to
                                </span>
                <br>
                <span class="bg-gradient-to-r from-teal-600 to-cyan-600 bg-clip-text text-transparent">
                    User Registration
                            </span>
            </h1>

            <!-- Subtitle -->
            <p class="text-xl text-slate-600 max-w-3xl mx-auto mb-12 leading-relaxed">
                A professional user authentication system built with Laravel and TailwindCSS.
                Secure, responsive, and designed for modern web applications.
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                <a href="{{ route('register') }}"
                   class="group inline-flex items-center px-8 py-4 bg-gradient-to-r from-teal-600 to-cyan-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-200">
                    <i class="fas fa-user-plus mr-3 text-lg"></i>
                    Get Started
                    <i class="fas fa-arrow-right ml-3 group-hover:translate-x-0.5 transition-transform duration-200"></i>
                </a>

                <a href="{{ route('login') }}"
                   class="inline-flex items-center px-8 py-4 border-2 border-slate-300 text-slate-700 font-semibold rounded-xl hover:border-teal-500 hover:text-teal-600 transition-colors duration-200">
                    <i class="fas fa-sign-in-alt mr-3"></i>
                    Sign In
                </a>
            </div>
        </div>

        <!-- Features Grid -->
        <div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-2xl shadow-lg border border-slate-200 hover:shadow-lg transition-shadow duration-200">
                <div class="w-14 h-14 bg-gradient-to-br from-teal-500 to-cyan-500 rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-shield-alt text-white text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Secure Authentication</h3>
                <p class="text-slate-600">Industry-standard security with Laravel Breeze, including password hashing and CSRF protection.</p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-lg border border-slate-200 hover:shadow-lg transition-shadow duration-200">
                <div class="w-14 h-14 bg-gradient-to-br from-cyan-500 to-blue-500 rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-mobile-alt text-white text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Responsive Design</h3>
                <p class="text-slate-600">Fully responsive interface that works perfectly on desktop, tablet, and mobile devices.</p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-lg border border-slate-200 hover:shadow-lg transition-shadow duration-200">
                <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-palette text-white text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Modern UI/UX</h3>
                <p class="text-slate-600">Professional design with smooth animations, intuitive navigation, and excellent user experience.</p>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="mt-20 bg-gradient-to-r from-slate-900 to-slate-800 rounded-3xl p-12 text-white">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">System Overview</h2>
                <p class="text-slate-300">Built with modern technologies for reliable performance</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-4xl font-bold text-teal-400 mb-2">{{ $userCount ?? 0 }}</div>
                    <div class="text-slate-300">Registered Users</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-cyan-400 mb-2">4</div>
                    <div class="text-slate-300">Pages</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-emerald-400 mb-2">100%</div>
                    <div class="text-slate-300">Responsive</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-blue-400 mb-2">Laravel</div>
                    <div class="text-slate-300">Powered</div>
                </div>
            </div>
        </div>

        <!-- Professional Testimonials -->
        <div class="mt-20 bg-white rounded-2xl shadow-xl p-12">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-slate-900 mb-4">Trusted by Industry Leaders</h2>
                <p class="text-slate-600 max-w-2xl mx-auto">Join thousands of companies worldwide who trust our secure authentication system</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-6 bg-gradient-to-br from-slate-50 to-slate-100 rounded-xl border border-slate-200">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-white font-bold text-xl">T</span>
                    </div>
                    <blockquote class="text-slate-700 mb-4 italic">
                        "Exceptional security and user experience. Our team productivity increased by 40% since implementation."
                    </blockquote>
                    <div class="flex items-center justify-center mb-2">
                        <div class="flex text-yellow-400">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                    </div>
                    <cite class="text-slate-600 font-medium">Sarah Johnson, CTO at TechCorp</cite>
                </div>

                <div class="text-center p-6 bg-gradient-to-br from-slate-50 to-slate-100 rounded-xl border border-slate-200">
                    <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-white font-bold text-xl">F</span>
                    </div>
                    <blockquote class="text-slate-700 mb-4 italic">
                        "The most reliable authentication system we've used. Zero security incidents in 2 years."
                    </blockquote>
                    <div class="flex items-center justify-center mb-2">
                        <div class="flex text-yellow-400">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                    </div>
                    <cite class="text-slate-600 font-medium">Michael Chen, Security Lead at FinancePlus</cite>
                </div>

                <div class="text-center p-6 bg-gradient-to-br from-slate-50 to-slate-100 rounded-xl border border-slate-200">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-white font-bold text-xl">H</span>
                    </div>
                    <blockquote class="text-slate-700 mb-4 italic">
                        "Seamless integration and outstanding support. Highly recommended for enterprise use."
                    </blockquote>
                    <div class="flex items-center justify-center mb-2">
                        <div class="flex text-yellow-400">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                    </div>
                    <cite class="text-slate-600 font-medium">Emily Rodriguez, Product Manager at HealthTech</cite>
                </div>
            </div>
        </div>

        <!-- Professional CTA Section -->
        <div class="mt-20 bg-gradient-to-r from-teal-600 to-cyan-600 rounded-3xl p-12 text-white text-center">
            <h2 class="text-4xl font-bold mb-6">Ready to Get Started?</h2>
            <p class="text-xl text-teal-100 mb-8 max-w-2xl mx-auto">
                Join thousands of companies who trust our secure authentication system.
                Start building secure applications today.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="{{ route('register') }}"
                   class="inline-flex items-center px-8 py-4 bg-white text-teal-600 font-semibold rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300">
                    <i class="fas fa-rocket mr-3"></i>
                    Start Free Trial
                </a>
                <a href="#features"
                   class="inline-flex items-center px-8 py-4 border-2 border-white/30 text-white font-semibold rounded-xl hover:bg-white/10 transition-all duration-300">
                    <i class="fas fa-info-circle mr-3"></i>
                    Learn More
                </a>
            </div>
        </div>

        <!-- Footer -->
        <footer class="mt-20 bg-slate-900 text-white py-12">
            <div class="max-w-7xl mx-auto px-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div>
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-teal-600 to-cyan-600 rounded-xl flex items-center justify-center">
                                <i class="fas fa-layer-group text-white"></i>
                            </div>
                            <span class="text-xl font-bold">UserAuth Pro</span>
                        </div>
                        <p class="text-slate-400">Enterprise-grade authentication solutions for modern businesses.</p>
                    </div>

                    <div>
                        <h4 class="font-semibold mb-4">Product</h4>
                        <ul class="space-y-2 text-slate-400">
                            <li><a href="#" class="hover:text-white transition-colors">Features</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Security</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">API</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Pricing</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="font-semibold mb-4">Support</h4>
                        <ul class="space-y-2 text-slate-400">
                            <li><a href="#" class="hover:text-white transition-colors">Documentation</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Help Center</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Contact Us</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Status</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="font-semibold mb-4">Company</h4>
                        <ul class="space-y-2 text-slate-400">
                            <li><a href="#" class="hover:text-white transition-colors">About</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Blog</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Careers</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Press</a></li>
                        </ul>
                    </div>
                </div>

                <div class="border-t border-slate-800 mt-8 pt-8 text-center text-slate-400">
                    <p>&copy; 2024 User Registration System. All rights reserved. Built with Laravel & TailwindCSS.</p>
                </div>
            </div>
        </footer>
    </div>
</div>
@endsection