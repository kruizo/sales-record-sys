<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ReportsController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('welcome');
})->name('/');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('/home'); //->middleware('verified')

Route::post('/save-profile', 'App\Http\Controllers\ProfileController@saveProfile')->name('save-profile');

//need reworks
Route::get('/verified/setup', 'App\Http\Controllers\Auth\VerificationController@setupProfile')->name('verified.setup');
Route::post('/place-order', [App\Http\Controllers\OrderController::class, 'placeOrder'])->name('place-order');
Route::post('/update-orders', [App\Http\Controllers\OrderController::class, 'updateOrArchiveOrders'])->name('update-orders');
Route::post('/update-orderline/{orderlineid}/{status}', [App\Http\Controllers\OrderController::class, 'updateOrderlineStatus'])->name('update-orderline');
Route::post('/remove-orderline/{orderlineid}', [App\Http\Controllers\OrderController::class, 'removeOrderline'])->name('remove-orderline');
Route::get('/receipt/{id}', [OrderController::class, 'showReceipt'])->name('receipt.show');
Route::get('/orders', [OrderController::class, 'index']);



//report
Route::get('/admin/report', [App\Http\Controllers\ReportsController::class, 'index'])->name('admin.reports');

// Route::get('/admin/report/{id}', [ReportsController::class, 'show'])->name('admin.report.show');

Route::get('/admin/orders', [ReportsController::class, 'order'])->name('admin.report.order');



//profile
Route::middleware(['auth'])->group(function () {
    Route::GET('/verification', function () {
        return view('auth.verify');
    })->name('verification');

    Route::get('/order', [App\Http\Controllers\OrderController::class, 'index'])->name('order')->middleware('verified');
    Route::prefix('profile')->group(function () {
        Route::get('/', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
        Route::post('/verify', [App\Http\Controllers\ProfileController::class, 'verifyUser'])->name('profile.verify');

        Route::get('/myorders', [App\Http\Controllers\ProfileController::class, 'orders'])->name('profile/myorders')->middleware('verified');
        Route::get('/cancel/order/{id}', [App\Http\Controllers\OrderController::class, 'cancelOrder'])->name('cancel.order');
    });
});


Route::group(['middleware' => 'web'], function () {
    Auth::routes(['verify' => true]);
});


//should be api.php
Route::POST('/profile-registration', [App\Http\Controllers\Auth\RegisterController::class, 'profileRegistration'])->name('profile.registration');

//admin
Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'show'])->name('admin');
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'show'])->name('admin.dashboard');
    Route::get('/orders', [App\Http\Controllers\OrderTableController::class, 'show'])->name('admin.orders');
    Route::get('/customers', [App\Http\Controllers\CustomerTableController::class, 'show'])->name('admin.customers');
    Route::get('/delivery', [App\Http\Controllers\DeliveryTableController::class, 'show'])->name('admin.delivery');
    Route::get('/report', [App\Http\Controllers\ReportsController::class, 'index'])->name('admin.reports');
    Route::get('/analytics', [App\Http\Controllers\AnalyticsController::class, 'show'])->name('admin.analytics');
});

//map
Route::get('/view/map', function () {
    return view('modals/map');
})->name('modal.map');
Route::get('/view/map', function () {
    return view('map-view');
})->name('map.show');
