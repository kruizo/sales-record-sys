<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
})->name('/');

Route::get('/order', function () {
    return view('order');
})->name('order');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('/home'); //->middleware('verified')


Route::get('/verified/setup', 'App\Http\Controllers\Auth\VerificationController@setupProfile')->name('verified.setup');


Route::middleware(['auth'])->group(function () {
    Route::GET('/verification', function () {
        return view('auth.verify');
    })->name('verification');

    Route::prefix('profile')->group(function () {
        // Route::get('/verification', function () {
        //     return view('auth.verify');
        // })->name('verification');

        Route::get('/', [App\Http\Controllers\ProfileController::class, 'showProfile'])->name('profile');
        Route::post('/verify', [App\Http\Controllers\ProfileController::class, 'verifyUser'])->name('profile.verify');

        Route::get('/myorders', [App\Http\Controllers\ProfileController::class, 'userOrders'])->name('profile/myorders');
    });
});


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
