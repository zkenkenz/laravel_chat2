<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemoImage extends Model
{
    /**
     * 
     * 可変項目
     */

    protected $table = 'memo_images';

    protected $fillable = [
        'memo_id',
        'image'
    ];
}
