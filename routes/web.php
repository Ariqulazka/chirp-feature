<?php

use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminChirpController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Middleware\UpdateLastActive;

Route::get('/dashboard', [AdminDashboardController::class, 'index'])
    ->middleware(['auth', 'verified', UpdateLastActive::class])
    ->name('dashboard');

Route::post('/report/store', [ReportController::class, 'store'])->name('report.store');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/reports', [ReportController::class, 'index'])->name('admin.reports.index');
    Route::post('/reports/{report}/action', [ReportController::class, 'action'])->name('admin.reports.action');
    Route::post('admin/reports/{report}/action', [ReportController::class, 'action'])->name('admin.reports.action');
});

Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/chirps', [AdminChirpController::class, 'index'])->name('admin.chirps.index');
    Route::delete('/admin/chirps/{chirp}', [AdminChirpController::class, 'destroy'])->name('admin.chirps.destroy');
    Route::patch('/admin/chirps/{chirp}/review', [AdminChirpController::class, 'markForReview'])->name('admin.chirps.review');
    
});

Route::prefix('admin')->name('admin.')->middleware('auth', 'role:admin')->group(function() {
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::post('users/{id}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate');
    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/{user}/set-role', [UserController::class, 'setRole'])->name('users.setRole');
});


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'can:view dashboard'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('chirps', ChirpController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
