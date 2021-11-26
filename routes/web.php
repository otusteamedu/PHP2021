<?php

use App\Http\Controllers\PatientController;
use App\Http\Controllers\PatientRowGateway;
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

Route::get('/getall', PatientController::class)->name('getall');
Route::get('/rowgateway', PatientRowGateway::class)->name('rowgateway');
