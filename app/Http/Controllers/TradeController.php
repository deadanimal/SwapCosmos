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
use Illuminate\Support\Str;
use \FurqanSiddiqui\BIP39\BIP39;

use DataTables;
use DateTime;
use DateTimeZone;
use Carbon\Carbon;

class TradeController extends Controller
{

    public function dashboard(Request $request) {
        
        $user = $request->user();
        
        if(is_null($user->key)) {
            $this->generate_seed($user);
        }      
        
        $offers = Offer::where('user_id', $user->id)->get();
        $trades = Trade::where('trader_id', $user->id)->get();

        return view('web.dashboard', compact(
            'offers', 'trades', 'user'
        ));
    }

    public function user_profile(Request $request) {
        $uid = $request->route('uid');
        $user = User::where('uid', $uid)->first();
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
            'price_margin' => $request->price_margin,

            'terms' => $request->terms,
            'headline' => $request->headline,
            
            'coin_id' => 1,            
            'payment_location_id' => 1,
            'payment_method_id' => 1,
            'payment_currency_id' => 1,

            'user_id' => $user->id
        ]);   
        
        $uid = Str::random(32);
        while(Offer::where('uid', $uid)->exists()) {
            $uid = Str::random(32);
        }
        $offer->uid = $uid;        
        $offer->save();

        return back();
    }

    public function offer_list(Request $request) {
        $trade = $request->query('trade', null);
        
        $offers = Offer::where([
            ['active','=', true],
        ])->get();

        if($request->ajax()) {

            $filter = $request->query('filter', null);
            if($filter == 'buy') {
                $offers = Offer::where([
                    ['active','=', true],
                    ['trade_type','=', 'buy'],
                ])->get();
            } else {
                $offers = Offer::where([
                    ['active','=', true],
                    ['trade_type','=', 'sell'],
                ])->get();
            }
            
            
            return DataTables::collection($offers)
            ->addIndexColumn()
            ->addColumn('method', function (Offer $offer) {
                $html_statement = number_format(10 * pow(10, 6), 2, '.', '');
                return $html_statement;
            })    
            ->addColumn('location', function (Offer $offer) {
                $html_statement = number_format(10 * pow(10, 6), 2, '.', '');
                return $html_statement;
            })                       
            ->addColumn('price', function (Offer $offer) {
                $html_statement = number_format(10 * pow(10, 6), 2, '.', '');
                return $html_statement;
            })   
            ->addColumn('limit', function (Offer $offer) {
                $html_statement = number_format(10 * pow(10, 6), 2, '.', '');
                return $html_statement;
            })               
            ->addColumn('action', function (Offer $offer) {
                $html_statement = '<a href="/offers/'.$offer->uid.'" class="btn btn-sm btn-primary">View Offer</a>';
                return $html_statement;
            })                 
            ->addColumn('user.name', function (Offer $offer) {
                $html_statement = '<a href="/users/'.$offer->user->uid.'">'.$offer->user->name.'</a>';
                return $html_statement;
            })                                    
            ->editColumn('created_at', function (Offer $offer) {
                return [
                    'display' => ($offer->created_at && $offer->created_at != '0000-00-00 00:00:00') ? with(new Carbon($offer->created_at))->format('j F Y h:m:s') : '',
                    'timestamp' => ($offer->created_at && $offer->created_at != '0000-00-00 00:00:00') ? with(new Carbon($offer->created_at))->timestamp : ''
                ];
            })
            ->rawColumns(['method', 'location', 'price', 'limit', 'action', 'user.name'])
            ->make(true);              
        }


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
        $user = $request->user();
        $uid = $request->route('uid');
        $offer = Offer::where('uid', $uid)->first();

        if ($user->id == $offer->user_id) {
            $room = Room::where([
                ['offer_id', '=', $offer->id],
                ['user_id', '=', $user->id],
            ])->first();
        } else {
            $room = Room::where([
                ['offer_id', '=', $offer->id],
                ['customer_id', '=', $user->id],
            ])->first();            
        }

        
        if($room == null) {
            $room_exist = true;
        } else {
            $room_exist = false;
        }

        return view('offer.detail', compact([
            'offer', 'user', 'room_exist'
        ]));
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

        $room_uid = Str::random(32);
        while(Offer::where('uid', $room_uid)->exists()) {
            $room_uid = Str::random(32);
        }
        $room->uid = $room_uid;        
        $room->save(); 

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

        $trade = Trade::create([
            'offer_id' => $offer->id,
            'coin' => $offer->coin,
            'coin_amount' => $offer->coin_amount,
            'trader_id' => $offer->user_id,
            'user_id' => $user->id,
        ]);

        $trade_uid = Str::random(32);
        while(Trade::where('uid', $trade_uid)->exists()) {
            $trade_uid = Str::random(32);
        }
        $trade->uid = $trade_uid;        
        $trade->save();        

        return back();
    }   
    
    public function trade_detail(Request $request) {
        $user = $request->user();
        $uid = $request->route('uid');
        $trade = Trade::where('uid', $uid)->first();
        return view('trade.detail', compact('trade', 'user'));
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

    private function generate_seed($user) {        
        $mnemonic = BIP39::Generate(12);
        $key = implode(" ", $mnemonic->words);  
        $password = (string)($user->id).(string)($user->created_at).(string)env('APP_KEY');
        $encrypted_key = openssl_encrypt($key, "AES-128-ECB", $password);
        $user->key = $encrypted_key;
        $user->save();
    }

    private function show_key($user) {
        $password = (string)($user->id).(string)($user->created_at).(string)env('APP_KEY');
        $decrypted_string = openssl_decrypt($user->key,"AES-128-ECB",$password);        
        return $decrypted_string;
    }
}
