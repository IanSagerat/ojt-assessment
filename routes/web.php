<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PostDashboardController;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'loginRoute' => route('login'),
        'registerRoute' => route('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/postdashboard', [PostDashboardController::class, 'index'])
    ->name('postdashboard')
    ->middleware('auth');

    Route::post('/posts', [PostController::class, 'store'])->name('posts.store'); // Create Post
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index'); // Fetch All Posts
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update'); // Edit Post
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy'); // Delete Post
});

