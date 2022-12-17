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
    
    public function offer() {
        return $this->belongsTo(Offer::class);
    }   
    
    public function trader() {
        return $this->belongsTo(User::class, 'trader_id');
    }  
    
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }      
  
}
