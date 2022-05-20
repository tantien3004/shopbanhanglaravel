<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

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
//Frontend
Route::get('/', [HomeController::class, 'index']);

Route::get('/trang-chu', [HomeController::class, 'index']);

Route::prefix('categories')->group( function() {
    Route::get('/index', [CategoryController::class, 'index']);
    Route::get('/{id}/show', [CategoryController::class, 'show']);
    Route::get('/{id}/edit', [CategoryController::class, 'edit']);
    Route::get('/create', [CategoryController::class, 'create']);
    Route::put('/{id}', [CategoryController::class, 'update']);
    Route::post('/store', [CategoryController::class, 'store']);
    Route::delete('/{id}', [CategoryController::class, 'destroy']);
});


//backend
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/dashboard', [AdminController::class, 'show_dashboard']);
Route::post('/admin-dashboard', [AdminController::class, 'dashboard']);
Route::get('/logout', [AdminController::class, 'logout']);
//Route::get('/menu', [AdminController::class, 'admin']);


//category product
Route::get('/add-category-product', [CategoryController::class, 'create']);
Route::get('/all-category-product', [CategoryController::class, 'index']);