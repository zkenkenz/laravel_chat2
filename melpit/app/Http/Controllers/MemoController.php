<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MemoRequest;
use App\Models\Memo;
use App\Models\Information;
use App\Models\MemoImage;
use Storage;

class MemoController extends Controller
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

    public function index()
    {
        /**
         * 
         * メモ（投稿）画面
         */


        $auth = Auth::user();
        $memos = Memo::where('user_id', $auth->id)->orderBy('id', 'desc')->paginate(10);

        return view('home.memo', compact('auth', 'memos'));
    }

    public function add(MemoRequest $request)
    {
        /**
         * 
         * メモor投稿された時の処理
         */

        $memo = new Memo;
        $memo->fill($request->all());
        $memo->save();

        //メモの画像をS3に追加
        $memoImage = new MemoImage;
        $id = Memo::select('id')->orderBy('created_at', 'desc')->first();
        $memoImage->memo_id = $id['id'];

        if (isset($request->image)) {
            $image = $request->file('image');
            $path = Storage::disk('s3')->putFile('/', $image, 'public');
            $memoImage->image = Storage::disk('s3')->url($path);
        }else {
            $memoImage->image = 'NULL';
        }
        $memoImage->save();


        //二重送信防止トークン
        $request->session()->regenerateToken();


        return redirect('memo');
    }

    public function postList(Request $request)
    {

        /**
         * 掲示板の画面
         */

        //memoの中から投稿のチェックが付いているものを取得
        $list = Memo::where('serect', 1)->orderBy('id', 'desc')->paginate(10);

        //検索結果で何か（keyが）送られてきたら
        $key = $request->key;
        if (isset($key)) {
            $results = Memo::where('serect', 1)
                ->where(function ($query) use ($key) {
                    $query->where('title', 'like', '%' . $key . '%')->orwhere('content', 'like', '%' . $key . '%');
                })
                ->paginate(10);
            return view('home.postList', compact('results'));
        }
        return view('home.postList', compact('list'));
    }

    public function detail($id)
    {

        /**
         * メモ（投稿）の詳細画面
         */
        $auth = Auth::user();
        $userMemo = Memo::where('id', $id)->first();
        //ダイレクトに番号が打たれる時はリダイレクト

        if ($userMemo->user_id != $auth->id && $userMemo->serect == 2) {
            return redirect('memo');
        }
        //投稿者のニックネームを取得
        $nickName = Information::where('user_id', $userMemo->user_id)->select('nickName')->first();

        $detail = Memo::where('id', $id)->get();

        return view('home.detail', compact('detail', 'nickName', 'auth'));
    }

    public function delete(Request $request)
    {
        /**
         * 
         * メモ削除
         */
        Memo::where('id', $request->memoId)->delete();

        return redirect('memo');
    }

    public function edit(Request $request)
    {
        /**
         * 
         * メモ（投稿）編集画面
         */
        $auth = Auth::user();

        $memo = Memo::where('id', $request->memoId)->first();
        //ダイレクトに番号が打たれる時はリダイレクト
        if ($memo->user_id != $auth->id) {
            return redirect('memo');
        }

        return view('home.update', compact('memo'));
    }

    public function update(MemoRequest $request)
    {
        /**
         * 
         * メモ編集
         */

        //値アップデート
        $update = [
            'date' => $request->date,
            'title' => $request->title,
            'content' => $request->content,
            'serect' => $request->serect
        ];

        Memo::where('id', $request->memoId)->update($update);

        return redirect('memo');
    }
}
