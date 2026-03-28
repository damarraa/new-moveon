<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Operator\ManifestController;
use App\Http\Controllers\Operator\PelaporanKapalController;
use App\Http\Controllers\Operator\ProfilingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==================== BERANDA ====================
Route::get('/', function () {
    return view('Beranda.welcome');
})->name('welcome');

// ==================== MANIFEST PUBLIK ====================
Route::get('/manifest-pelayaran', function () {
    return view('Beranda.manifest-pelayaran');
})->name('manifest.pelayaran');

Route::get('/manifest-penyeberangan', function () {
    return view('Beranda.manifest-penyeberangan');
})->name('manifest.penyeberangan');


// ==================== AUTH GUEST ====================
Route::middleware('guest')->group(function () {

    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');

    // Forgot Password
    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->name('password.request');

    // Register umum arahkan ke beranda
    Route::get('/register', function () {
        return redirect()->route('welcome');
    })->name('register');

    // Register operator
    Route::get('/register/operator', [RegisterController::class, 'showOperatorForm'])->name('register.operator');
    Route::post('/register/operator', [RegisterController::class, 'registerOperator'])->name('register.operator.store');

    // Register internal
    Route::get('/register/internal', [RegisterController::class, 'showInternalForm'])->name('register.internal');
    Route::post('/register/internal', [RegisterController::class, 'registerInternal'])->name('register.internal.store');
});


// ==================== AUTH USER ====================
Route::middleware('auth')->group(function () {

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // ==================== OPERATOR ====================
    Route::prefix('operator')->name('operator.')->group(function () {
        Route::resource('profiling', ProfilingController::class);
        Route::resource('manifest', ManifestController::class);
        Route::resource('pelaporan-kapal', PelaporanKapalController::class);
    });


 
});