<?php
// phpinfo();

const DB_HOST = 'mysql:dbname=udemy_php;host=127.0.0.1;port=8889;charset=utf8';
const DB_USER = 'php_user';
const  DB_PASSWORD = '123';

// PDOでDB接続 PDOクラスのインスタンスを作る
$pdo = new PDO(DB_HOST, DB_USER, DB_PASSWORD);

// 例外処理 Exception
// DBの接続が切れても処理が続いてしまうとまずいので、例外処理を行う。正常な場合はtry, 接続失敗時はcatch $eはエラー
try{
  $pdo = new PDO(DB_HOST, DB_USER, DB_PASSWORD, [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // DBから返ってくる値を連想配列として取得
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // 例外
    PDO:: ATTR_EMULATE_PREPARES => false, // SQLインジェクション対策
  ]);
  echo '接続成功';
} catch(PDOException $e){
  echo '接続失敗' . $e->getMessage() . "\n";
  exit();
}

// クラスを実体化するさいに一番最初にコンストラクタが呼び出される
