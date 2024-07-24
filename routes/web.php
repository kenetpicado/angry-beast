<?php

use App\Http\Controllers\Dashboard\AnimalController;
use App\Http\Controllers\Dashboard\ConceptController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\EmployeeController;
use App\Http\Controllers\Dashboard\PhotoController;
use App\Http\Controllers\Dashboard\SpeciesController;
use App\Http\Controllers\Dashboard\TransactionController;
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
            ->except(['edit', 'create', 'show']);

        Route::resource('employees', EmployeeController::class)
            ->middleware('verify.employee')
            ->except(['edit', 'create']);

        Route::resource('species', SpeciesController::class)
            ->except(['edit', 'create']);

        Route::resource('transactions', TransactionController::class);

        Route::resource('animals', AnimalController::class);

        Route::resource('concepts', ConceptController::class);

        Route::resource('photo', PhotoController::class)
            ->only(['store', 'destroy'])
            ->parameter('photo', 'animal');
    });

Route::middleware(['auth', 'last.active'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
});
