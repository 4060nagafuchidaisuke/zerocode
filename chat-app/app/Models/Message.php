<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Message extends Model
{
    // 一括代入(マスアサインメント)の許可：ホワイトリスト形式で指定するプロパティ
    protected $fillable = ['name', 'body', 'room_id'];

    // 1(メッセージ欄)→多(リアクション)の関係
    public function reactions(): HasMany
    {
        return $this->hasMany(Reaction::class);
    }
}
