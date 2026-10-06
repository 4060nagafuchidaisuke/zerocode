<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Message;
use App\Models\Reaction;

class ReactionController extends Controller
{
    //
    public function store(Request $request, Message $message)
    {
        // 絵文字のチェック
        $validated = $request->validate([
            'emoji' => ['required', Rule::in(['😀', '😂', '👍', '❤️', '🎉', '😢',])],
        ]);

        // メッセージした人がリアクションした場合は更新しない
        if ($message->name === session('nickname')){
            return back();
        }

        // すでに付いているリアクションを探す
        $reaction = $message->reactions()
            ->where('name',session('nickname'))
            ->where('emoji', $validated['emoji'])
            ->first();
        
        // 同じリアクションだったら消す
        if($reaction){
            $reaction->delete();

        // 違うリアクションならば、許可する
        }else{
            Reaction::create([
                'message_id' => $message->id,
                'name' => session('nickname'),
                'emoji' =>$validated['emoji'],
            ]);
        }
        //  リアクションの確定
        return redirect('/rooms/' . $message->room_id);
        
    }
}