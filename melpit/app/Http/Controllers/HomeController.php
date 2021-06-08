<?php

namespace App\Http\Controllers;
use App\Models\Information;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        /**
         * プロフィール画面
         */
        $auth = Auth::user();

        $id = Auth::id();
        //プロフィールに何にか入っていたら
        if(Information::whereId($id)->exists()){
        $informations = Information::whereId($id)->first();
        }
        //プロフィールが入力されていれば
        if(isset($informations)){
        $value = explode(",", $informations->language);
        return view('home', compact('auth','informations','value'));
        }
        return view('home', compact('auth'));
    }
}
