<?php

use App\Http\Controllers\Dashboard\AnimalController;
use App\Http\Controllers\Dashboard\SpeciesController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\EmployeeController;
use App\Http\Controllers\Dashboard\ExpenditureController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

Route::group([
    'middleware' => ['auth', 'last.active'],
    'prefix' => 'dashboard',
    'as' => 'dashboard.'],
    function () {
        Route::get('/', DashboardController::class)
            ->name('index');

        Route::resource('users', UserController::class)
            ->middleware(['type:ADMIN|USER'])
            ->except(['edit', 'create', 'show']);

        Route::resource('employees', EmployeeController::class)
            ->middleware('verify.employee')
            ->except(['edit', 'create']);

        Route::resource('species', SpeciesController::class)
            ->except(['edit', 'create']);

        Route::resource('expenditures', ExpenditureController::class);

        Route::resource('animals', AnimalController::class);
    });

Route::middleware(['auth', 'last.active'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
});
