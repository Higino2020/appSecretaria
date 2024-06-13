<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.index');
});

Auth::routes();

Route::get('/home', function(){
    return view('welcome');
})->name('home');
