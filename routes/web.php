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

        Route::get('/myorders', [App\Http\Controllers\ProfileController::class, 'orders'])->name('profile/myorders');
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
    Route::get('home', [App\Http\Controllers\DataTablesController::class, 'index'])->name('admin.home');
    Route::get('/', [App\Http\Controllers\DataTablesController::class, 'show'])->name('admin');
    Route::resource('dashboard', App\Http\Controllers\DashboardController::class)->names('admin.dashboard');
    Route::resource('orders', App\Http\Controllers\OrderTableController::class)->names('admin.orders');
    Route::resource('customers', App\Http\Controllers\CustomerTableController::class)->names('admin.customers');
    Route::resource('delivery', App\Http\Controllers\DeliveryTableController::class)->names('admin.delivery');
    Route::resource('reports', App\Http\Controllers\ReportsController::class)->names('admin.reports');
    Route::resource('analytics', App\Http\Controllers\AnalyticsController::class)->names('admin.analytics');
});

Route::get('/view/map', function () {
    return view('modals/map');
})->name('modal.map');
Route::get('/view/map', function () {
    return view('map-view');
})->name('map.show');
