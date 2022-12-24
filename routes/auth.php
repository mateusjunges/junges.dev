<?php declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('login', fn () => 'Login')->name('login');
Route::get('register', fn () => 'Register')->name('register');
