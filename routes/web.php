<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Auth
Route::get('/register-operator', function () {
    return view('auth.register-operator');
});
Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
});

// Form Manifest
Route::get('/checkin-manifest', function () {
    return view('checkin-manifest');
});

Route::get('/manifest-pelayaran', function () {
    return view('manifest-pelayaran');
});
Route::get('/manifest-penyeberangan', function () {
    return view('manifest-penyeberangan');
});
