<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\CampaignController::class, 'publicHome'])->name('home');

Route::get('/donasi', [\App\Http\Controllers\CampaignController::class, 'publicIndex'])->name('donasi.index');
Route::get('/donasi/{slug}', [\App\Http\Controllers\CampaignController::class, 'publicShow'])->name('donasi.show');

Route::get('/event', [\App\Http\Controllers\EventController::class, 'publicIndex'])->name('event.index');
Route::get('/event/{slug}', [\App\Http\Controllers\EventController::class, 'publicShow'])->name('event.show');

Route::get('/zakat', [\App\Http\Controllers\ZakatController::class, 'publicIndex'])->name('zakat.index');
Route::get('/galang-dana', [\App\Http\Controllers\FundraisingController::class, 'publicIndex'])->name('fundraising.index');

Route::get('/tentang-kami', [\App\Http\Controllers\AboutController::class, 'publicIndex'])->name('about');

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

    Route::resource('admin/zakat', \App\Http\Controllers\ZakatController::class)->names([
        'index' => 'admin.zakat.index',
        'create' => 'admin.zakat.create',
        'store' => 'admin.zakat.store',
        'edit' => 'admin.zakat.edit',
        'update' => 'admin.zakat.update',
        'destroy' => 'admin.zakat.destroy',
    ]);

    Route::get('admin/galang-dana', [\App\Http\Controllers\FundraisingController::class, 'adminIndex'])->name('admin.galang_dana.index');
    Route::get('admin/galang-dana/{fundraising}/edit', [\App\Http\Controllers\FundraisingController::class, 'edit'])->name('admin.galang_dana.edit');
    Route::put('admin/galang-dana/{fundraising}', [\App\Http\Controllers\FundraisingController::class, 'update'])->name('admin.galang_dana.update');
    Route::delete('admin/galang-dana/{fundraising}', [\App\Http\Controllers\FundraisingController::class, 'destroy'])->name('admin.galang_dana.destroy');

    Route::get('admin/tentang-kami', [\App\Http\Controllers\AboutController::class, 'edit'])->name('admin.about.edit');
    Route::put('admin/tentang-kami', [\App\Http\Controllers\AboutController::class, 'update'])->name('admin.about.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
