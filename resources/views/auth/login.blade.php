@extends('layouts.app')


@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 flex items-center justify-center py-12 px-4">
    <div class="max-w-md w-full mx-auto">
        <div class="bg-white rounded-2xl shadow-2xl p-6 sm:p-8 interactive-card">
            <div class="text-center mb-6 sm:mb-8">
                <div class="w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-r from-teal-600 to-cyan-600 rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse-subtle">
                    <i class="fas fa-sign-in-alt text-white text-lg sm:text-2xl"></i>
                </div>
                <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-2">Welcome Back</h2>
                <p class="text-sm sm:text-base text-slate-600">Sign in to your account</p>
            </div>

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6 animate-fade-in">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-6 animate-fade-in">
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-triangle mr-2 mt-0.5"></i>
                        <div>
                            <p class="font-medium mb-1">Login failed:</p>
                            <ul class="text-sm list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Email Address</label>
                    <div class="relative">
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="input-field w-full px-4 py-3 rounded-lg pl-12 @error('email') border-red-500 @enderror"
                               placeholder="Enter your email" required autofocus>
                        <i class="fas fa-envelope absolute left-4 top-4 text-slate-400"></i>
                    </div>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password"
                               class="input-field w-full px-4 py-3 rounded-lg pl-12 pr-12 @error('password') border-red-500 @enderror"
                               placeholder="Enter your password" required>
                        <i class="fas fa-lock absolute left-4 top-4 text-slate-400"></i>
                        <button type="button" onclick="togglePassword('password')"
                                class="absolute right-4 top-4 text-slate-400 hover:text-slate-600">
                            <i id="password-icon" class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="rounded border-slate-300 text-teal-600 shadow-sm focus:ring-teal-500">
                        <span class="ml-2 text-sm text-slate-600">Remember me</span>
                    </label>
                    <a href="#" class="text-sm text-teal-600 hover:text-teal-800 font-medium transition-colors">Forgot password?</a>
                </div>

                <button type="submit" class="btn-primary w-full py-3 px-4 rounded-lg text-white font-medium hover:shadow-lg">
                    Sign In
                </button>
            </form>

            <!-- Terms and Privacy -->
            <div class="mt-6 text-center">
                <p class="text-xs text-slate-500 mb-4">
                    Secure login with end-to-end encryption
                </p>

                <div class="border-t border-slate-200 pt-6">
                    <p class="text-slate-600">Don't have an account?
                        <a href="{{ route('register') }}" class="text-teal-600 hover:text-teal-800 font-semibold ml-1 transition-colors">
                            Sign up here
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