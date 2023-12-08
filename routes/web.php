<?php

use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\PaymentMethodController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\PurchaseController;
use App\Http\Controllers\Backend\RolesPermissionController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\UnitController;
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

    // --------------------> customers <--------------------
    Route::resource('customers', CustomerController::class)->except(['show', 'edit', 'create']);

    // --------------------> suppliers <--------------------
    Route::resource('suppliers', SupplierController::class)->except(['show', 'edit', 'create']);

    // --------------------> units <--------------------
    Route::resource('units', UnitController::class)->except(['show', 'edit', 'create']);

    // --------------------> categories <--------------------
    Route::resource('categories', CategoryController::class)->except(['show', 'edit', 'create']);

    // --------------------> brands <--------------------
    Route::resource('brands', BrandController::class)->except(['show', 'edit', 'create']);

    // --------------------> products <--------------------
    Route::resource('products', ProductController::class);


    // --------------------> users <--------------------
    Route::resource('users', UserController::class);

    // --------------------> Payment Method <--------------------
    Route::resource('payment-methods', PaymentMethodController::class);

    // --------------------> Purchase <--------------------
    Route::controller(PurchaseController::class)->group(function () {
        Route::get('/purchase/log',  'purchaseLog')->name('purchase.log-list');
        Route::post('/purchase/log',  'createPurchaseLog');
        Route::get('/purchase/pay/{id}', 'purchasePay')->name('purchase.pay');
    });
    Route::resource('purchase', PurchaseController::class);


    // --------------------> roles & permission <--------------------
    Route::controller(RolesPermissionController::class)->group(function () {
        Route::get('roles-permission', 'index')->name('roles-permission.index');
        Route::get('roles-permission/create', 'create')->name('roles-permission.create');
        Route::post('roles-permission', 'store')->name('roles-permission.store');
        Route::get('roles-permission/{id}/edit', 'edit')->name('roles-permission.edit');
        Route::post('roles-permission/{id}', 'update')->name('roles-permission.update');
    });

    // --------------------> others <--------------------
    Route::controller(OthersController::class)->group(function () {
        Route::get('/status-update', 'statusUpdate')->name('status.update');
        Route::get('/get/product-by-supplier/{supplier_id}', 'getProductBySupplier')->name('get.productBySupplier');
    });
});
