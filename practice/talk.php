<?php

$names = ['はな', 'そら', 'ゆい'];

foreach ($names as $name){
    echo $name . "\n";
}

$messages = [
    ['name' =>'はな', 'body' =>'こんばんは'],
    ['name' =>'そら', 'body' =>'こんばんは。今、勉強しています！'],
    ['name' =>'ゆい', 'body' =>'わたしもです！'],
];

foreach ($messages as $message){
    echo $message['name'] . ':'. $message['body'] ."\n";
}