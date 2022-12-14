<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'trade_type',
        'min_payment',
        'max_payment',
        'coin_id',
        'coin_amount',
        'payment_location_id',
        'payment_method_id',
        'payment_currency_id',
        'price_margin',
        'user_id',
    ];        
}
