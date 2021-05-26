<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MessageRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\Information;
use App\Models\DirectMessage;

class TalkController extends Controller
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

    public function talk(Request $request)
    {
        /**
         * 
         * トークルーム選択
         */

        $auth = Auth::user();
        $language = $request->language;
	$language = str_replace('https://laravel-chat2-bucket.s3-ap-northeast-1.amazonaws.com/', '', $language); //追加
        //各トーク画面に関係あるメッセージを取得
        $userMessages = Message::where('language', $language)->paginate(10);

        //トークしているユーザーのIDとアイコンを取得
        $users = Information::select('user_id', 'image')->get();
        if (!isset($language)) {
            return redirect('selection');
        }

        return view('talkList.talk', compact('language', 'userMessages', 'auth', 'users'));
    }

    public function message(MessageRequest $request)
    {

        /**
         * 
         * メッセージ追加
         */


        $auth = Auth::user();
        $message = $request->input('Msg');
	$language = $request->language;
	$language = str_replace('https://laravel-chat2-bucket.s3-ap-northeast-1.amazonaws.com/', '', $language); //追加
	$nickName = Information::where('user_id', $auth->id)->value('nickName');

        $userMessage = new Message;
        $userMessage->fill($request->all());
        $userMessage->user_name = $nickName;
        $userMessage->message = $message;
        $userMessage->save();

        //二重送信防止トークン
        $request->session()->regenerateToken();

        //各トーク画面に関係あるメッセージを取得
        $userMessages = Message::where('language', $language)->paginate(10);

        //トークしているユーザーのIDとアイコンを取得
        $users = Information::select('user_id', 'image')->get();

        return view('talkList.talk', compact('language', 'userMessages', 'auth', 'users'));
    }


    public function search(Request $request)
    {
        /**
         * 検索画面
         */
        $auth = Auth::user();
        $key1 = $request->input('key1');
        $key2 = $request->input('key2');
        //トークしているユーザーのIDとアイコンを取得
        $users = Information::select('user_id', 'image', 'nickName')->get();

        //検索結果で何か（keyが）送られてきたら
        if (isset($key1)) {

            $results = Message::where('language', $request->language)->where('message', 'like', '%' . $key1 . '%')->get();
            return view('talkList.search', compact('results', 'key1', 'key2', 'auth', 'users'));
        } elseif (isset($key2)) {
            $user_id = $request->directId;
            //ログイン中のuserの対象のDMを取得
            $rightMessage = DirectMessage::where('user_id', $auth->id)->where('destination', $user_id)->where('message', 'like', '%' . $key2 . '%')->get();
            $leftMessage = DirectMessage::where('destination', $auth->id)->where('user_id', $user_id)->where('message', 'like', '%' . $key2 . '%')->get();
            return view('talkList.search', compact('key1', 'key2', 'auth', 'users', 'rightMessage', 'leftMessage'));
        } else {
            return redirect('selection');
        }
       
    }
}
