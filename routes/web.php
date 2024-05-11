<?php

use App\Http\Controllers\Dashboard\ClientController;
use App\Http\Controllers\Dashboard\CompanyController;
use App\Http\Controllers\Dashboard\DashboardController;
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

        Route::resource('companies', CompanyController::class)
            ->only(['index', 'update', 'store']);

        Route::resource('clients', ClientController::class)
            ->except(['edit', 'create', 'show']);

        Route::resource('users', UserController::class)
            ->except(['edit', 'create', 'show']);
    });

Route::middleware(['auth', 'last.active'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
});
