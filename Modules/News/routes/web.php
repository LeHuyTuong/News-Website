<?php

use Illuminate\Support\Facades\Route;
use Modules\News\App\Http\Controllers\HomeController;
use Modules\News\App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Public Routes
Route::middleware('web')->group(function() {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/category/{slug}', [HomeController::class, 'category'])->name('category.show');
    Route::get('/news/{slug}', [HomeController::class, 'show'])->name('news.show');
});

// Admin Routes (Auth Protected)
Route::middleware(['auth', 'web'])->prefix('admin')->group(function () {
    Route::resource('posts', PostController::class)->names('posts');
});
