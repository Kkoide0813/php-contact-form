<?php

namespace App\Models;

class TestModel // ファイル名とクラス名を同じにしないとダメ
{
  private $text = 'hello world'; // 登録データ

  public function getHello(){ // ビジネスロジック
    return $this->text;
  }
}

