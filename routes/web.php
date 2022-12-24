<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\HomeController;
use App\Modules\Documentation\Http\Controllers\DocsController;
use App\Modules\Posts\Http\Controllers\OriginalsController;
use App\Modules\Posts\Http\Controllers\ShowPostController;
use Illuminate\Support\Facades\Route;

Route::any('/', HomeController::class)->name('home');
Route::any('community', CommunityController::class);
Route::view('posts', 'posts');

Route::get('blog', [BlogController::class, 'index'])->name('blog.index');

Route::get('documentation', [DocsController::class, 'index'])->name('docs');
Route::get('documentation/{repository}/{alias?}', [DocsController::class, 'repository']);
Route::get('documentation/{repository}/{alias}/{slug}', [DocsController::class, 'show'])->where('slug', '.*');

Route::get('posts', OriginalsController::class)->name('posts.originals');
Route::get('posts/{post:slug}', ShowPostController::class)->name('posts.show');
