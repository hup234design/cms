<?php

use Hup234design\Cms\Http\Controllers\EventController;
use Hup234design\Cms\Http\Controllers\PageController;
use Hup234design\Cms\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/events/category/{slug}', [EventController::class, 'category'])->name('events.category');
Route::get('/events/{slug}', [EventController::class, 'event'])->name('events.event');
Route::get('/events', [EventController::class, 'index'])->name('events');

Route::get('/posts/category/{slug}', [PostController::class, 'category'])->name('posts.category');
Route::get('/posts/{slug}', [PostController::class, 'post'])->name('posts.post');
Route::get('/posts', [PostController::class, 'index'])->name('posts');

Route::get('/{slug}', [PageController::class, 'page'])->name('pages.page');
Route::get('/', [PageController::class, 'home'])->name('home');
