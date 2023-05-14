<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PingController;
use App\Http\Controllers\UserActivityLogController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'loginIn')->name('login.in');
    Route::get('/logout', 'logout')->name('logout')->middleware('auth');
});

Route::group(['middleware' => 'auth'], function () {
    
    Route::get('/', function () {
        return view('layouts.master');
    })->name('dashboard');
    
    Route::resource('users', UserController::class);
    
    Route::name('tasks.')->prefix('tasks')->group(function () {
        Route::resource('ping', PingController::class)
            ->except(['destroy', 'edit', 'update']);
    });
    
    Route::controller(UserController::class)->group(function () {
        Route::get('/my-account', 'account')->name('account');
        Route::put('/update/info', 'updateAccount')->name('update.info');
        Route::put('/update/password', 'updatePassword')->name('update.password');
    });
    
    Route::get('/activity-logs', UserActivityLogController::class)->name('user.activity.log');
    
    
});
