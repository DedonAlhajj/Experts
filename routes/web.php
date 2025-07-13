<?php

use App\Http\Controllers\ExpertController;
use App\Http\Controllers\FrontDashboardController;
use App\Http\Controllers\ProfileController;
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

Route::get('/specialization/{title}', [UserController::class, 'filterBySpecialization'])->name('experts.bySpecialization');

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
        Route::get('/member/inactive-users', [UserController::class, 'inactiveUsers'])
            ->name('admin.inactive-users');

        Route::patch('/admin/users/{user}/toggle-activation', [UserController::class, 'toggleActivation'])
            ->name('admin.users.toggleActivation');

    });
});


require __DIR__.'/auth.php';
