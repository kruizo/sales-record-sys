<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
})->name('/');




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('/home'); //->middleware('verified')

Route::post('/save-profile', 'App\Http\Controllers\ProfileController@saveProfile')->name('save-profile');


Route::get('/verified/setup', 'App\Http\Controllers\Auth\VerificationController@setupProfile')->name('verified.setup');
Route::post('/place-order', [App\Http\Controllers\OrderController::class, 'placeOrder'])->name('place-order');
Route::post('/mark-order/{id}/{status}', [App\Http\Controllers\OrderController::class, 'updateOrderStatus'])->name('mark-order');
Route::post('/update-orders', [App\Http\Controllers\OrderController::class, 'updateOrArchiveOrders'])->name('update-orders');
Route::post('/set-archive', [App\Http\Controllers\OrderController::class, 'updateOrderArchiveStatus'])->name('set-archive');


//Route::post('/initiate-registration', [App\Http\Controllers\Auth\RegisterController::class, 'initiateRegistration'])->name('initiate.registration');


Route::middleware(['auth'])->group(function () {
    Route::GET('/verification', function () {
        return view('auth.verify');
    })->name('verification');
    Route::get('/order', [App\Http\Controllers\OrderController::class, 'index'])->name('order')->middleware('verified');

    Route::prefix('profile')->group(function () {
        // Route::get('/verification', function () {
        //     return view('auth.verify');
        // })->name('verification');

        Route::get('/', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
        Route::post('/verify', [App\Http\Controllers\ProfileController::class, 'verifyUser'])->name('profile.verify');

        Route::get('/myorders', [App\Http\Controllers\ProfileController::class, 'orders'])->name('profile/myorders')->middleware('verified');
        Route::get('/cancel/order/{id}', [App\Http\Controllers\OrderController::class, 'cancelOrder'])->name('cancel.order');
    });
});

// Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')
//     ->name('verification.verify');

Route::group(['middleware' => 'web'], function () {
    Auth::routes(['verify' => true]);
});


Route::POST('/profile-registration', [App\Http\Controllers\Auth\RegisterController::class, 'profileRegistration'])->name('profile.registration');

Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'show'])->name('admin');
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'show'])->name('admin.dashboard');
    Route::get('/orders', [App\Http\Controllers\OrderTableController::class, 'show'])->name('admin.orders');
    Route::get('/customers', [App\Http\Controllers\CustomerTableController::class, 'show'])->name('admin.customers');
    Route::get('/delivery', [App\Http\Controllers\DeliveryTableController::class, 'show'])->name('admin.delivery');
    Route::get('/report', [App\Http\Controllers\ReportsController::class, 'show'])->name('admin.reports');
    Route::get('/analytics', [App\Http\Controllers\AnalyticsController::class, 'show'])->name('admin.analytics');
});

Route::get('/view/map', function () {
    return view('modals/map');
})->name('modal.map');
Route::get('/view/map', function () {
    return view('map-view');
})->name('map.show');
