<?php
/*
点数に応じて結果を判定する
抽象メソッド abstract
科目ごとにpass, failの基準を変えたい。数学50点、英語は95点
*/

abstract class Score{ // インスタンス化不可 
  private $subject;
  protected $points;

  public function __construct($subject, $points){
    $this->subject= $subject;
    $this->points = $points;
  }

  abstract protected function getResult(); // 末尾に; 必須 ないと構文エラー
  
  public function getScoreInfo(){
    return "{$this->subject}, {$this->points}, {$this->getResult()}";
  }
}

class MathScore extends Score{
  public function __construct($points)
  {
    parent::__construct("Math", $points); // 親クラスのメソッドの使い方
  }

  protected function getResult() // メソッドのオーバーライド（上書き）
  {
    return $this->points >= 50 ? 'pass' : 'fail';
  }
}

class EnglishScore extends Score{
  public function __construct($points)
  {
    parent::__construct("English", $points);
  }
  
  protected function getResult()
  {
    return $this->points >= 95 ? 'pass' : 'fail';
  }
  
}

class User{
  private $name;
  private $score;
  private static $count = 0;
  
  public function __construct($name, $score){
    $this->name = $name;
    $this->score = $score;
    User::$count++;
  }
    
  public function getInfo(){
    return "{$this->name},{$this->score->getScoreInfo()}";
  }
  
  public static function getUserCount(){ 
    return User::$count;
  }
  
}

$user1 = new User("Taro", new MathScore(70));
$user2 = new User("JIro", new EnglishScore(90));

// abstractクラスのScoreクラスはインスタンス化できない
// $user3 = new User("Taro", new Score('日本史', 70)); 

echo $user1->getInfo() . '<br>';
echo $user2->getInfo() . '<br>';

echo 'ユーザー数：' . User::getUserCount() . '<br>';