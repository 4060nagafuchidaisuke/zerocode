<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    // ルームの画面へ遷移させる
    public function index()
    {
        //
        if (session('nickname') === null) {
            return redirect('/enter');
        }
        
        // Models/Room.phpの中のクラス「Room」を呼びだす（roomテーブルから、全部の行を取り出す→今は「'name'」だけ）
        $rooms = Room::all();

        // room.blade.phpの$roomsの中身(return view('Blade名', ['Bladeで使う変数名' => $コントローラーで使った変数名]);)
        return view('rooms', ['rooms' => $rooms]);
    }

    // コメントが入力されたら画面が更新される
    public function show(Room $room)
    {
        //
        if (session('nickname') === null) {
            return redirect('/enter');
        }

        // Models/Message.phpの中のクラス「Message」を呼びだす。
        // （Messageテーブルから、全部の行を取り出す→['name', 'body', 'room_id']）
        $messages = $room -> messages;

        // chat.blade.phpの中のルーム名とトーク内容を表示
        return view('chat', ['room' => $room, 'messages' => $messages]);
    }
}
