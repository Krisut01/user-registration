@extends('layouts.app')


@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 flex items-center justify-center py-12 px-4">
        <div class="max-w-md w-full mx-auto">
        <!-- Progress Indicator -->
        <div class="mb-6 sm:mb-8">
            <div class="flex items-center justify-center space-x-2 sm:space-x-4">
                <div class="flex items-center">
                    <div class="w-6 h-6 sm:w-8 sm:h-8 bg-teal-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-user-plus text-white text-xs"></i>
                    </div>
                    <span class="ml-1 sm:ml-2 text-xs sm:text-sm font-medium text-teal-600 hidden sm:inline">Account</span>
                </div>
                <div class="w-4 h-px sm:w-8 bg-slate-300"></div>
                <div class="flex items-center">
                    <div class="w-6 h-6 sm:w-8 sm:h-8 bg-slate-300 rounded-full flex items-center justify-center">
                        <i class="fas fa-envelope text-slate-500 text-xs"></i>
                    </div>
                    <span class="ml-1 sm:ml-2 text-xs sm:text-sm font-medium text-slate-500 hidden sm:inline">Verify</span>
                </div>
                <div class="w-4 h-px sm:w-8 bg-slate-300"></div>
                <div class="flex items-center">
                    <div class="w-6 h-6 sm:w-8 sm:h-8 bg-slate-300 rounded-full flex items-center justify-center">
                        <i class="fas fa-check text-slate-500 text-xs"></i>
                    </div>
                    <span class="ml-1 sm:ml-2 text-xs sm:text-sm font-medium text-slate-500 hidden sm:inline">Complete</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-2xl p-6 sm:p-8 interactive-card">
            <div class="text-center mb-6 sm:mb-8">
                <div class="w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-r from-teal-600 to-cyan-600 rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse-subtle">
                    <i class="fas fa-user-plus text-white text-lg sm:text-2xl"></i>
                </div>
                <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-2">Create Account</h2>
                <p class="text-sm sm:text-base text-slate-600">Join thousands of users worldwide</p>
            </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf
            
            <!-- Name Field -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                <div class="relative">
                    <input type="text" name="name" value="{{ old('name') }}" 
                           class="input-field w-full px-4 py-3 rounded-lg pl-12 @error('name') border-red-500 @enderror" 
                           placeholder="Enter your full name" required>
                    <i class="fas fa-user absolute left-4 top-4 text-gray-400"></i>
                </div>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Field -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                <div class="relative">
                    <input type="email" name="email" value="{{ old('email') }}" 
                           class="input-field w-full px-4 py-3 rounded-lg pl-12 @error('email') border-red-500 @enderror" 
                           placeholder="Enter your email" required>
                    <i class="fas fa-envelope absolute left-4 top-4 text-gray-400"></i>
                </div>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Field -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <div class="relative">
                    <input type="password" id="password" name="password" 
                           class="input-field w-full px-4 py-3 rounded-lg pl-12 pr-12 @error('password') border-red-500 @enderror" 
                           placeholder="Create a password" required>
                    <i class="fas fa-lock absolute left-4 top-4 text-gray-400"></i>
                    <button type="button" onclick="togglePassword('password')" 
                            class="absolute right-4 top-4 text-gray-400 hover:text-gray-600">
                        <i id="password-icon" class="fas fa-eye"></i>
                    </button>
                </div>
                <p class="text-xs text-gray-500 mt-1">Minimum 8 characters</p>
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password Field -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                <div class="relative">
                    <input type="password" id="password_confirmation" name="password_confirmation" 
                           class="input-field w-full px-4 py-3 rounded-lg pl-12 pr-12 @error('password_confirmation') border-red-500 @enderror" 
                           placeholder="Confirm your password" required>
                    <i class="fas fa-lock absolute left-4 top-4 text-gray-400"></i>
                    <button type="button" onclick="togglePassword('password_confirmation')" 
                            class="absolute right-4 top-4 text-gray-400 hover:text-gray-600">
                        <i id="password_confirmation-icon" class="fas fa-eye"></i>
                    </button>
                </div>
                @error('password_confirmation')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn-primary w-full py-3 px-4 rounded-lg text-white font-medium hover:shadow-lg">
                Create Account
            </button>
        </form>

            <!-- Terms and Privacy -->
            <div class="mt-6 text-center">
                <p class="text-xs text-slate-500 mb-4">
                    By creating an account, you agree to our
                    <a href="#" class="text-teal-600 hover:text-teal-800 font-medium">Terms of Service</a>
                    and
                    <a href="#" class="text-teal-600 hover:text-teal-800 font-medium">Privacy Policy</a>
                </p>

                <div class="border-t border-slate-200 pt-6">
                    <p class="text-slate-600">Already have an account?
                        <a href="{{ route('login') }}" class="text-teal-600 hover:text-teal-800 font-semibold ml-1 transition-colors">
                            Sign in here
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Trust Indicators -->
        <div class="mt-8 text-center">
            <p class="text-xs text-slate-500 mb-3">Trusted by</p>
            <div class="flex flex-col sm:flex-row items-center justify-center space-y-2 sm:space-y-0 sm:space-x-6 opacity-60">
                <div class="text-slate-400 font-semibold">TechCorp</div>
                <div class="text-slate-400 font-semibold">FinancePlus</div>
                <div class="text-slate-400 font-semibold">HealthTech</div>
            </div>
        </div>
    </div>
</div>
@endsection