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
        'payment_location_id',
        'payment_method_id',
        'payment_currency_id',
        'price_margin',
        'user_id',
        'terms',
        'headline'
    ];     

    public function user() {
        return $this->belongsTo(User::class);
    }     
    
    public function rooms() {
        return $this->hasMany(Room::class);
    }      
}
