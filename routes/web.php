<?php

use App\Http\Controllers\Backend\RolesPermissionController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\OthersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'permission'])->group(function () {
    Route::get('/dashboard', function () {
        return view('backend.pages.dashboard.index');
    })->name('dashboard');

    // --------------------> users <--------------------
    Route::resource('users', UserController::class);


    // --------------------> roles & permission <--------------------
    Route::controller(RolesPermissionController::class)->group(function () {
        Route::get('roles-permission', 'index')->name('roles-permission.index');
        Route::get('roles-permission/create', 'create')->name('roles-permission.create');
        Route::post('roles-permission', 'store')->name('roles-permission.store');
        Route::get('roles-permission/{id}/edit', 'edit')->name('roles-permission.edit');
        Route::post('roles-permission/{id}', 'update')->name('roles-permission.update');
    });

    // --------------------> others <--------------------
    Route::get('/status-update', [OthersController::class, 'statusUpdate'])->name('status.update');
});
