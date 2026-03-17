<?php
// DBの中身を表示する機能

require 'db_connection.php';

// ユーザー入力なしのパターン  query
  // SQLが決まっており、毎回同じ表示をさせる場合に使う
  $sql = 'select * from contacts where id = 4'; // sql
  
  //$pdoは'db_connection.php'で実体化済み、queryメソッドを用意し、$sqlを読み込ませる
  $stmt = $pdo->query($sql); // sql実行 ステートメント
  
  $result = $stmt->fetchall(); // sqlの結果を表示  PDOStatementクラスのfetchall()
  
  echo '<pre>';
  var_dump($result);
  echo '</pre>';
  
  // ユーザー入力ありのパターン prepare(準備), bind(紐付け), execute（実行） ＊SQLインジェクション対策
  // 検索画面、お問い合わせフォーム のようなユーザー自身が入力する場合に使う
  $sql = 'select * from contacts where id = :id'; // :id 名前付きプレースフォルダと呼ぶ
  $stmt = $pdo->prepare($sql); // プリペアードステートメント
  $stmt->bindValue('id', 2, PDO::PARAM_INT); // 紐付け
  $stmt->execute(); // 実行
  
  $result = $stmt->fetchall(); //SQL結果表示
  
  echo '<pre>';
  var_dump($result);
  echo '</pre>';