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
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/trang-chu', [HomeController::class, 'index']);

Route::prefix('categories')->group( function() {
    Route::get('/index', [CategoryController::class, 'index'])->name('index');
    Route::get('/show/{id}', [CategoryController::class, 'show']);
    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
    Route::get('/create', [CategoryController::class, 'create']);
    Route::get('/change_status/{id}', [CategoryController::class, 'changeStatus'])->name('changeStatus');
    Route::put('update/{id}', [CategoryController::class, 'update'])->name('update');
    Route::post('/store', [CategoryController::class, 'store']);
    Route::delete('delete/{id}', [CategoryController::class, 'destroy'])->name('delete');
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