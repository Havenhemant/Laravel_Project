<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// REST API endpoint to fetch all posts in JSON format
Route::get('/posts', [PostController::class, 'index']);

// Optional: Endpoint for single post
Route::get('/posts/{post}', function (App\Models\Post $post) {
    return response()->json($post);
});