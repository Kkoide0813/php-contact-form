<?php
// ストリーム型のファイル操作

$contactFile = '.contact.dat';

// 書き出しなので、a+
$contents = fopen($contactFile, 'a+');

// 追記
$addText = '1行追記' . "\n";

// 書き込み
fwrite($contents, $addText);
fclose($contents);

