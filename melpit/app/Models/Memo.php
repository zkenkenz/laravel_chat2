<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
     /**
     * 
     * テーブル、可変項目
     */

    protected $table = 'memos';  

    protected $dates = ['date'];  //フォーマット指定用

    protected $fillable = [
        'user_id',
        'date',
        'title',
        'content',
        'serect'
    ];

    //メモ選択時のスコープ
    public function scopeWhereMemoId($query,$memoId){
        return $query->where('id',$memoId);
    }
}
