<?php

use App\Http\Controllers\Docs\DocsController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome2');
Route::view('posts', 'posts');

Route::redirect('open-source', 'documentation')->name('open-source');

Route::get('documentation', [DocsController::class, 'index'])->name('docs');
Route::get('documentation/{repository}/{alias?}', [DocsController::class, 'repository']);
Route::get('documentation/{repository}/{alias}/{slug}', [DocsController::class, 'show'])->where('slug', '.*');
