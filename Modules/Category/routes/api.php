<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Category\App\Http\Controllers\CategoryController;

/*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
*/

// --- 1. Public Routes (Ai cũng xem được) ---
Route::prefix('v1')->group(function () {
    // GET /api/category/v1/categories
    // Dùng Route::get cho hành động cụ thể
    Route::get('categories', [CategoryController::class, 'index']);
});
// --- 2. Protected Routes (Phải đăng nhập mới dùng được) ---
Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    // POST /api/category/v1/categories (Tạo mới)
    Route::post('categories', [CategoryController::class, 'store']);
    
    // (Sau này thêm update/delete vào đây)
});