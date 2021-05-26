<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
   return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home', 'HomeController@index')->name('home');

//プロフィール登録のpostルート
Route::post('selection', 'InformationController@informations');

//ログインされた時の処理
Route::get('selection', 'InformationController@selection');

//トークルームが呼ばれた時のpostのルート
Route::get('talk','TalkController@talk')->name('talkList.talk');
//メッセージが送信されたときのルート
Route::post('talk', 'TalkController@message');


//DM画面へのルート
Route::get('privateRoom', 'DirectMessageController@room');
//DMが送られた時
Route::post('privateRoom', 'DirectMessageController@message');


//検索が行われた時のルート
Route::get('search', 'TalkController@search');


//メモ画面へのルート
Route::get('memo', 'MemoController@index');


//メモ投稿時のルート
Route::post('add','MemoController@add');
Route::get('add', function () {
   return redirect('memo');
});

//掲示板へのルート
Route::get('postList','MemoController@postList');

//メモ削除ボタンのルート
Route::post('delete','MemoController@delete');
Route::get('delete', function () {
   return redirect('memo');
});
//メモ編集ボタンのルート
Route::get('edit','MemoController@edit');
/*Route::get('update', function () {
   return redirect('memo');
});*/
Route::post('update','MemoController@update');


//メモの詳細へのルート
Route::get('{id}','MemoController@detail');
