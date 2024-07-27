<?php

use App\Http\Controllers\Dashboard\AnimalController;
use App\Http\Controllers\Dashboard\ConceptController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\EmployeeController;
use App\Http\Controllers\Dashboard\EventController;
use App\Http\Controllers\Dashboard\EventTypeController;
use App\Http\Controllers\Dashboard\PhotoController;
use App\Http\Controllers\Dashboard\ReminderController;
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
            ->middleware('type:ADMIN')
            ->except(['edit', 'create', 'show']);

        Route::resource('employees', EmployeeController::class)
            ->middleware('verify.employee')
            ->except(['edit', 'create']);

        Route::resource('species', SpeciesController::class)
            ->middleware('verify.specie')
            ->except(['edit', 'create', 'show']);

        Route::resource('transactions', TransactionController::class)
            ->middleware('verify.transaction')
            ->except(['edit', 'create', 'show']);

        Route::resource('animals', AnimalController::class)
            ->middleware('verify.animal')
            ->except(['edit', 'create']);

        Route::resource('concepts', ConceptController::class)
            ->middleware('verify.concept')
            ->except(['edit', 'create']);

        Route::resource('event-types', EventTypeController::class)
            ->middleware('verify.event.type')
            ->except(['edit', 'create']);

        Route::resource('events', EventController::class)
            ->middleware('verify.event')
            ->except(['edit', 'create', 'show']);

        Route::resource('reminders', ReminderController::class)
            ->middleware('verify.reminder')
            ->only(['index', 'destroy']);

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
