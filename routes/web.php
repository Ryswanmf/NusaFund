<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\CampaignController::class, 'publicHome'])->name('home');

Route::get('/donasi', [\App\Http\Controllers\CampaignController::class, 'publicIndex'])->name('donasi.index');
Route::get('/donasi/{slug}', [\App\Http\Controllers\CampaignController::class, 'publicShow'])->name('donasi.show');

Route::get('/event', [\App\Http\Controllers\EventController::class, 'publicIndex'])->name('event.index');
Route::get('/event/{slug}', [\App\Http\Controllers\EventController::class, 'publicShow'])->name('event.show');

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

    Route::resource('admin/event', \App\Http\Controllers\EventController::class)->names([
        'index' => 'admin.event.index',
        'create' => 'admin.event.create',
        'store' => 'admin.event.store',
        'edit' => 'admin.event.edit',
        'update' => 'admin.event.update',
        'destroy' => 'admin.event.destroy',
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
