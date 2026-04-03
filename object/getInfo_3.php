<?php
/*
static_2
*/

class User{
  private $name;
  private $score;
  // public static $count = 0;
  private static $count = 0;

  public function __construct($name, $score){
    $this->name = $name;
    $this->score = $score;
    User::$count++;
  }

  // クラスメソッド => 
  // インスタンスではなく、クラスに紐づいたメソッド staticをつける
  public static function getUserCount(){ 
    return User::$count;
  }

  // インスタンスメソッド => インスタンスに紐づいたメソッド
  public function getUserInfo(){
    return "{$this->name}, {$this->score}";
  }

}
// Userクラス外でcountをいじれないようにする
$user1 = new User('taro', 70);
$user2 = new User('jiro', 90);

echo 'ユーザー情報：' . $user1->getUserInfo() . '<br>';

echo 'オブジェクト数：' . User::getUserCount();
