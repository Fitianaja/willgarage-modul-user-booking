<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerBookingController;
use App\Http\Controllers\CustomerVehicleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StaffBookingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::view('/about', 'about')->name('about');

    Route::middleware('role:customer')->prefix('customer')->name('customer.')->group(function () {
        Route::get('/vehicles', [CustomerVehicleController::class, 'index'])->name('vehicles.index');
        Route::post('/vehicles', [CustomerVehicleController::class, 'store'])->name('vehicles.store');

        Route::get('/bookings', [CustomerBookingController::class, 'index'])->name('bookings.index');
        Route::post('/bookings', [CustomerBookingController::class, 'store'])->name('bookings.store');
        Route::patch('/bookings/{booking}/cancel', [CustomerBookingController::class, 'cancel'])->name('bookings.cancel');
    });

    Route::middleware('role:admin,service_advisor')->prefix('staff')->name('staff.')->group(function () {
        Route::get('/bookings', [StaffBookingController::class, 'index'])->name('bookings.index');
        Route::patch('/bookings/{booking}', [StaffBookingController::class, 'update'])->name('bookings.update');
    });

    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');
        Route::patch('/users/{user}/role', [AdminUserController::class, 'updateRole'])->name('users.update-role');
    });
});
