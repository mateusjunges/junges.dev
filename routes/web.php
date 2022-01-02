<?php

use App\Http\Controllers\Docs\DocsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('open-source', function () {})->name('open-source');

Route::view('posts', 'posts');
Route::get('documentation', [DocsController::class, 'index'])->name('docs');
Route::get('documentation/{repository}/{alias?}', [DocsController::class, 'repository']);
Route::get('documentation/{repository}/{alias}/{slug}', [DocsController::class, 'show'])->where('slug', '.*');
