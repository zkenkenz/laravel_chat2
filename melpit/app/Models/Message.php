<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * 
     * 可変項目
     */

    protected $table = 'messages';

    protected $fillable = [
        'user_id',
        'user_name',
        'language',
        'message'
    ];
}
