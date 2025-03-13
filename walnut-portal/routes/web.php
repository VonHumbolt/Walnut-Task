<?php

use App\Http\Controllers\CallbackController;
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
Route::post('/test-receiver', [TestController::class, 'test'])->name('test');
