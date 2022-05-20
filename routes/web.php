<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\Docs\DocsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OpenSourceController;
use Illuminate\Support\Facades\Route;

Route::any('/', HomeController::class)->name('home');
//Route::redirect('/', 'open-source');
Route::any('open-source', OpenSourceController::class)->name('open-source');
Route::any('community', CommunityController::class);
Route::view('posts', 'posts');

Route::get('blog', [BlogController::class, 'index'])->name('blog.index');

Route::get('documentation', [DocsController::class, 'index'])->name('docs');
Route::get('documentation/{repository}/{alias?}', [DocsController::class, 'repository']);
Route::get('documentation/{repository}/{alias}/{slug}', [DocsController::class, 'show'])->where('slug', '.*');
