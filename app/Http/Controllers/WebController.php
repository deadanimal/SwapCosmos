<?php

namespace App\Http\Controllers;
use App\Models\Learn;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function home() {
        return view('home');
    }

    public function faq() {
        return view('faq');
    }

    public function wallet() {
        return view('wallet');
    }

    public function calculator() {
        return view('calculator');
    }

    public function learn_list() {
        $learns = Learn::all();
        return view('web.learns', compact('learns'));
    }

    public function learn_add(Request $request) {
        Learn::create([
            'title'=> $request->title,
            'slug'=> $request->slug,
            'content'=> $request->content,
        ]);
        return back();
    }

    public function learn_detail(Request $request) {
        $slug = $request->route('slug');
        $learn = Learn::where('slug', $slug)->first();
        return view('web.learn', compact('learn'));
    }

    public function learn_edit(Request $request) {
        $slug = $request->route('slug');
        $learn = Learn::where('slug', $slug)->first();
        $learn->update([
            'title'=> $request->title,
            'slug'=> $request->slug,
            'content'=> $request->content,          
        ]);        
        return back();        
    }




    private function create_wallet() {}

}
