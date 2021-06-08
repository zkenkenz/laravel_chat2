<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
        /**
     * 
     * テーブル、可変項目
     */

    protected $table = 'informations';

    protected $fillable = [
        'user_id',
        'nickName',
        'image',
        'sex',
        'language',
        'introduction'
    ];

    //対象のユーザー選択時のスコープ
    public function scopeWhereUser($query, $user_id) {
        return $query->where('user_id', $user_id)->select('nickName', 'image');
    }

    //対象のプロフに関するスコープ
    public function scopeWhereId($query,$id) {
        return $query->where('user_id',$id);
    }
}
