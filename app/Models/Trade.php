<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    use HasFactory;

    protected $fillable = [
        'offer_id',
        'coin_id',
        'coin_amount',
        'trader_id',
        'user_id',
    ];        
  
}
