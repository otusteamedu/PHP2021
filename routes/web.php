<?php

use App\Http\Controllers\EventAddController;
use App\Http\Controllers\EventClearController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventFindController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', EventController::class);
Route::get('/clear', EventClearController::class);
Route::post('/findEven', EventFindController::class);
Route::post('/addEven', EventAddController::class);

