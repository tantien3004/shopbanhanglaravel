<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;


//Frontend
Route::get('/', [UserController::class, 'login'])->name('home');
Route::get('/trang-chu', [HomeController::class, 'index'])->name('user.home');

//route User
//user login
Route::prefix('user')->group(function ()
{
    // Route::group(['middleware' => ['auth', 'role:Admin, Staff']], function () 
    // {
    //     Route::get('/log-in', [UserController::class, 'login'])->name('user.login');
    // });
    Route::get('/log-in', [UserController::class, 'login'])
            ->name('user.login');
    Route::post('/log-in', [UserController::class, 'checkLogin'])
            ->name('user.checkLogin');
    Route::post('register', [RegisteredUserController::class, 'store'])->name('register');

    Route::post('/search', [HomeController::class, 'search'])->name('search.product');
});
//Category Home Page User
Route::prefix('category')->group(function()
{
    Route::get('/{id}', [CategoryController::class, 'showCategory'])->name('category');
});

//Brand Home Page User
Route::prefix('brand')->group(function()
{
    Route::get('/show/{id}', [BrandController::class, 'showBrand'])->name('brand');
});

//detail product
Route::prefix('product')->group(function()
{
    Route::get('/{id}', [ProductController::class, 'productList'])->name('product');
});

Route::get('/add-to-card/{id}', [CartController::class, 'add'])->name('addToCart');
Route::prefix('cart')->group(function()
{
    Route::get('/', [CartController::class, 'cartList'])->name('cart.list');
    Route::post('/cart', [CartController::class, 'addToCart'])->name('cart.store');
    Route::post('/update-cart', [CartController::class, 'updateCart'])->name('cart.update');
    Route::post('/remove', [CartController::class, 'removeCart'])->name('cart.remove');
    Route::post('/clear', [CartController::class, 'clearAllCart'])->name('cart.clear');
});

//send mail
Route::get('/send-mail', [HomeController::class, 'sendMail'])->name('sendMail');


//End route User
//backend
Route::get('/admin', [AdminController::class, 'index'])->name('index.admin');
Route::get('/dashboard', [AdminController::class, 'show_dashboard'])->name('dashboard.admin');
Route::post('/admin-dashboard', [AdminController::class, 'dashboard']);
Route::get('/logout', [AdminController::class, 'logout']);
//category admin product
Route::prefix('categories')->group( function() {
    Route::get('/index', [CategoryController::class, 'index'])->name('index');
    Route::get('/show/{id}', [CategoryController::class, 'show'])->name('show');
    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::get('/change_status/{id}', [CategoryController::class, 'changeStatus'])->name('changeStatus');
    Route::put('update/{id}', [CategoryController::class, 'update'])->name('update');
    Route::post('/store', [CategoryController::class, 'store'])->name('store');
    Route::delete('delete/{id}', [CategoryController::class, 'destroy'])->name('delete');
});
//brand admin product
Route::prefix('brands')->group( function() {
    Route::get('/index', [BrandController::class, 'index'])->name('index_brands');
    Route::get('/show/{id}', [BrandController::class, 'show'])->name('show_brands');
    Route::get('/edit/{id}', [BrandController::class, 'edit'])->name('edit_brands');
    Route::get('/create', [BrandController::class, 'create'])->name('create_brands');
    Route::get('/change_status/{id}', [BrandController::class, 'changeStatus'])->name('changeStatus_brands');
    Route::put('update/{id}', [BrandController::class, 'update'])->name('update_brands');
    Route::post('/store', [BrandController::class, 'store'])->name('store_brands');
    Route::delete('delete/{id}', [BrandController::class, 'destroy'])->name('delete_brands');
});
//product admin
Route::prefix('products')->group( function() {
    Route::get('/index', [ProductController::class, 'index'])->name('index_products');
    Route::get('/show/{id}', [ProductController::class, 'show'])->name('show_product');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit_product');
    Route::get('/create', [ProductController::class, 'create'])->name('create_product');
    Route::get('/change_status/{id}', [ProductController::class, 'changeStatus'])->name('changeStatus_product');
    Route::put('update/{id}', [ProductController::class, 'update'])->name('update_product');
    Route::post('/store', [ProductController::class, 'store'])->name('store_product');
    Route::delete('delete/{id}', [ProductController::class, 'destroy'])->name('delete_product');
});
//chuyển _ ở name thành .