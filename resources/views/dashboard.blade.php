@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center min-w-0 flex-1">
                    <h1 class="text-lg sm:text-xl font-semibold text-gray-900 truncate">User Registration System</h1>
                </div>
                <div class="flex items-center space-x-2 sm:space-x-4 ml-4">
                    <span class="text-sm sm:text-base text-gray-700 truncate max-w-[80px] sm:max-w-none">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="flex items-center space-x-1 text-gray-500 hover:text-gray-700 transition-colors p-2 rounded-md hover:bg-gray-50">
                            <i class="fas fa-sign-out-alt text-sm"></i>
                            <span class="hidden sm:inline text-sm">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Welcome Message -->
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="px-4 py-6 sm:px-0">
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900">Dashboard</h2>
                <p class="text-gray-600">Welcome back, {{ Auth::user()->name }}!</p>
            </div>

            <!-- Enhanced Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-lg border border-slate-200 hover-lift interactive-card">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-600">Total Users</p>
                            <p class="text-3xl font-bold text-slate-900">{{ \App\Models\User::count() }}</p>
                            <p class="text-xs text-green-600 font-medium mt-1">
                                <i class="fas fa-arrow-up mr-1"></i>+12% from last month
                            </p>
                        </div>
                        <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-users text-white text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg border border-slate-200 hover-lift interactive-card">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-600">Active Sessions</p>
                            <p class="text-3xl font-bold text-slate-900">{{ rand(85, 95) }}</p>
                            <p class="text-xs text-emerald-600 font-medium mt-1">
                                <i class="fas fa-circle text-xs mr-1"></i>Live now
                            </p>
                        </div>
                        <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-chart-line text-white text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg border border-slate-200 hover-lift interactive-card">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-600">System Health</p>
                            <p class="text-3xl font-bold text-slate-900">98.5%</p>
                            <p class="text-xs text-emerald-600 font-medium mt-1">
                                <i class="fas fa-check-circle mr-1"></i>All systems operational
                            </p>
                        </div>
                        <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-heartbeat text-white text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg border border-slate-200 hover-lift interactive-card">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-600">Satisfaction</p>
                            <p class="text-3xl font-bold text-slate-900">4.9</p>
                            <div class="flex items-center mt-1">
                                <div class="flex text-yellow-400 text-xs">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="text-xs text-slate-600 ml-1">/5.0</span>
                            </div>
                        </div>
                        <div class="w-14 h-14 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-xl flex items-center justify-center">
                            <i class="fas fa-star text-white text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-lg border border-slate-200">
                    <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center">
                        <i class="fas fa-bolt text-yellow-500 mr-3"></i>
                        Quick Actions
                    </h3>
                    <div class="grid grid-cols-2 gap-3">
                        <button class="p-3 bg-slate-50 hover:bg-slate-100 rounded-lg transition-colors text-left">
                            <i class="fas fa-user-plus text-teal-600 mr-2"></i>
                            <span class="text-sm font-medium">Add User</span>
                        </button>
                        <button class="p-3 bg-slate-50 hover:bg-slate-100 rounded-lg transition-colors text-left">
                            <i class="fas fa-cog text-slate-600 mr-2"></i>
                            <span class="text-sm font-medium">Settings</span>
                        </button>
                        <button class="p-3 bg-slate-50 hover:bg-slate-100 rounded-lg transition-colors text-left">
                            <i class="fas fa-chart-bar text-blue-600 mr-2"></i>
                            <span class="text-sm font-medium">Analytics</span>
                        </button>
                        <button class="p-3 bg-slate-50 hover:bg-slate-100 rounded-lg transition-colors text-left">
                            <i class="fas fa-shield-alt text-green-600 mr-2"></i>
                            <span class="text-sm font-medium">Security</span>
                        </button>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg border border-slate-200">
                    <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center">
                        <i class="fas fa-bell text-red-500 mr-3"></i>
                        Recent Alerts
                    </h3>
                    <div class="space-y-3">
                        <div class="flex items-start space-x-3 p-3 bg-green-50 rounded-lg">
                            <i class="fas fa-check-circle text-green-600 mt-0.5"></i>
                            <div>
                                <p class="text-sm font-medium text-green-800">System Update Completed</p>
                                <p class="text-xs text-green-600">2 minutes ago</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3 p-3 bg-blue-50 rounded-lg">
                            <i class="fas fa-info-circle text-blue-600 mt-0.5"></i>
                            <div>
                                <p class="text-sm font-medium text-blue-800">New User Registration</p>
                                <p class="text-xs text-blue-600">5 minutes ago</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-lg shadow-sm border p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Activity</h3>
                <div class="space-y-4">
                    <div class="flex items-center space-x-4">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-green-600 text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">Account created successfully</p>
                            <p class="text-xs text-gray-500">{{ now()->format('M j, Y \a\t g:i A') }}</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-sign-in-alt text-blue-600 text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">Logged in</p>
                            <p class="text-xs text-gray-500">{{ now()->subMinutes(5)->format('M j, Y \a\t g:i A') }}</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-cog text-purple-600 text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">Profile updated</p>
                            <p class="text-xs text-gray-500">{{ now()->subHour()->format('M j, Y \a\t g:i A') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection