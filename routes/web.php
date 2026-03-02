<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HeroBannerController;
use App\Http\Controllers\FundraisingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\ZakatController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [CampaignController::class, 'publicHome'])->name('home');

// Donasi
Route::controller(CampaignController::class)->group(function () {
    Route::get('/donasi', 'publicIndex')->name('donasi.index');
    Route::get('/donasi/{slug}', 'publicShow')->name('donasi.show');
});

// Event
Route::controller(EventController::class)->group(function () {
    Route::get('/event', 'publicIndex')->name('event.index');
    Route::get('/event/{slug}', 'publicShow')->name('event.show');
});

// Zakat
Route::get('/zakat', [ZakatController::class, 'publicIndex'])->name('zakat.index');

// Galang Dana
Route::controller(FundraisingController::class)->prefix('galang-dana')->name('fundraising.')->group(function () {
    Route::get('/', 'publicIndex')->name('index');
    Route::get('/panduan', 'publicGuide')->name('guide');
    Route::get('/buat', 'publicCreate')->name('create');
    Route::post('/buat', 'publicStore')->name('store');
    Route::get('/{slug}', 'publicShow')->name('show');
});

// Bantuan & Tentang Kami
Route::get('/pusat-bantuan', [SupportController::class, 'publicIndex'])->name('support.index');
Route::get('/syarat-ketentuan', [App\Http\Controllers\TermController::class, 'publicIndex'])->name('terms.index');
Route::get('/kebijakan-privasi', [App\Http\Controllers\PrivacyPolicyController::class, 'publicIndex'])->name('privacy.index');
Route::get('/tentang-kami', [AboutController::class, 'publicIndex'])->name('about');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // CRUD Resources
    Route::resource('donasi', CampaignController::class);
    Route::resource('event', EventController::class);
    Route::resource('zakat', ZakatController::class);
    Route::resource('testimoni', TestimonialController::class);
    Route::resource('donatur', \App\Http\Controllers\UserController::class)->parameters(['donatur' => 'donatur']);
    Route::resource('kategori', CategoryController::class)->parameters(['kategori' => 'category']);
    Route::resource('bantuan', SupportController::class)->parameters(['bantuan' => 'dukungan']);
    Route::resource('syarat-ketentuan', \App\Http\Controllers\TermController::class);
    Route::resource('kebijakan-privasi', \App\Http\Controllers\PrivacyPolicyController::class);

    // Custom Admin Routes
    Route::controller(HeroBannerController::class)->prefix('hero')->name('hero.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::put('/', 'update')->name('update');
    });

    Route::controller(FundraisingController::class)->prefix('galang-dana')->name('galang_dana.')->group(function () {
        Route::get('/', 'adminIndex')->name('index');
        Route::get('/{fundraising}/edit', 'edit')->name('edit');
        Route::put('/{fundraising}', 'update')->name('update');
        Route::delete('/{fundraising}', 'destroy')->name('destroy');
    });

    Route::controller(AboutController::class)->prefix('tentang-kami')->name('about.')->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::put('/', 'update')->name('update');
    });

    Route::controller(\App\Http\Controllers\SettingController::class)->prefix('pengaturan')->name('settings.')->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::put('/', 'update')->name('update');
    });
});

/*
|--------------------------------------------------------------------------
| User Profile Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
