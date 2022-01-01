<?php

use App\Http\Controllers\Docs\DocsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('open-source', function () {

})->name('open-source');

Route::view('posts', 'posts');
Route::get('/docs', [DocsController::class, 'index'])->name('docs');
Route::get('/docs/{repository}/{alias?}', [DocsController::class, 'repository']);
Route::get('/docs/{repository}/{alias}/{slug}', [DocsController::class, 'show'])->where('slug', '.*');
