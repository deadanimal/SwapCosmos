<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('symbol')->unique();
            $table->timestamps();
        });

        Schema::create('learns', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content');
            $table->timestamps();
        });    
        
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('trade_type');
            $table->bigInteger('min_payment');
            $table->bigInteger('max_payment');
            $table->unsignedBigInteger('coin_id');
            $table->bigInteger('coin_amount');
            $table->unsignedBigInteger('payment_location_id');
            $table->unsignedBigInteger('payment_method_id');
            $table->unsignedBigInteger('payment_currency_id');
            $table->bigInteger('price_margin');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });       
        
        Schema::create('payment_currencies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('symbol')->unique();
            $table->timestamps();
        });     
        
        Schema::create('payment_locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('symbol')->unique();
            $table->timestamps();
        });    
        
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('symbol')->unique();
            $table->timestamps();
        });      
        
        Schema::create('trades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('offer_id');
            $table->unsignedBigInteger('coin_id');
            $table->bigInteger('coin_amount');
            $table->unsignedBigInteger('trader_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });  
        
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('value');
            $table->timestamps();
        });   
        
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trade_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('mark');
            $table->timestamps();
        });    
        
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('offer_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });    
        
        Schema::create('room_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('user_id');
            $table->text('message');
            $table->timestamps();
        });         
               
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
