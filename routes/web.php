<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\ExpertController;
use App\Http\Controllers\FrontDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [FrontDashboardController::class, 'home'])->name('home');

Route::get('/dashboard', [FrontDashboardController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/specializations', [\App\Http\Controllers\UserController::class, 'getSpecializations'])->name('specializations');

Route::get('/experts', [\App\Http\Controllers\UserController::class, 'getExperts'])->name('experts.index');

Route::get('/job-seeker', [UserController::class, 'getJobSeeker'])->name('getJobSeeker.index'); // لعرض قائمة الخبراء

Route::get('/specialization', [UserController::class, 'filterBySpecialization'])->name('experts.bySpecialization');

Route::get('/profile/{user:slug}', [ExpertController::class, 'show'])->name('profile.show');

Route::get('/blog', [FrontDashboardController::class, 'blog'])->name('blog');

Route::get('/contact', [FrontDashboardController::class, 'contact'])->name('contact');



Route::middleware(['auth','verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::post('/users/{user}/expert-info', [ExpertController::class, 'store'])->name('expert-info.store');

    Route::put('/expert-info/{expertInfo}', [ExpertController::class, 'update'])->name('expert-info.update');

    Route::middleware(['is_admin'])->group(function () {

        Route::prefix('ads')->group(function () {
            Route::get('/', [AdController::class, 'index'])->name('ads.index');
            Route::get('/create', [AdController::class, 'create'])->name('ads.create');
            Route::post('/', [AdController::class, 'store'])->name('ads.store');
            Route::get('/{ad}/edit', [AdController::class, 'edit'])->name('ads.edit');
            Route::put('/{ad}', [AdController::class, 'update'])->name('ads.update');
            Route::delete('/{ad}', [AdController::class, 'destroy'])->name('ads.destroy');

        });
        Route::get('/ads/{ad}/go', [AdController::class, 'redirectToAd'])->name('ads.redirect');


// web.php
        Route::prefix('settings')->group(function () {
            Route::get('/', [SettingController::class, 'index'])->name('settings.index');
            Route::get('/create', [SettingController::class, 'create'])->name('settings.create'); // صفحة الإضافة
            Route::post('/', [SettingController::class, 'store'])->name('settings.store'); // حفظ الإعداد
            Route::get('/{key}/edit', [SettingController::class, 'edit'])->name('settings.edit');
            Route::put('/{key}', [SettingController::class, 'update'])->name('settings.update');
            Route::delete('/{key}', [SettingController::class, 'destroy'])->name('settings.destroy');
        });


        Route::get('/cache', [FrontDashboardController::class, 'cache'])->name('cache.forget');
        Route::get('/member/inactive-users', [UserController::class, 'inactiveUsers'])
            ->name('admin.inactive-users');

        Route::patch('/admin/users/{user}/toggle-activation', [UserController::class, 'toggleActivation'])
            ->name('admin.users.toggleActivation');

    });
});


require __DIR__.'/auth.php';
