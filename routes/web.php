<?php

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('offers', [WebController::class, 'list']);
Route::get('offers/create', [WebController::class, 'create']);
Route::post('offers', [WebController::class, 'store']);
Route::get('offers/{uuid}', [WebController::class, 'detail']);
Route::put('offers/{uuid}', [WebController::class, 'update']);

Route::get('wallet', [WebController::class, 'home']);
Route::get('calculator', [WebController::class, 'home']);
Route::get('fees', [WebController::class, 'home']);
Route::get('list-token', [WebController::class, 'home']);
Route::get('privacy', [WebController::class, 'home']);
Route::get('terms', [WebController::class, 'home']);

Route::get('learn/{topic}', [WebController::class, 'home']);