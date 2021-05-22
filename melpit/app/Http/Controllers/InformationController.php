<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\InformationRequest;
use App\Models\Information;
use Storage;

class InformationController extends Controller
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


    public function informations(InformationRequest $request)
    {

        /**
         * 
         * プロフィール入力画面
         */

        //プロフィール登録
        $id = Auth::id();
        $users = Information::where('user_id', $id)->first();

        //プロフィールの登録もしくはアップロード
        if(!isset($users)) {
            $information = new Information;
            $information->user_id = $id;
            $information->nickName = $request->nickName;
            $information->sex = $request->inlineRadioOptions;
            //アイコン登録時の条件分岐
            if(isset($request->image)) {
		    $image = $request->file('image');//S3に変更
		    $path = Storage::disk('s3')->putFile('/', $image, 'public');
		    $information->image = Storage::disk('s3')->url($path);
            }else{
                $information->image = "https://laravel-chat2-bucket.s3-ap-northeast-1.amazonaws.com/img.png";
            }
            //言語選択時の条件分岐
            if(isset($request['language'])) {
                $collection = collect($request['language']); //collectで一度配列で取得する
                $information->language = $collection->implode(','); //implodeで文字列連結して代入
            }else{
                $information->language = "https://laravel-chat2-bucket.s3-ap-northeast-1.amazonaws.com/html_css";
            }
            $information->introduction = $request->introduction;
            $information->save();
        }else{
            if(isset($request->nickName, $request->introduction)) {
		    if(isset($request->image)) {
			 $image = $request->file('image');//S3に変更
                   	 $path = Storage::disk('s3')->putFile('/', $image, 'public');
                   	 $updateImg = Storage::disk('s3')->url($path);
                } else {
                    $updateImg = $request->previousImg;
                }
                $update = [
                    'nickName' => $request->nickName,
                    'image' => $updateImg,
                    'sex' => $request->inlineRadioOptions,
                    'language' => collect($request['language'])->implode(','),
                    'introduction' => $request->introduction
                ];

                Information::where('user_id', $id)->update($update); //アップデート
            }
        }
        //ログイン者とプロフィールの結び付け
        $informations = Information::where('user_id', $id)->first();

        //二重送信防止トークン
        $request->session()->regenerateToken();
        $value = explode(",", $informations->language);
        return view('home.selection', compact('informations', 'value'));
    }

    public function selection()
    {
        /**
         * 
         * ログイン後トーク一覧表示
         * 
         */
        $id = Auth::id();
        $informations = Information::where('user_id', $id)->first();

        //ログイン後の画面と、getでそのまま呼ばれた時の条件わけ
        if (isset($informations)) {
            $value = explode(",", $informations->language);
            return view('home.selection', compact('informations', 'value'));
        } else {
            $auth = Auth::user();
            return view('home', compact('auth'));
        }
    }
}
