<?php

// DB接続 PDO
function insertContact($request){

  require 'db_connection.php';
  
  // 入力 DB保存 prepare, bind, execute(配列（全て文字列）)
  
  $params = [
    'id' => null, // 自動入力
    'your_name' => $request['your_name'],
    'email' => $request['email'],
    'url' => $request['url'],
    'gender' => $request['gender'],
    'age' => $request['age'],
    'contact' => $request['contact']

    // 'created_at' => null // 自動入力
  ];
  // ダミーデータ
  // $params = [
  //   'id' => null, // 自動入力
  //   'your_name' => '名前123',
  //   'email' => 'test@test.com',
  //   'url' => 'http://test.com',
  //   'gender' => '1',
  //   'age' => '36',
  //   'contact' => 'ううう',
  //   // 'created_at' => null // 自動入力
  // ];
  
  $count = 0;
  $columns = '';
  $values = '';
  
  foreach(array_keys($params) as $key){ // array_keys 連想配列のキーを持って来れる
    if($count++>0){
      $columns .= ',';
      $values .= ',';
    }
    $columns .= $key;
    $values .= ':'.$key; // :$key 名前付きプレースホルダー
  }
  
  $sql = 'insert into contacts ('. $columns . ')values ('. $values . ')';
  // var_dump($sql);
  
  $stmt = $pdo->prepare($sql); // 準備 プリペアードステートメント
  $stmt->execute($params); // 実行
  
};