<?php
// DBの中身を表示する機能
require 'db_connection.php';


// ユーザー入力なしのパターン  query
// SQLが決まっており、毎回同じ表示をさせる場合に使う
$sql = 'select * from contacts where id = 4'; // sql
$stmt = $pdo->query($sql); // sql実行
$result = $stmt->fetchall(); // sqlの結果を表示

echo '<pre>';
var_dump($result);
echo '</pre>';


// ユーザー入力ありのパターン ＊SQLインジェクション対策
// 検索画面、お問い合わせフォーム のようなユーザー自身が入力する場合に使う
$sql = 'select * from contacts where id = :id'; // :id 名前付きプレースフォルダと呼ぶ
$stmt = $pdo->prepare($sql); // 準備
$stmt->bindValue('id', 2, PDO::PARAM_INT); // 紐付け
$stmt->execute(); // 実行
$result = $stmt->fetchall(); //SQL結果表示


echo '<pre>';
var_dump($result);
echo '</pre>';


// トランザクション まとまって処理すること biginTransaction, commit, rollback
// ex) 残高確認->Aさんから引き落とし->Bさんに振り込み

$pdo->beginTransaction(); // トランザクション開始

try {

  $stmt = $pdo->prepare($sql); // 準備
  $stmt->bindValue('id', 2, PDO::PARAM_INT); // 紐付け
  $stmt->execute(); // 実行
  
  $pdo->commit(); // sql処理

}catch(PDOException $e){

  $pdo->rollBack(); // 更新キャンセル
}