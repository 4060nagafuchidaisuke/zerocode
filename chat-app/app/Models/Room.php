<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    // 一括代入(マスアサインメント)の許可：ホワイとリスト形式で指定するプロパティ
    protected $fillable = ['name'];

    // 1(チャット欄)→多(ルームの種類：おしゃべり、メモ、れんらく)の関係
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
