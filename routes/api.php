<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::get('/posts', [PostController::class, 'index']);


Route::get('/posts/{post}', function (App\Models\Post $post) {
    return response()->json($post);
});