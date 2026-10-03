<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Roomseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Room::firstOrCreate(['name' => 'おしゃべり']);
        Room::firstOrCreate(['name' => 'メモ']);
        Room::firstOrCreate(['name' => 'れんらく']);
    }
}
