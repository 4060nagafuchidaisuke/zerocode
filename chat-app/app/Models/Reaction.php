<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reaction extends Model
{
    // 一括代入(マスアサインメント)の許可：ホワイトリスト形式で指定するプロパティ
    protected $fillable = ['message_id', 'name', 'emoji'];

    // 型の設定
    protected function casts(): array
    {
        return [
            'message_id' => 'int',
            'name' => 'string',
            'emoji' => 'string',
        ];
    }

    public function message(): BelongsTo
    {
        return $this->belongsTo(Message::class);
    }

}
