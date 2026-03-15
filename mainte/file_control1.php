<?php

$contactFile = '.contact.dat';

$fileContents = file_get_contents($contactFile);

// echo $fileContents;

// ファイルに上書き
// file_put_contents($contactFile, 'テストです');

// 追記する度に改行する方法
// $addText = 'テストです' . "\n";

// ファイルに追記
// file_put_contents($contactFile, $addText, FILE_APPEND);

// 配列 file ,区切る explode, foreach
$allData = file($contactFile); // 配列になる

// echo '<pre>';
// var_dump($allData);
// echo '</pre>';
// exit;

foreach($allData as $lineData){
  $lines = explode(',', $lineData);
  echo $lines[0]. '<br>';
  echo $lines[1]. '<br>';
  echo $lines[2]. '<br>';
  echo $lines[3]. '<br>';
}