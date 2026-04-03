<?php

/*
static_1
*/

class User{
  // インスタンスプロパティ 個々のインスタンスの値を保持するプロパティ
  public $name;
  public $score;

  // クラスプロパティ＝static変数 インスタンス化せず、クラス外から呼び出せる変数
  public static $count = 0;

  public function __construct($name, $score){
    $this->name = $name;
    $this->score = $score;
    User::$count++; // staticの呼び出し方 クラス名::変数
  }
  
  
}

// いくつインスタンスを生成したか表示

// $user1 = new User('taro', 70);
// $user2 = new User('jiro', 90);

echo User::$count; //インスタンス化せずに、クラス外から呼び出し