<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EnterController extends Controller
{
    // 入室する
    public function show()
    {
        return view('enter');
    }

    // 入室に関するバリデーションチェック
    public function store(Request $request)
    {
        // ニックネームのDBチェック
        $validated = $request->validate([
            'nickname' => 'required',// required：必須項目の意
        ], [
            'nickname.required' => 'ニックネームを入力してください',
        ]);

        // ニックネームで入室
        session(['nickname' => $validated['nickname']]);

        return redirect('/rooms');

    }
}
