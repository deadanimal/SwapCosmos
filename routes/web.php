<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TradeController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;

Route::get('', [WebController::class, 'home']);

Route::get('user/{username}', [TradeController::class, 'user_profile']);

Route::get('offer/list', [TradeController::class, 'offer_list']);
Route::get('offer/search', [TradeController::class, 'offer_search']);
Route::get('offer/{uid}', [TradeController::class, 'offer_detail']);


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('dashboard', [TradeController::class, 'dashboard']);
    
    Route::get('offer/create', [TradeController::class, 'offer_create']);
    Route::post('offer', [TradeController::class, 'offer_store']);
    Route::post('offer/{uid}/message', [TradeController::class, 'offer_message']);
    Route::post('offer/{uid}/reply', [TradeController::class, 'offer_reply']);
    Route::post('offer/{uid}/feature', [TradeController::class, 'offer_feature']);
    Route::post('offer/{uid}/initiate', [TradeController::class, 'offer_initiate']);
    Route::post('trade/{uid}/escrow', [TradeController::class, 'trade_escrow']);
    Route::post('trade/{uid}/dispute', [TradeController::class, 'trade_dispute']);
    Route::post('trade/{uid}/release', [TradeController::class, 'trade_release']);
    Route::post('trade/{uid}/cancel', [TradeController::class, 'trade_cancel']);
    Route::post('trade/{uid}/rate', [TradeController::class, 'trade_rate']);    

    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('role:admin')->group(function () {

    Route::get('admin/dashboard', [AdminController::class, 'dashboard']);
    
    Route::post('trade/{uid}/resolve', [TradeController::class, 'trade_resolve']);
});



require __DIR__.'/auth.php';
