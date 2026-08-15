<?php

use Illuminate\Support\Facades\Route;

// Your existing welcome route
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Your new About page route
Route::get('/services', function () {
    return view('services');
})->name('services');
