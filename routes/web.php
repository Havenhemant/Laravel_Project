<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PageController;
Route::get('/', [ProductController::class, 'index'])->name('home');


Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery.index');
Route::get('/about', [PageController::class, 'about'])->name('about.index');
Route::get('/contact', [PageController::class, 'contact'])->name('contact.index');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::middleware('guest')->group(function () {

    Route::view('/register', 'auth.register')->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);
 
});



Route::middleware('auth')->group(function () {

 
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/orders', [DashboardController::class, 'index'])->name('orders.index');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'placeOrder'])->name('checkout.place');
    
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
    Route::get('/contact', [PostController::class, 'create'])->name('contact.create');
    Route::post('/contact', [PostController::class, 'store'])->name('contact.store');
    Route::get('/my-queries', [PostController::class, 'index'])->name('contact.index');
});



Route::middleware(['auth', 'admin'])->group(function () {

   
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

   
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    Route::get('/admin/queries', [AdminController::class, 'queries'])->name('admin.queries');
    Route::put('/admin/queries/{post}/resolve', [AdminController::class, 'resolveQuery'])->name('admin.queries.resolve');
    Route::delete('/admin/queries/{post}', [AdminController::class, 'deletePost'])->name('admin.queries.delete');
   
    Route::get('/admin/posts', [AdminController::class, 'posts'])->name('admin.posts');
    Route::get('/admin/posts/{post}/edit', [AdminController::class, 'editPost'])->name('admin.posts.edit');
    Route::put('/admin/posts/{post}', [AdminController::class, 'updatePost'])->name('admin.posts.update');
    Route::delete('/admin/posts/{post}', [AdminController::class, 'deletePost'])->name('admin.posts.delete');
    Route::get('/admin/products', [AdminController::class, 'products'])->name('admin.products');
    Route::get('/admin/products/create', [AdminController::class, 'createProduct'])->name('admin.products.create');
    Route::post('/admin/products', [AdminController::class, 'storeProduct'])->name('admin.products.store');
    Route::get('/admin/products/{product}/edit', [AdminController::class, 'editProduct'])->name('admin.products.edit');
    Route::put('/admin/products/{product}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
    Route::delete('/admin/products/{product}', [AdminController::class, 'deleteProduct'])->name('admin.products.delete');
    Route::get('/admin/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::put('/admin/orders/{order}/approve', [AdminController::class, 'approveOrder'])->name('admin.orders.approve');
    Route::put('/admin/orders/{order}/decline', [AdminController::class, 'declineOrder'])->name('admin.orders.decline');
    Route::get('/admin/analytics', [AdminController::class, 'analytics'])->name('admin.analytics');
});
