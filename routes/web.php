<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('/');

Route::get('/order', function () {
    return view('order');
})->name('order');

Auth::routes(['verify' => true]);

Route::get('verification', function () {
    return view('auth.verify');
})->name('verification');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('/home'); //->middleware('verified')

Route::middleware(['auth'])->group(function () {


    Route::prefix('profile')->group(function () {
        Route::get('/', [App\Http\Controllers\ProfileController::class, 'showProfile'])->name('profile');
        Route::get('/orders', [App\Http\Controllers\ProfileController::class, 'userOrders'])->name('profile/orders');
    });
});
Route::group(['middleware' => 'web'], function () {
    Auth::routes();
});

Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {
    // Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('admin.dashboard');

    Route::resource('dashboard', App\Http\Controllers\DashboardController::class);
});
