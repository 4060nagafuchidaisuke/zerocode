<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // ルームを入れておく表
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // 最初の3つのルーム（『おしゃべり』の id が 1 になる）
        DB::table('rooms')->insert([
            ['name' => 'おしゃべり', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'メモ', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '連絡', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // メッセージがどのルームのものかを入れる列（いまある会話も、これからの送信も『おしゃべり』）
        Schema::table('messages', function (Blueprint $table) {
            $table->foreignId('room_id')->default(1)->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropConstrainedForeignId('room_id');
        });

        Schema::dropIfExists('rooms');
    }
};
