<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| HOME (PUBLIC)
|--------------------------------------------------------------------------
*/
Route::get('/', [PostController::class, 'index'])->name('home');


/*
|--------------------------------------------------------------------------
| GUEST ROUTES (LOGIN / REGISTER)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    Route::view('/register', 'auth.register')->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});


/*
|--------------------------------------------------------------------------
| AUTH ROUTES (USER)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // USER DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // POSTS CRUD (USER POSTS)
    Route::resource('posts', PostController::class);

    // LOGOUT
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (ROLE BASED)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->group(function () {

    // Admin dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // USERS CRUD
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');

    // POSTS CRUD (ADMIN)
    Route::get('/admin/posts', [AdminController::class, 'posts'])->name('admin.posts');
    Route::get('/admin/posts/{post}/edit', [AdminController::class, 'editPost'])->name('admin.posts.edit');
    Route::put('/admin/posts/{post}', [AdminController::class, 'updatePost'])->name('admin.posts.update');
    Route::delete('/admin/posts/{post}', [AdminController::class, 'deletePost'])->name('admin.posts.delete');
});
