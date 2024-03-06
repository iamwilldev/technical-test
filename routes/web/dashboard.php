<?php

use App\Http\Controllers\BaseDashboardController;
use App\Http\Controllers\Dashboard\Booking\BookingController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\Driver\DriverController;
use App\Http\Controllers\Dashboard\Logs\ActivityController;
use App\Http\Controllers\Dashboard\Vehicle\VehicleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('dashboard')->middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/change-layout', [BaseDashboardController::class, 'changeLayout'])->name('change-layout');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // add user
    Route::get('/users', [ProfileController::class, 'index'])->name('users.index');
    Route::post('/users/add', [ProfileController::class, 'storeUser'])->name('users.store');

    Route::prefix('logs')->group(function () {
        Route::get('/activity', [ActivityController::class, 'index'])->name('dashboard.logs.activity.index');
    });

    Route::prefix('vehicle')->group(function () {
        Route::resource('vehicles', VehicleController::class)
            ->names('dashboard.vehicle.vehicles')->only(['index', 'store', 'update', 'destroy']);
    });

    Route::prefix('driver')->group(function () {
        Route::resource('drivers', DriverController::class)
            ->names('dashboard.driver.drivers')->only(['index', 'store', 'update', 'destroy']);
    });

    Route::prefix('booking')->group(function () {
        Route::resource('bookings', BookingController::class)
            ->names('dashboard.booking.bookings')->only(['index', 'store', 'update', 'destroy']);
    });
});
