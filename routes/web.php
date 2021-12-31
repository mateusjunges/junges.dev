<?php

use Illuminate\Support\Facades\Route;

Route::view('posts', 'posts');
Route::get('/', function () {
    return view('welcome');
});

Route::get('open-source', function () {

})->name('open-source');
