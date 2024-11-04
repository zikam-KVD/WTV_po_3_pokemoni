<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// TODO: pojmenované routy
Route::get('/detail', function () {
    return view('detail');
});
