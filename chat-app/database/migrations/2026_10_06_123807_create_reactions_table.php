<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // reactionテーブルを作る・カラムを追加する。
    public function up(): void
    {
        Schema::create('reactions', function (Blueprint $table) { // Blueprint型（）で$talbeの中に入ったどうかチェックする
            // カラムを作る
            $table->id();
            // メッセージが削除されると絵文字も削除する（リレーションキー）
            $table->foreignId('message_id')->constrained()->cascadeOnDelete();

            $table->string('name');
            $table->string('emoji');

            // 同じ人が同じメッセージに同じ絵文字を2回付けられなくする。
            $table->unique(['message_id', 'name', 'emoji']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    // テーブルを削除・追加カラムを削除する
    public function down(): void
    {
        Schema::dropIfExists('reactions');
    }
};
