<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public Frontend Routes
Route::get('/', [\Modules\News\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/category/{slug}', [\Modules\News\App\Http\Controllers\HomeController::class, 'category'])->name('category.show');
Route::get('/news/{slug}', [\Modules\News\App\Http\Controllers\HomeController::class, 'show'])->name('news.show');

Route::get('/admin/dashboard', function () {
    return Inertia::render('Dashboard', [
        'message' => 'Hello from Inertia!',
    ]);
});

Route::resource('admin/categories', \Modules\Category\App\Http\Controllers\CategoryController::class);
Route::resource('admin/posts', \Modules\News\App\Http\Controllers\PostController::class);
