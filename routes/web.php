<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CampaignUpdateController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HeroBannerController;
use App\Http\Controllers\FundraisingController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\ZakatController;
use App\Http\Controllers\ChatBotController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CampaignController::class, 'publicHome'])->name('home');

Route::controller(CampaignController::class)->group(function () {
    Route::get('/donasi', 'publicIndex')->name('donasi.index');
    Route::get('/donasi/{slug}', 'publicShow')->name('donasi.show');
});

Route::get('/donasi/{campaign:slug}/bayar', [DonationController::class, 'create'])->name('donasi.pay');
Route::post('/donasi/{campaign:slug}/bayar', [DonationController::class, 'store'])->name('donasi.submit');
Route::get('/donasi/berhasil/{donation:transaction_id}', [DonationController::class, 'success'])->name('donasi.success');
Route::get('/donasi/sertifikat/{transaction_id}', [UserDashboardController::class, 'certificate'])->name('donation.certificate');

Route::post('/midtrans/callback', [MidtransController::class, 'callback'])->name('midtrans.callback');

Route::controller(EventController::class)->group(function () {
    Route::get('/event', 'publicIndex')->name('event.index');
    Route::get('/event/{slug}', 'publicShow')->name('event.show');
});

Route::get('/event/{event:slug}/daftar', [\App\Http\Controllers\EventRegistrationController::class, 'create'])->name('event.register');
Route::post('/event/{event:slug}/daftar', [\App\Http\Controllers\EventRegistrationController::class, 'store'])->name('event.submit');
Route::get('/event/pendaftaran-berhasil/{registration_id}', [\App\Http\Controllers\EventRegistrationController::class, 'success'])->name('event.success');

Route::controller(ZakatController::class)->group(function () {
    Route::get('/zakat', 'publicIndex')->name('zakat.index');
    Route::get('/zakat/{slug}', 'publicShow')->name('zakat.show');
    Route::post('/zakat/{zakat:slug}/bayar', 'pay')->name('zakat.pay');
    Route::get('/zakat/berhasil/{transaction_id}', 'success')->name('zakat.success');
});

Route::get('/faq', [FaqController::class, 'publicIndex'])->name('faq.index');

Route::post('/chatbot/message', [ChatBotController::class, 'message'])->name('chatbot.message');

Route::controller(FundraisingController::class)->prefix('galang-dana')->name('fundraising.')->group(function () {
    Route::get('/', 'publicIndex')->name('index');
    Route::get('/panduan', 'publicGuide')->name('guide');
    Route::get('/buat', 'publicCreate')->name('create');
    Route::post('/buat', 'publicStore')->name('store');
    Route::get('/{slug}', 'publicShow')->name('show');
});

Route::get('/pusat-bantuan', [SupportController::class, 'publicIndex'])->name('support.index');
Route::get('/syarat-ketentuan', [App\Http\Controllers\TermController::class, 'publicIndex'])->name('terms.index');
Route::get('/kebijakan-privasi', [App\Http\Controllers\PrivacyPolicyController::class, 'publicIndex'])->name('privacy.index');
Route::get('/tentang-kami', [AboutController::class, 'publicIndex'])->name('about');

Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('donasi', CampaignController::class);
    Route::resource('event', EventController::class);
    Route::resource('zakat', ZakatController::class);
    Route::resource('testimoni', TestimonialController::class);
    Route::resource('faq', FaqController::class);
    Route::resource('updates', CampaignUpdateController::class);
    
    Route::get('/transaksi', [\App\Http\Controllers\Admin\DonationTransactionController::class, 'index'])->name('transactions.index');
    Route::post('/transaksi/{donation}/confirm', [\App\Http\Controllers\Admin\DonationTransactionController::class, 'confirm'])->name('transactions.confirm');
    Route::delete('/transaksi/{donation}', [\App\Http\Controllers\Admin\DonationTransactionController::class, 'destroy'])->name('transactions.destroy');

    Route::get('/zakat-masuk', [\App\Http\Controllers\Admin\ZakatTransactionController::class, 'index'])->name('zakat_transactions.index');
    Route::post('/zakat-masuk/{payment}/confirm', [\App\Http\Controllers\Admin\ZakatTransactionController::class, 'confirm'])->name('zakat_transactions.confirm');
    Route::delete('/zakat-masuk/{payment}', [\App\Http\Controllers\Admin\ZakatTransactionController::class, 'destroy'])->name('zakat_transactions.destroy');

    Route::get('/peserta-event', [\App\Http\Controllers\Admin\EventRegistrationController::class, 'index'])->name('event_registrations.index');
    Route::delete('/peserta-event/{registration}', [\App\Http\Controllers\Admin\EventRegistrationController::class, 'destroy'])->name('event_registrations.destroy');

    Route::resource('donatur', \App\Http\Controllers\UserController::class)->parameters(['donatur' => 'donatur']);
    Route::resource('kategori', CategoryController::class)->parameters(['kategori' => 'category']);
    Route::resource('bantuan', SupportController::class)->parameters(['bantuan' => 'dukungan']);
    Route::resource('syarat-ketentuan', \App\Http\Controllers\TermController::class);
    Route::resource('kebijakan-privasi', \App\Http\Controllers\PrivacyPolicyController::class);

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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/galang-dana', [UserDashboardController::class, 'fundraisings'])->name('dashboard.fundraising');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
