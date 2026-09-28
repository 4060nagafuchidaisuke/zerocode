<?php

use App\Models\Message;
use App\Controller\ChatController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// 初めましての表示
Route::get('/hello', function (){
    return '初めまして！';
});

// チャット欄一覧
Route::get('/chat', function (){
    
    // Models/Message.phpの中のクラス「Message」を呼びだす（）
    $messages = Message::all();

    // chat.bladeの$messageの中身
    return view('chat', ['talks' => $messages]);
});

// 入力結果をデータベースへ渡す。
Route::POST('/chat', [ChatController::class, 'store']);

