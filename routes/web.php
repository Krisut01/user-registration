<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;

// Optimized home route with caching
Route::get('/', function () {
    // Cache the user count for 5 minutes to reduce database queries
    $userCount = Cache::remember('user_count', 300, function () {
        return \App\Models\User::count();
    });

    return view('welcome', compact('userCount'));
});

// Authentication Routes (Using Laravel Breeze)
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

// Debug route to check asset loading (remove in production)
Route::get('/debug-assets', function () {
    $manifestPath = public_path('build/manifest.json');
    $cssExists = file_exists(public_path('css/app.css'));
    $jsExists = file_exists(public_path('js/app.js'));

    return response()->json([
        'manifest_exists' => file_exists($manifestPath),
        'css_exists' => $cssExists,
        'js_exists' => $jsExists,
        'environment' => app()->environment(),
        'manifest_content' => file_exists($manifestPath) ? json_decode(file_get_contents($manifestPath), true) : null,
        'build_directory' => scandir(public_path('build')),
    ]);
});