<?php

use Hup234design\Cms\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/{slug}', [PageController::class, 'page'])->name('page');
Route::get('/', [PageController::class, 'home'])->name('home');
