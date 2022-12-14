<?php

namespace App\Http\Controllers;
use App\Models\Offer;
use App\Models\Rating;
use App\Models\Room;
use App\Models\RoomMessage;
use App\Models\Setting;
use App\Models\Trade;
use App\Models\User;
use Illuminate\Http\Request;

class TradeController extends Controller
{

    public function dashboard(Request $request) {
        $user = $request->user();
        $offers = Offer::where('user_id', $user->id)->get();
        $trades = Trade::where('trader_id', $user->id)->get();
        return view('web.dashboard', compact(
            'offers', 'trades'
        ));
    }

    public function user_profile(Request $request) {
        $username = $request->route('username');
        $user = User::where('username', $username)->first();
        return view('web.profile', compact('user'));
    }

    public function offer_create() {
        return view('offer.create');
    }

    public function offer_store(Request $request) {
        $user = $request->user();
        $offer = Offer::create([
            'trade_type' => $request->trade_type,
            'min_payment' => $request->min_payment,
            'max_payment' => $request->max_payment,
            'coin' => $request->coin,
            'coin_amount' => $request->coin_amount,
            'payment_location' => $request->payment_location,
            'payment_method' => $request->payment_method,
            'payment_currency' => $request->payment_currency,
            'price_margin' => $request->price_margin,
            'user_id' => $user->id
        ]);   
        return back();
    }

    public function offer_list() {
        $offers = Offer::where('active', true)->get();
        return view('offer.list', compact('offers'));
    }

    public function offer_search(Request $request) {
        
        $trade = $request->query('trade', null);
        $coin = $request->query('coin', null);
        $method = $request->query('method', null);
        $location = $request->query('location', null);
        
        $offers = Offer::where()->get();

        return view('offer.list', compact('offers'));
    }

    public function offer_detail(Request $request) {
        $uid = $request->route('uid');
        $offer = Offer::where('uid', $uid)->first();
        return view('offer.detail', compact('offer'));
    }

    public function offer_message(Request $request) {
        $user = $request->user();
        $uid = $request->route('uid');
        $offer = Offer::where('uid', $uid)->first();
        $room = Room::create([
            'offer_id' => $offer->id,
            'customer_id' => $user->id,
            'user_id' => $offer->user_id
        ]);
        RoomMessage::create([
            'room_id' => $room->id,
            'user_id' => $user->id,
            'message' => $request->message
        ]);
        return back();        
    }

    public function offer_reply(Request $request) {
        $user = $request->user();
        $uid = $request->route('room_uid'); 
        $room = Room::where([
            ['id','=', $uid],
        ])->first();            
        RoomMessage::create([
            'room_id' => $room->id,
            'user_id' => $user->id,
            'message' => $request->message
        ]);
        return back();
    }

    public function offer_feature(Request $request) {
        // cut USD50 per month.... 86400 * 30
    }    

    public function offer_initiate(Request $request) {
        $user = $request->user();
        $uid = $request->route('uid');
        $offer = Offer::where('uid', $uid)->first();
        //$offer->taker_id = $request->taker_id;

        Trade::create([
            'offer_id' => $offer->id,
            'coin' => $offer->coin,
            'coin_amount' => $offer->coin_amount,
            'trader_id' => $offer->user_id,
            'user_id' => $user->id,
        ]);

        return back();
    }    

    public function trade_escrow(Request $request) {
        $user = $request->user();
        $uid = $request->route('uid');
        $trade = Trade::where([
            ['uid','=', $uid],
            ['trader_id','=', $user->id],
        ])->first();

        $coin = $trade->coin_id;
        $coin_amount = $trade->coin_amount;
        $fee_rate = Setting::where('name','fee_rate')->first();
        $transfer_amount = ($fee_rate / 10000) * $coin_amount;
        $trade->price = $request->price;

        $this->transfer_coin($coin, $transfer_amount, $user);

        $trade->escrowed = true;
        $trade->status = "escrowed";
        $trade->save();

        return back();
    }

    public function trade_dispute(Request $request) {
        $user = $request->user();
        $uid = $request->route('uid');

        $trade = Trade::where([
            ['uid','=', $uid],
            ['user_id','=', $user->id],
        ])->first();

        $trade->disputed = true;
        $trade->disputer_id = $user->id;
        $trade->status = "disputed";
        $trade->save();

        return back();
    }

    public function trade_release(Request $request) {
        $user = $request->user();
        $uid = $request->route('uid');

        $trade = Trade::where([
            ['uid','=', $uid],
            ['trader_id','=', $user->id],
        ])->first();

        $trade->released = true;
        $trade->status = "released";
        $trade->save();        

        $this->release_coin($trade->coin, $trade->coin_amount, $trade->user);

        return back();
    }

    public function trade_cancel(Request $request) {
        $user = $request->user();
        $uid = $request->route('uid');
        $trade = Trade::where([
            ['uid','=', $uid],
            ['trader_id','=', $user->id],
        ])->first();
        $trade->cancelled = true;
        $trade->canceller_id = $user->id;
        $trade->status = "cancelled";
        $trade->save();

        $this->refund_coin($trade->coin, $trade->coin_amount, $trade->user);

        return back();
    }    

    public function trade_resolve(Request $request) {
        $user = $request->user();
        $uid = $request->route('uid');
        $trade = Trade::where('uid', $uid)->first();
        $trade->resolved = true;
        $trade->resolver_id = $user->id;
        $trade->status = "resolved";
        $trade->save();

        return back();
    } 

    public function trade_rate(Request $request) {
        $user = $request->user();
        $uid = $request->route('uid');
        $trade = Trade::where([
            ['uid','=', $uid],
        ])->OrWhere()->OrWhere()->first();
        
        Rating::create([
            'trade_id' => $trade->id,
            'user_id' => $user->id,
            'mark' => $request->mark
        ]);

        $trade->save();

        return back();
    }    

    private function transfer_coin() {}

    private function release_coin() {}

    private function refund_coin() {}
}
