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
}
