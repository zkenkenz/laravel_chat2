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
}
