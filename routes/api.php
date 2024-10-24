<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

Route::post('login', [LoginController::class, 'authenticate'])->name('login');
Route::post('register', [LoginController::class, 'register'])->name('register');

Route::apiResource('posts', PostController::class);
Route::apiResource('posts.comments', CommentController::class)
    ->only(['store'])
    ->shallow();
