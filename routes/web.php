<?php

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return view('index', [
        'title' => 'Home',
    ]);
});

Route::get('/about', function () {
    return view('about', [
        'title' => 'About',
        'name' => "Julian",
        'email' => "julian@gmail.com"
    ]);
});

Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{post:slug}', [PostController::class, 'show']);

Route::get('/categories', function () {
    return view('categories', [
        'title' => 'Categories',
        'categories' => Category::all()
    ]);
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.post');

Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->name('register.post');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('/dashboard')->middleware('auth')->group(function() {
    Route::get('/', [DashboardController::class, 'index']);

    Route::prefix('/posts')->group(function() {
        Route::get('/', [DashboardPostController::class, 'index'])->name('dashboard.posts.index');
        Route::get('/create', [DashboardPostController::class, 'create'])->name('dashboard.posts.create');
        Route::post('/', [DashboardPostController::class, 'store'])->name('dashboard.posts.store');
        Route::get('/{post:slug}', [DashboardPostController::class, 'show'])->name('dashboard.posts.show');
        Route::get('/{post:slug}/edit', [DashboardPostController::class, 'edit'])->name('dashboard.posts.edit');
        Route::patch('/{post:slug}', [DashboardPostController::class, 'update'])->name('dashboard.posts.update');
        Route::delete('/{post:slug}', [DashboardPostController::class, 'destroy'])->name('dashboard.posts.destroy');
    });
});

// Route::post('/blog', [PostController::class, 'store']);
// Route::put('/blog/{id}', [PostController::class, 'update']);
// Route::delete('/blog/{id}', [PostController::class, 'destroy']);
