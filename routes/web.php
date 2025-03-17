<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderTableController;
use App\Http\Controllers\CustomerTableController;
use App\Http\Controllers\DeliveryTableController;
use App\Http\Controllers\AnalyticsController;


Route::get('/', function () {
    return view('welcome');
})->name('/');

//need reworks
Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('place-order');
Route::post('/update-orders', [OrderController::class, 'updateOrArchiveOrders'])->name('update-orders');
Route::post('/update-orderline/{orderlineid}/{status}', [OrderController::class, 'updateOrderlineStatus'])->name('update-orderline');
Route::post('/remove-orderline/{orderlineid}', [OrderController::class, 'removeOrderline'])->name('remove-orderline');
Route::get('/orders', [OrderController::class, 'index']);

//profile
Route::middleware(['auth'])->group(function () {
    Route::prefix('/verify')->group(function () {
        Route::get('/email', [VerificationController::class, 'show'])->name('verify.show');
        Route::post('/email', [VerificationController::class, 'verifyEmail'])->name('verify.email');
    });

    Route::prefix('customers')->middleware('verified', 'is_allowed')->group(function () {
        Route::post('/', [CustomerController::class, 'store'])->name('customer.store'); 
        Route::put('/{id}', [CustomerController::class, 'update'])->name('customer.update'); 
        Route::delete('/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy'); 
    });
    
    Route::prefix('/products')->middleware('verified')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('products.show'); 
    });

    Route::prefix('/orders')->middleware('verified', 'is_allowed')->group(function () {
        Route::post('/', [OrderController::class, 'create'])->name('order.create');
        Route::put('/{id}', [OrderController::class, 'update'])->name('order.update');
        Route::delete('/{id}', [OrderController::class, 'cancelOrder'])->name('order.destroy');
    });

    Route::get('/receipt/{id}', [OrderController::class, 'showReceipt'])->middleware('is_allowed')->name('receipt.show');

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('profile.show');
        Route::get('/edit/{id}', [CustomerController::class, 'update'])->name('customer.edit');
        Route::get('/setup', [ProfileController::class, 'setupProfile'])->name('profile.setup');
        Route::get('/myorders', [ProfileController::class, 'showOrders'])->name('profile.myorders');
    });
});

Route::group(['middleware' => 'web'], function () {
    Auth::routes(['verify' => true]);
});

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::prefix('/admin')->group(function () {
        Route::get('/report', [ReportsController::class, 'index'])->name('admin.reports');
        Route::get('/orders', [ReportsController::class, 'order'])->name('admin.report.order');
        Route::get('/', [DashboardController::class, 'show'])->name('admin');
        Route::get('/dashboard', [DashboardController::class, 'show'])->name('admin.dashboard');
        Route::get('/orders', [OrderTableController::class, 'show'])->name('admin.orders');
        Route::get('/customers', [CustomerTableController::class, 'show'])->name('admin.customers');
        Route::get('/delivery', [DeliveryTableController::class, 'show'])->name('admin.delivery');
        Route::get('/report', [ReportsController::class, 'index'])->name('admin.reports');
        Route::get('/analytics', [AnalyticsController::class, 'show'])->name('admin.analytics');
    });
});

//map
Route::get('/view/map', function () {
    return view('modals/map');
})->name('modal.map');
Route::get('/view/map', function () {
    return view('map-view');
})->name('map.show');
