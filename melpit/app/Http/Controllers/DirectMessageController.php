<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\DirectMessage;
use App\Models\Information;

class DirectMessageController extends Controller
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


    public function room(Request $request)
    {

        /**
         * 
         * DM画面表示
         */

        $user_id = $request->directId; //imgを押された時にそのuserのidを持ってくる
        //対象のuserを選択
        $dmUser = Information::whereUser($user_id)->first();
        $auth = Auth::user();
        //ログイン中のuserのプロフ情報を取得
        $login = Information::whereUser($auth->id)->first();

        //ログイン中のuserの対象のDMを取得
        $messages = DirectMessage::whereAuth($auth->id)->whereUser($user_id)
            ->orwhere(function ($query) use ($user_id, $auth) {
                $query->whereAuth($user_id)->whereUser($auth->id);
            })
            ->paginate(10);
        return view('talkList.privateRoom', compact('dmUser', 'login', 'user_id', 'auth', 'messages'));
    }

    public function message(Request $request)
    {
        /**
         * 
         * メッセージ送信処理
         */
        
        $auth = Auth::user();

        $user_id = $request->directId;
        //対象のuserを選択
        $dmUser = Information::whereUser($user_id)->first();

        //ログイン中のuserのプロフ情報を取得
        $login = Information::whereUser($auth->id)->first();

        //DMが送られた時の処理
        if ($request->has('Msg')) {
            $directMessage = new DirectMessage;
            $directMessage->user_id = $auth->id;
            $directMessage->destination = $user_id;
            $directMessage->message = $request->input('Msg');
            $directMessage->save();
        }
        //二重送信防止トークン
        $request->session()->regenerateToken();

        //ログイン中のuserの対象のDMを取得
        $messages = DirectMessage::whereAuth($auth->id)->whereUser($user_id)
            ->orwhere(function ($query) use ($user_id, $auth) {
                $query->whereAuth($user_id)->whereUser($auth->id);
            })
            ->paginate(10);

        return view('talkList.privateRoom', compact('dmUser', 'login', 'user_id', 'auth', 'messages'));
    }
}
