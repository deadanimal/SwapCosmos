<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TradeController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;


Route::get('', [WebController::class, 'home']);

Route::get('user/{username}', [TradeController::class, 'user_profile']);

Route::get('offers/list', [TradeController::class, 'offer_list']);
Route::get('offers/search', [TradeController::class, 'offer_search']);


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('dashboard', [TradeController::class, 'dashboard']);
    
    Route::get('offers/create', [TradeController::class, 'offer_create']);
    Route::post('offers', [TradeController::class, 'offer_store']);
    Route::post('offers/{uid}/message', [TradeController::class, 'offer_message']);
    Route::post('offers/{uid}/reply', [TradeController::class, 'offer_reply']);
    Route::post('offers/{uid}/feature', [TradeController::class, 'offer_feature']);
    Route::post('offers/{uid}/initiate', [TradeController::class, 'offer_initiate']);
    Route::post('trades/{uid}/escrow', [TradeController::class, 'trade_escrow']);
    Route::post('trades/{uid}/dispute', [TradeController::class, 'trade_dispute']);
    Route::post('trades/{uid}/release', [TradeController::class, 'trade_release']);
    Route::post('trades/{uid}/cancel', [TradeController::class, 'trade_cancel']);
    Route::post('trades/{uid}/rate', [TradeController::class, 'trade_rate']);    

    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('role:admin')->group(function () {

    Route::get('admin/dashboard', [AdminController::class, 'dashboard']);
    
    Route::post('trade/{uid}/resolve', [TradeController::class, 'trade_resolve']);
});



Route::get('offers/{uid}', [TradeController::class, 'offer_detail']);

require __DIR__.'/auth.php';
