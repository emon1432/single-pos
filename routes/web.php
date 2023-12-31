<?php

use App\Http\Controllers\Backend\Accounting\BankAccountController;
use App\Http\Controllers\Backend\Accounting\BankTransactionController;
use App\Http\Controllers\Backend\Accounting\ExpenseCategoryController;
use App\Http\Controllers\Backend\Accounting\IncomeSourceController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\PaymentMethodController;
use App\Http\Controllers\Backend\PosController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\PurchaseController;
use App\Http\Controllers\Backend\RolesPermissionController;
use App\Http\Controllers\Backend\SellController;
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

    // --------------------- POS ---------------------
    Route::controller(PosController::class)->group(function () {
        Route::get('/pos',  'index')->name('pos.index');
        Route::get('/pos/product/search',  'searchProduct')->name('pos.product_search');
        Route::post('/pos/checkout', 'checkout')->name('pos.checkout');
        Route::post('/sell/log', 'createSellLog')->name('pos.sell_log');
    });

    // --------------------- Sell ---------------------
    Route::controller(SellController::class)->group(function () {
        Route::get('/sell-list',  'index')->name('sell.list');
        Route::get('/sell-details/{id}/',  'sellDetails')->name('sell.details');
        Route::get('/sell-due/pay/{id}/', 'sellDuePay')->name('sell.due-pay');
        Route::get('/sell/log', 'sellLog')->name('sell.log-list');
    });

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

    // -------------------------------------> Accounting <-------------------------------------

    // --------------------> Bank Account <--------------------
    Route::get('/balance-sheet', [BankAccountController::class, 'balance_sheet'])->name('accounting.balance-sheet');
    Route::resource('bank-accounts', BankAccountController::class);


    // --------------------> Bank Transaction <--------------------
    Route::controller(BankTransactionController::class)->group(function () {
        // --------------------> Transaction <--------------------
        Route::get('/transaction-history', 'transactionHistory')->name('accounting.transaction-history');

        // --------------------> Deposit <--------------------
        Route::get('/deposit', 'deposit')->name('accounting.deposit-create');
        Route::post('/deposit', 'depositStore')->name('accounting.deposit-store');

        // --------------------> Withdraw <--------------------
        Route::get('/withdraw', 'withdraw')->name('accounting.withdraw-create');
        Route::post('/withdraw', 'withdrawStore')->name('accounting.withdraw-store');

        // --------------------> Bank Transfer <--------------------
        Route::get('/bank-transfer-list', 'bankTransferList')->name('accounting.bank-transfer-list');
        Route::get('/bank-transfer', 'bankTransfer')->name('accounting.bank-transfer-create');
        Route::post('/bank-transfer', 'bankTransferStore')->name('accounting.bank-transfer-store');
    });

    // --------------------> income-sources <--------------------
    Route::resource('/income-sources', IncomeSourceController::class);

    // --------------------> expense-categories <--------------------
    Route::resource('/expense-categories', ExpenseCategoryController::class);



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
