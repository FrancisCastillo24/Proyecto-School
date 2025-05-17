<?php

use Illuminate\Support\Facades\Route;

// Vista principal
Route::get('/', function () {
    return view('home');
})->name('home');


Route::get('/home', function () {
    return view('home');  
})->middleware('auth')->name('home');
Auth::routes();


