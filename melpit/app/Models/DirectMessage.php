<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DirectMessage extends Model
{
    /**
     * 
     * テーブル、可変項目
     */

    protected $table = 'direct_messages';

    protected $fillable = [
        'user_id',
        'destination',
        'message'
    ];

    //検索時,DM時のスコープ
    public function scopeWhereAuth($query, $auth_id) {
        return $query->where('user_id', $auth_id);
    }

    public function scopeWhereUser($query, $user_id) {
        return $query->where('destination',$user_id);
    }
}
