<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/donasi', function () {
    return view('landing_page.donasi.index');
})->name('donasi.index');

Route::get('/donasi/{id}', function ($id) {
    // Sementara menggunakan view statis untuk demo
    return view('landing_page.donasi.show');
})->name('donasi.show');

Route::get('/event', function () {
    return view('landing_page.event.index');
})->name('event.index');

Route::get('/event/{id}', function ($id) {
    // Sementara menggunakan view statis untuk demo
    return view('landing_page.event.show');
})->name('event.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
