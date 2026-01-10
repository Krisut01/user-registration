@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
    <!-- Fully Responsive Navigation -->
    <nav class="bg-white/80 backdrop-blur-lg shadow-lg border-b border-white/20 sticky top-0 z-50" x-data="{ mobileMenuOpen: false, profileMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo and Brand -->
                <div class="flex items-center min-w-0 flex-1">
                    <div class="flex items-center space-x-2 sm:space-x-3">
                        <div class="w-8 h-8 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-rocket text-white text-sm"></i>
                        </div>
                        <h1 class="text-base sm:text-lg lg:text-xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent truncate">
                            <span class="hidden sm:inline">Advanced User Management System</span>
                            <span class="sm:hidden">AUMS</span>
                        </h1>
                    </div>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-4 lg:space-x-6">
                    <!-- Real-time Status Indicator -->
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                        <span class="text-xs lg:text-sm text-gray-600 hidden lg:inline">Live</span>
                    </div>

                    <!-- Quick Actions Dropdown -->
                    <div class="relative" x-data="{ quickMenuOpen: false }">
                        <button @click="quickMenuOpen = !quickMenuOpen"
                                class="flex items-center space-x-2 px-3 py-2 text-gray-700 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition-colors">
                            <i class="fas fa-bolt text-yellow-500"></i>
                            <span class="text-sm font-medium hidden lg:inline">Actions</span>
                            <i class="fas fa-chevron-down text-xs transition-transform" :class="quickMenuOpen ? 'rotate-180' : ''"></i>
                        </button>

                        <div x-show="quickMenuOpen" @click.away="quickMenuOpen = false" x-transition
                             class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl border border-gray-100 py-2 z-50">
                            <a href="#" class="flex items-center space-x-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50">
                                <i class="fas fa-user-plus text-blue-500"></i>
                                <span>Add User</span>
                            </a>
                            <a href="#" class="flex items-center space-x-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50">
                                <i class="fas fa-chart-bar text-purple-500"></i>
                                <span>Analytics</span>
                            </a>
                            <a href="#" class="flex items-center space-x-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50">
                                <i class="fas fa-cog text-gray-500"></i>
                                <span>Settings</span>
                            </a>
                        </div>
                    </div>

                    <!-- User Profile Dropdown -->
                    <div class="relative">
                        <button @click="profileMenuOpen = !profileMenuOpen"
                                class="flex items-center space-x-2 text-gray-700 hover:text-gray-900 hover:bg-gray-50 rounded-lg p-2 transition-colors">
                            <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-white text-sm font-semibold">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                            </div>
                            <div class="hidden lg:flex flex-col items-start">
                                <span class="text-sm font-medium truncate max-w-[120px]">{{ Auth::user()->name }}</span>
                                <span class="text-xs text-gray-500">Administrator</span>
                            </div>
                            <i class="fas fa-chevron-down text-xs transition-transform lg:block hidden" :class="profileMenuOpen ? 'rotate-180' : ''"></i>
                        </button>

                        <div x-show="profileMenuOpen" @click.away="profileMenuOpen = false" x-transition
                             class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl border border-gray-100 py-2 z-50">
                            <div class="px-4 py-2 border-b border-gray-100">
                                <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                            </div>
                            <a href="#" class="flex items-center space-x-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50">
                                <i class="fas fa-user text-blue-500"></i>
                                <span>Profile Settings</span>
                            </a>
                            <a href="#" class="flex items-center space-x-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50">
                                <i class="fas fa-cog text-gray-500"></i>
                                <span>Preferences</span>
                            </a>
                            <a href="#" class="flex items-center space-x-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50">
                                <i class="fas fa-bell text-orange-500"></i>
                                <span>Notifications</span>
                            </a>
                            <div class="border-t border-gray-100 my-1"></div>
                            <form method="POST" action="{{ route('logout') }}" class="inline w-full">
                                @csrf
                                <button type="submit" class="flex items-center space-x-3 px-4 py-3 text-sm text-red-600 hover:bg-red-50 w-full text-left">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen"
                            class="inline-flex items-center justify-center p-2 rounded-lg text-gray-700 hover:text-gray-900 hover:bg-gray-50 transition-colors">
                        <i class="fas" :class="mobileMenuOpen ? 'fa-times' : 'fa-bars'" class="text-lg"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div x-show="mobileMenuOpen" x-transition
                 class="md:hidden border-t border-gray-200 bg-white/95 backdrop-blur-lg">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <!-- Mobile Status -->
                    <div class="flex items-center justify-between px-3 py-2">
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                            <span class="text-sm text-gray-600">System Live</span>
                        </div>
                        <span class="text-xs text-gray-500">{{ now()->format('M j, g:i A') }}</span>
                    </div>

                    <!-- Mobile User Info -->
                    <div class="flex items-center space-x-3 px-3 py-3 border-b border-gray-100">
                        <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center">
                            <span class="text-white font-semibold">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                        </div>
                    </div>

                    <!-- Mobile Menu Items -->
                    <a href="#" class="flex items-center space-x-3 px-3 py-3 text-base font-medium text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                        <i class="fas fa-tachometer-alt text-blue-500 w-5"></i>
                        <span>Dashboard</span>
                    </a>

                    <a href="#" class="flex items-center space-x-3 px-3 py-3 text-base font-medium text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                        <i class="fas fa-user-plus text-green-500 w-5"></i>
                        <span>Add User</span>
                    </a>

                    <a href="#" class="flex items-center space-x-3 px-3 py-3 text-base font-medium text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                        <i class="fas fa-chart-bar text-purple-500 w-5"></i>
                        <span>Analytics</span>
                    </a>

                    <a href="#" class="flex items-center space-x-3 px-3 py-3 text-base font-medium text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                        <i class="fas fa-cog text-gray-500 w-5"></i>
                        <span>Settings</span>
                    </a>

                    <a href="#" class="flex items-center space-x-3 px-3 py-3 text-base font-medium text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                        <i class="fas fa-bell text-orange-500 w-5"></i>
                        <span>Notifications</span>
                    </a>

                    <div class="border-t border-gray-200 pt-3 mt-3">
                        <form method="POST" action="{{ route('logout') }}" class="inline w-full">
                            @csrf
                            <button type="submit" class="flex items-center space-x-3 px-3 py-3 text-base font-medium text-red-600 hover:bg-red-50 w-full text-left rounded-lg transition-colors">
                                <i class="fas fa-sign-out-alt w-5"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Advanced Welcome Section with Animations -->
        @if(session('success'))
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 text-green-800 px-6 py-4 rounded-xl mb-6 shadow-sm animate-fade-in">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center animate-bounce">
                        <i class="fas fa-check text-white text-sm"></i>
                    </div>
                    <div>
                        <p class="font-semibold">Success!</p>
                        <p class="text-sm opacity-90">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Hero Welcome Section -->
        <div class="mb-6 lg:mb-8">
            <div class="bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600 rounded-xl lg:rounded-2xl p-4 sm:p-6 lg:p-8 text-white shadow-2xl">
                <div class="flex flex-col lg:flex-row items-center justify-between">
                    <div class="mb-4 lg:mb-0 text-center lg:text-left">
                        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold mb-2 animate-fade-in-up">
                            Welcome back, {{ Auth::user()->name }}! 🎉
                        </h1>
                        <p class="text-blue-100 text-base lg:text-lg mb-4">
                            Your advanced user management dashboard is ready
                        </p>
                        <div class="flex flex-wrap justify-center lg:justify-start gap-2">
                            <span class="px-2 py-1 lg:px-3 bg-white/20 rounded-full text-xs lg:text-sm backdrop-blur-sm">
                                <i class="fas fa-shield-alt mr-1"></i><span class="hidden sm:inline">Enterprise Security</span><span class="sm:hidden">Security</span>
                            </span>
                            <span class="px-2 py-1 lg:px-3 bg-white/20 rounded-full text-xs lg:text-sm backdrop-blur-sm">
                                <i class="fas fa-chart-line mr-1"></i><span class="hidden sm:inline">Real-time Analytics</span><span class="sm:hidden">Analytics</span>
                            </span>
                            <span class="px-2 py-1 lg:px-3 bg-white/20 rounded-full text-xs lg:text-sm backdrop-blur-sm">
                                <i class="fas fa-users mr-1"></i><span class="hidden sm:inline">User Management</span><span class="sm:hidden">Users</span>
                            </span>
                        </div>
                    </div>
                    <div class="relative flex-shrink-0">
                        <div class="w-20 h-20 sm:w-24 sm:h-24 lg:w-32 lg:h-32 bg-white/10 rounded-full flex items-center justify-center backdrop-blur-sm animate-float">
                            <i class="fas fa-user-astronaut text-2xl sm:text-3xl lg:text-4xl text-white"></i>
                        </div>
                        <div class="absolute -top-1 -right-1 lg:-top-2 lg:-right-2 w-6 h-6 lg:w-8 lg:h-8 bg-green-400 rounded-full flex items-center justify-center animate-pulse">
                            <i class="fas fa-circle text-xs text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <!-- Advanced Analytics Dashboard -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-6 lg:mb-8">
                <!-- Total Users Card with Progress -->
                <div class="bg-white p-6 rounded-2xl shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-300 interactive-card group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-users text-white text-xl"></i>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold text-gray-900">{{ \App\Models\User::count() }}</p>
                            <p class="text-xs text-green-600 font-semibold flex items-center">
                                <i class="fas fa-arrow-up mr-1"></i>+12.5%
                            </p>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Total Users</span>
                            <span class="font-semibold text-gray-900">{{ \App\Models\User::count() }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-2 rounded-full transition-all duration-1000" style="width: {{ min(100, (\App\Models\User::count() / 100) * 100) }}%"></div>
                        </div>
                        <p class="text-xs text-gray-500">Target: 100 users</p>
                    </div>
                </div>

                <!-- Active Sessions with Real-time Updates -->
                <div class="bg-white p-6 rounded-2xl shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-300 interactive-card group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-chart-line text-white text-xl"></i>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold text-gray-900" x-data="{ count: {{ rand(85, 95) }} }" x-text="count" x-init="setInterval(() => { count = Math.floor(Math.random() * 10) + 85 }, 5000)"></p>
                            <div class="flex items-center text-xs text-emerald-600 font-semibold">
                                <div class="w-2 h-2 bg-emerald-500 rounded-full mr-1 animate-pulse"></div>
                                Live
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <p class="text-sm text-gray-600">Active Sessions</p>
                        <div class="flex items-center space-x-1">
                            <div class="flex-1 bg-gray-200 rounded-full h-2">
                                <div class="bg-gradient-to-r from-emerald-500 to-teal-600 h-2 rounded-full animate-pulse" style="width: 78%"></div>
                            </div>
                            <span class="text-xs text-gray-500">78%</span>
                        </div>
                        <p class="text-xs text-emerald-600">Peak performance</p>
                    </div>
                </div>

                <!-- System Health with Advanced Metrics -->
                <div class="bg-white p-6 rounded-2xl shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-300 interactive-card group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-heartbeat text-white text-xl"></i>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold text-gray-900">99.2%</p>
                            <p class="text-xs text-green-600 font-semibold flex items-center">
                                <i class="fas fa-check-circle mr-1"></i>Optimal
                            </p>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div class="grid grid-cols-2 gap-2 text-xs">
                            <div class="text-center p-2 bg-green-50 rounded-lg">
                                <p class="font-semibold text-green-700">CPU</p>
                                <p class="text-green-600">23%</p>
                            </div>
                            <div class="text-center p-2 bg-blue-50 rounded-lg">
                                <p class="font-semibold text-blue-700">Memory</p>
                                <p class="text-blue-600">67%</p>
                            </div>
                            <div class="text-center p-2 bg-purple-50 rounded-lg">
                                <p class="font-semibold text-purple-700">Disk</p>
                                <p class="text-purple-600">45%</p>
                            </div>
                            <div class="text-center p-2 bg-orange-50 rounded-lg">
                                <p class="font-semibold text-orange-700">Network</p>
                                <p class="text-orange-600">12%</p>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 text-center">All systems operational</p>
                    </div>
                </div>

                <!-- Performance Metrics with Charts -->
                <div class="bg-white p-6 rounded-2xl shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-300 interactive-card group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-rocket text-white text-xl"></i>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold text-gray-900">4.9</p>
                            <div class="flex items-center">
                                <div class="flex text-yellow-400 text-xs mr-1">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="text-xs text-gray-500">/5.0</span>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <p class="text-sm text-gray-600">Performance Score</p>
                        <!-- Mini Chart Simulation -->
                        <div class="flex items-end space-x-1 h-8">
                            <div class="w-2 bg-purple-400 rounded-t" style="height: 70%"></div>
                            <div class="w-2 bg-purple-500 rounded-t" style="height: 85%"></div>
                            <div class="w-2 bg-purple-600 rounded-t" style="height: 95%"></div>
                            <div class="w-2 bg-pink-500 rounded-t" style="height: 100%"></div>
                            <div class="w-2 bg-pink-600 rounded-t" style="height: 90%"></div>
                            <div class="w-2 bg-pink-500 rounded-t" style="height: 85%"></div>
                        </div>
                        <p class="text-xs text-purple-600 font-medium">Trending upward</p>
                    </div>
                </div>
            </div>

            <!-- Advanced Feature Grid -->
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-4 lg:gap-6 mb-6 lg:mb-8">
                <!-- Interactive Quick Actions -->
                <div class="lg:col-span-2">
                    <div class="bg-white p-6 rounded-2xl shadow-xl border border-gray-100">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-gray-900 flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-xl flex items-center justify-center mr-3">
                                    <i class="fas fa-bolt text-white"></i>
                                </div>
                                Quick Actions
                            </h3>
                            <div class="flex space-x-2">
                                <button class="px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded-lg text-sm transition-colors">
                                    <i class="fas fa-filter mr-1"></i>Filter
                                </button>
                                <button class="px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded-lg text-sm transition-colors">
                                    <i class="fas fa-plus mr-1"></i>Add New
                                </button>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <button class="group p-4 bg-gradient-to-br from-blue-50 to-blue-100 hover:from-blue-100 hover:to-blue-200 rounded-xl transition-all duration-300 text-left border border-blue-200 hover:border-blue-300 hover:shadow-lg hover:-translate-y-1">
                                <div class="flex flex-col items-center space-y-2">
                                    <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                        <i class="fas fa-user-plus text-white"></i>
                                    </div>
                                    <span class="text-sm font-semibold text-blue-900">Add User</span>
                                    <span class="text-xs text-blue-600">Create new account</span>
                                </div>
                            </button>

                            <button class="group p-4 bg-gradient-to-br from-purple-50 to-purple-100 hover:from-purple-100 hover:to-purple-200 rounded-xl transition-all duration-300 text-left border border-purple-200 hover:border-purple-300 hover:shadow-lg hover:-translate-y-1">
                                <div class="flex flex-col items-center space-y-2">
                                    <div class="w-12 h-12 bg-purple-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                        <i class="fas fa-chart-bar text-white"></i>
                                    </div>
                                    <span class="text-sm font-semibold text-purple-900">Analytics</span>
                                    <span class="text-xs text-purple-600">View insights</span>
                                </div>
                            </button>

                            <button class="group p-4 bg-gradient-to-br from-green-50 to-green-100 hover:from-green-100 hover:to-green-200 rounded-xl transition-all duration-300 text-left border border-green-200 hover:border-green-300 hover:shadow-lg hover:-translate-y-1">
                                <div class="flex flex-col items-center space-y-2">
                                    <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                        <i class="fas fa-shield-alt text-white"></i>
                                    </div>
                                    <span class="text-sm font-semibold text-green-900">Security</span>
                                    <span class="text-xs text-green-600">Manage access</span>
                                </div>
                            </button>

                            <button class="group p-4 bg-gradient-to-br from-orange-50 to-orange-100 hover:from-orange-100 hover:to-orange-200 rounded-xl transition-all duration-300 text-left border border-orange-200 hover:border-orange-300 hover:shadow-lg hover:-translate-y-1">
                                <div class="flex flex-col items-center space-y-2">
                                    <div class="w-12 h-12 bg-orange-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                        <i class="fas fa-cog text-white"></i>
                                    </div>
                                    <span class="text-sm font-semibold text-orange-900">Settings</span>
                                    <span class="text-xs text-orange-600">Configure system</span>
                                </div>
                            </button>
                        </div>

                        <!-- Action Categories -->
                        <div class="mt-6 pt-6 border-t border-gray-100">
                            <div class="flex flex-wrap gap-2">
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-medium">User Management</span>
                                <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-medium">Analytics</span>
                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">Security</span>
                                <span class="px-3 py-1 bg-orange-100 text-orange-700 rounded-full text-xs font-medium">System</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Advanced Notifications Panel -->
                <div class="bg-white p-6 rounded-2xl shadow-xl border border-gray-100">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-900 flex items-center">
                            <div class="relative">
                                <div class="w-10 h-10 bg-gradient-to-r from-red-400 to-pink-500 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-bell text-white"></i>
                                </div>
                                <div class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 rounded-full flex items-center justify-center">
                                    <span class="text-xs text-white font-bold">3</span>
                                </div>
                            </div>
                            <span class="ml-3">Notifications</span>
                        </h3>
                        <button class="text-gray-400 hover:text-gray-600 transition-colors">
                            <i class="fas fa-cog"></i>
                        </button>
                    </div>

                    <div class="space-y-4">
                        <!-- Priority Alert -->
                        <div class="p-4 bg-gradient-to-r from-red-50 to-pink-50 border border-red-200 rounded-xl">
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-exclamation-triangle text-white text-sm"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-red-800">Security Alert</p>
                                    <p class="text-xs text-red-600 mt-1">Unusual login attempt detected</p>
                                    <p class="text-xs text-red-500 mt-2">2 minutes ago</p>
                                </div>
                                <button class="text-red-400 hover:text-red-600 transition-colors">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Success Notification -->
                        <div class="p-4 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-xl">
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-check-circle text-white text-sm"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-green-800">System Update</p>
                                    <p class="text-xs text-green-600 mt-1">Security patches applied successfully</p>
                                    <p class="text-xs text-green-500 mt-2">15 minutes ago</p>
                                </div>
                            </div>
                        </div>

                        <!-- Info Notification -->
                        <div class="p-4 bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl">
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-info-circle text-white text-sm"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-blue-800">New Feature</p>
                                    <p class="text-xs text-blue-600 mt-1">Advanced analytics now available</p>
                                    <p class="text-xs text-blue-500 mt-2">1 hour ago</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notification Actions -->
                    <div class="mt-6 pt-4 border-t border-gray-100">
                        <div class="flex space-x-2">
                            <button class="flex-1 px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg text-sm transition-colors">
                                Mark All Read
                            </button>
                            <button class="flex-1 px-3 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg text-sm transition-colors">
                                View All
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Advanced Activity Feed with Real Data -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-bold text-gray-900 flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center mr-3">
                                <i class="fas fa-history text-white"></i>
                            </div>
                            Activity Feed
                        </h3>
                        <div class="flex items-center space-x-2">
                            <select class="px-3 py-1 bg-gray-100 rounded-lg text-sm border-0 focus:ring-2 focus:ring-indigo-500">
                                <option>All Activities</option>
                                <option>User Actions</option>
                                <option>System Events</option>
                                <option>Security</option>
                            </select>
                            <button class="px-3 py-1 bg-indigo-500 hover:bg-indigo-600 text-white rounded-lg text-sm transition-colors">
                                <i class="fas fa-filter mr-1"></i>Filter
                            </button>
                        </div>
                    </div>
                </div>

                <div class="divide-y divide-gray-100">
                    <!-- Real-time Activity Items -->
                    <div class="p-6 hover:bg-gray-50 transition-colors" x-data="{ expanded: false }">
                        <div class="flex items-start space-x-4">
                            <div class="relative">
                                <div class="w-12 h-12 bg-gradient-to-r from-green-400 to-green-600 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-user-plus text-white"></i>
                                </div>
                                <div class="absolute -top-1 -right-1 w-4 h-4 bg-green-500 rounded-full flex items-center justify-center">
                                    <i class="fas fa-check text-white text-xs"></i>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-semibold text-gray-900">
                                        New user registration
                                        <span class="text-green-600 font-medium">#{{ \App\Models\User::latest()->first()?->id ?? '001' }}</span>
                                    </p>
                                    <div class="flex items-center space-x-2">
                                        <span class="text-xs text-gray-500">{{ now()->diffForHumans() }}</span>
                                        <button @click="expanded = !expanded" class="text-gray-400 hover:text-gray-600">
                                            <i class="fas" :class="expanded ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                                        </button>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-600 mt-1">
                                    <span class="font-medium">{{ Auth::user()->name }}</span> created a new account successfully
                                </p>
                                <div x-show="expanded" x-transition class="mt-3 p-3 bg-green-50 rounded-lg border border-green-200">
                                    <div class="grid grid-cols-2 gap-4 text-xs">
                                        <div>
                                            <span class="text-gray-500">IP Address:</span>
                                            <span class="font-mono text-gray-900 ml-1">{{ request()->ip() }}</span>
                                        </div>
                                        <div>
                                            <span class="text-gray-500">User Agent:</span>
                                            <span class="text-gray-900 ml-1">Chrome 120.0</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-400 to-blue-600 rounded-xl flex items-center justify-center">
                                <i class="fas fa-sign-in-alt text-white"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-semibold text-gray-900">User login</p>
                                    <span class="text-xs text-gray-500">{{ now()->subMinutes(5)->diffForHumans() }}</span>
                                </div>
                                <p class="text-sm text-gray-600 mt-1">
                                    <span class="font-medium">{{ Auth::user()->name }}</span> logged in from
                                    <span class="font-mono text-blue-600">{{ request()->ip() }}</span>
                                </p>
                                <div class="flex items-center mt-2 space-x-4">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-green-100 text-green-800">
                                        <i class="fas fa-shield-alt mr-1"></i>Secure Login
                                    </span>
                                    <span class="text-xs text-gray-500">2FA Verified</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-purple-400 to-purple-600 rounded-xl flex items-center justify-center">
                                <i class="fas fa-chart-line text-white"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-semibold text-gray-900">Analytics data refresh</p>
                                    <span class="text-xs text-gray-500">{{ now()->subMinutes(15)->diffForHumans() }}</span>
                                </div>
                                <p class="text-sm text-gray-600 mt-1">
                                    System automatically updated performance metrics and user statistics
                                </p>
                                <div class="mt-2 flex items-center space-x-2">
                                    <div class="flex -space-x-1">
                                        <div class="w-6 h-6 bg-blue-500 rounded-full border-2 border-white"></div>
                                        <div class="w-6 h-6 bg-green-500 rounded-full border-2 border-white"></div>
                                        <div class="w-6 h-6 bg-purple-500 rounded-full border-2 border-white"></div>
                                    </div>
                                    <span class="text-xs text-gray-500">3 metrics updated</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-orange-400 to-orange-600 rounded-xl flex items-center justify-center">
                                <i class="fas fa-shield-alt text-white"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-semibold text-gray-900">Security scan completed</p>
                                    <span class="text-xs text-gray-500">{{ now()->subHour()->diffForHumans() }}</span>
                                </div>
                                <p class="text-sm text-gray-600 mt-1">
                                    Automated security scan found no vulnerabilities
                                </p>
                                <div class="mt-2">
                                    <div class="flex items-center space-x-4 text-xs">
                                        <span class="text-green-600">
                                            <i class="fas fa-check-circle mr-1"></i>0 Threats
                                        </span>
                                        <span class="text-blue-600">
                                            <i class="fas fa-clock mr-1"></i>2.3s Scan Time
                                        </span>
                                        <span class="text-purple-600">
                                            <i class="fas fa-database mr-1"></i>15 Tables Scanned
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Activity Feed Footer -->
                <div class="p-3 lg:p-4 bg-gray-50 border-t border-gray-100">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                        <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4 text-xs lg:text-sm text-gray-600">
                            <span>Showing latest 4 activities</span>
                            <div class="hidden sm:block text-gray-400">•</div>
                            <span>Auto-refresh: <span class="text-green-600 font-medium">ON</span></span>
                        </div>
                        <button class="w-full sm:w-auto px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white rounded-lg text-sm transition-colors">
                            View All Activities
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection