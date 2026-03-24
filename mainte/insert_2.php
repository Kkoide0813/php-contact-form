<?php

// DB接続 PDO
require 'db_connection.php';

// 入力 DB保存 prepare, bind, execute(配列（全て文字列）)

$params = [
  'id' => null, // 自動入力
  'your_name' => '名前',
  'email' => 'test@test.com',
  'url' => 'http://test.com',
  'gender' => '1',
  'age' => '2',
  'connect' => 'いいい',
  'created_at' => 'NOW()'
];

$count = 0;
$columns = '';
$values = '';

foreach(array_keys($params) as $key){
  if($count > 0){ // 1
    $columns .= ','; // $columns = 'id' , 
    $values .= ','; 
  }
  $columns .= $key; // $columns = 'id' , 'your_name'
  $values .= ':' . $key; 
  $count++; // 0 -> 1
  }
// echo $columns , '<br>';
// echo $values , '<br>';


$sql = 'insert into contacts ('. $columns . ')values ('. $values . ')';
var_dump($sql);
exit;

$stmt = $pdo->prepare($sql); // 準備 プリペアードステートメント
$stmt->bindValue('id', 5, PDO::PARAM_INT); // 紐付け
$stmt->execute(); // 実行
