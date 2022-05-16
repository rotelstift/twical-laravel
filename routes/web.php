<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\TwitterLoginController;

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

Route::get('/', [CalendarController::class, 'show']);
Route::get('/{year}/{month}', [CalendarController::class, 'past']);

Route::get('/login', [LoginController::class, 'login']);
Route::get('/login/twitter', [TwitterLoginController::class, 'redirectToTwitter'])->name('login.twitter');
Route::get('/login/twitter/callback', [TwitterLoginController::class, 'handleTwitterCallback']);
