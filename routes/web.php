<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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


Route::get('/blog', [PostController::class, 'index']);
// Route::post('/blog', [PostController::class, 'store']);
// Route::put('/blog/{id}', [PostController::class, 'update']);
// Route::delete('/blog/{id}', [PostController::class, 'destroy']);
