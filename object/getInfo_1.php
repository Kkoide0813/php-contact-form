<?php

/*
カプセル化について
*/

class User{
  private $name;
  private $score;

  public function __construct($name, $score){
    $this->name = $name; // this->name = 小出
    $this->score = $score; // this->score = 70
  }
  
  // getter
  public function getInfo(){
    return "{$this->name}, {$this->score}, {$this->getResult()}";
  }
  
  // setter
  public function setInfo($name, $score){
    $this->name = $name; // 小出 = 鈴木へ上書き
    $this->score = $score; // 70 = 90へ上書き
  }
  
  private function getResult(){
    if($this->score > 80){
      return 'pass';
    }else{
      return 'fail';
    }
  }
}

// // インスタンス
// $user1 = new User('小出', 70);
// $user2 = new User('田中', 90);

// インスタンス
$user1 = new User('小出', 70);
$user2 = new User('田中', 60);

echo $user1->getInfo() . '<br>'; // 小出

$user1->setInfo('鈴木', 90); // 小出 -> 鈴木 上書き

echo $user1->getInfo() . '<br>'; // 鈴木
echo $user2->getInfo() . '<br>'; // 田中

// echo $user2->getResult() . '<br>'; //スコープ外なのでエラー
// 80点以上 pass, それ以外はfailと表示
