<?php
const DB_HOST = 'mysql:dbname=udemy_php;host=127.0.0.1;port=8889;charset=utf8';
const DB_USER = 'php_user';
const DB_PASSWORD = '123';

try {
  // PDOでDB接続 PDOクラスのインスタンスを作る
  $pdo = new PDO(DB_HOST, DB_USER, DB_PASSWORD, [
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // フェッチモードを連想配列
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // 例外処理
      PDO::ATTR_EMULATE_PREPARES => false, // エミュレーション(偽物)を無効にする
  ]);

  echo '接続成功';
} catch (PDOException $e) { // 例外時
  echo '接続失敗' . $e->getMessage() . "\n"; //エラーメッセージ
  exit();
}