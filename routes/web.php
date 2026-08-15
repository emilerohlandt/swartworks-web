<?php

use Illuminate\Support\Facades\Route;

// Your existing welcome route
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Your new About page route
Route::get('/about', function () {
    return view('about');
})->name('about');
