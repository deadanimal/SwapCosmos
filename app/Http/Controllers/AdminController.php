<?php

namespace App\Http\Controllers;
use App\Models\Offer;
use App\Models\Room;
use App\Models\RoomMessage;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(Request $request) {
        $user = $request->user();
        $sell_offers = Offer::where('seller_id', $user->id)->get();
        $buyer_offers = Offer::where('buyer_id', $user->id)->get();
        return view('admin.dashboard', compact(
            'sell_offers', 'buyer_offers'
        ));
    }

    public function ban_user(Request $request) {}

    public function penalise_user(Request $request) {}

    public function reply_message(Request $request) {}
}
