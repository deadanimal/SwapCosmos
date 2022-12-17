<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'offer_id',
        'customer_id',
        'user_id',
    ];    

    public function messages() {
        return $this->hasMany(RoomMessage::class);
    }         
}
