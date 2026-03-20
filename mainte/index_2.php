<?php

require 'db_connection.php'; // DB接続


// 追加するレコード
$sql = "INSERT INTO contacts (your_name, email, url, gender, age, contact, created_at) 
            VALUES (:your_name, :email, :url, :gender, :age, :contact, :created_at)";

$stmt = $pdo->prepare($sql);

// 登録するデータの定義
$params = [
  ':your_name'  => 'ううう',
  ':email'      => 'sample@example.com',
  ':url'        => 'https://example.com',
  ':gender'     => 1,
  ':age'        => 25,
  ':contact'    => 'お問い合わせ内容のテストです',
  ':created_at' => date('Y-m-d H:i:s') // ★ 現在の「年-月-日 時:分:秒」を取得
];

// 実行
$result = $stmt->execute($params);

echo "新規レコードが正常に追加されました！";

echo '<pre>';
var_dump($result);
echo '</pre>';


// 「DBからユーザー一覧表示」
// 「1件だけ取得」
// 「削除機能」