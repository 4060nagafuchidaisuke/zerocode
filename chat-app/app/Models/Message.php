<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    // 一括代入(マスアサインメント)の許可：ホワイトリスト形式で指定するプロパティ
    protected $fillable = ['name', 'body', 'room_id'];
}
