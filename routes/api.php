<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

Route::post('login', [LoginController::class, 'authenticate'])->name('login');
Route::post('register', [LoginController::class, 'register'])->name('register');

Route::apiResource('posts', PostController::class)->parameters([
    'posts' => 'id',
]);
Route::apiResource('posts.comments', CommentController::class)
    ->parameters([
        'posts' => 'id',
    ])
    ->only(['store'])
    ->shallow()
    ->middleware('auth:sanctum');
