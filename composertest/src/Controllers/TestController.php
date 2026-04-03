<?php

namespace App\Controllers; //名前空間 "APP\\": "src/" 

use App\Models\TestModel; // autoloadを使う場合は、use 名前空間\フォルダ\ファイル名＝クラス名

class TestController // Model（ビジネスロジック）の呼び出し
{
  public function run(){
    $model = new TestModel; // インスタンス化
    echo $model->getHello();
  }
}