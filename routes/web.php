<?php

use Hup234design\Cms\Http\Controllers\PageController;
use Hup234design\Cms\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/posts/category/{slug}', [PostController::class, 'category'])->name('posts.category');
Route::get('/posts/{slug}', [PostController::class, 'post'])->name('posts.post');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

Route::get('/{slug}', [PageController::class, 'page'])->name('pages.page');
Route::get('/', [PageController::class, 'home'])->name('pages.home');
