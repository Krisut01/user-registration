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

// Debug route to check asset loading
Route::get('/debug-assets', function () {
    $manifestPath = public_path('build/manifest.json');
    $manifest = file_exists($manifestPath) ? json_decode(file_get_contents($manifestPath), true) : null;
    
    // Get actual asset URLs that would be generated
    $cssEntry = $manifest['resources/css/app.css']['file'] ?? null;
    $jsEntry = $manifest['resources/js/app.js']['file'] ?? null;
    
    $appUrl = config('app.url');
    $assetUrl = $cssEntry ? asset('build/' . $cssEntry) : 'N/A';
    
    return response()->json([
        'manifest_exists' => file_exists($manifestPath),
        'environment' => app()->environment(),
        'app_url' => $appUrl,
        'app_url_env' => env('APP_URL'),
        'asset_url_example' => $assetUrl,
        'css_file' => $cssEntry,
        'js_file' => $jsEntry,
        'manifest_content' => $manifest,
        'build_directory' => scandir(public_path('build')),
        'public_path' => public_path(),
    ]);
});