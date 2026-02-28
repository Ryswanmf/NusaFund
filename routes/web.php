<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/donasi', [\App\Http\Controllers\CampaignController::class, 'publicIndex'])->name('donasi.index');
Route::get('/donasi/{slug}', [\App\Http\Controllers\CampaignController::class, 'publicShow'])->name('donasi.show');

Route::get('/event', function () {
    return view('landing_page.event.index');
})->name('event.index');

Route::get('/event/{id}', function ($id) {
    // Sementara menggunakan view statis untuk demo
    return view('landing_page.event.show');
})->name('event.show');

Route::get('/zakat', function () {
    return view('landing_page.zakat.index');
})->name('zakat.index');

Route::get('/tentang-kami', function () {
    return view('landing_page.tentang_kami.index');
})->name('about');

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('admin/donasi', \App\Http\Controllers\CampaignController::class)->names([
        'index' => 'admin.donasi.index',
        'create' => 'admin.donasi.create',
        'store' => 'admin.donasi.store',
        'edit' => 'admin.donasi.edit',
        'update' => 'admin.donasi.update',
        'destroy' => 'admin.donasi.destroy',
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
