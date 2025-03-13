<?php

use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\CallbackController;
use App\Http\Controllers\IncomingLogController;
use App\Http\Controllers\TestController;
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

Route::get('/callback', [CallbackController::class, 'callback'])->name('callback');
Route::get('/callbackLogs', [CallbackController::class, 'show'])->name('callback.show');
Route::post('/test-receiver', [TestController::class, 'test'])->name('test');

Route::get('/incomingLogs', [IncomingLogController::class, 'show'])->name('incomingLog.show');

Route::get('/', [AdminUsersController::class, 'show'])->name('adminUsers.show');