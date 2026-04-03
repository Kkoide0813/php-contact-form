<?php

/*
インターフェース
・継承関係にない Score クラスと User クラスで処理のログを取ってくれるようなメソッドを必ず実装する。
・インスタンス作成時にログメッセージが表示される処理を実装すること。
*/

interface Logable
{ // インターフェース名は 〜ableが多い
  public function log();
}

abstract class Score implements Logable{  // インターフェース使用 implements 
  private $subject;
  protected $points;

  public function __construct($subject, $points){
    $this->subject= $subject;
    $this->points = $points;
    $this->log();
  }
  
  public function log(){ //インターフェースの処理内容 必須
    echo "Instance created: {$this->subject} <br>"; 
  }

  abstract protected function getResult(); 
  
  public function getScoreInfo(){
    return "{$this->subject}, {$this->points}, {$this->getResult()}";
  }
}

class MathScore extends Score{
  public function __construct($points)
  {
    parent::__construct("Math", $points); 
  }

  protected function getResult() 
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

class User implements Logable{  // インターフェース使用 implements
  private $name;
  private $score;
  private static $count = 0;
  
  public function __construct($name, $score){
    $this->name = $name;
    $this->score = $score;
    $this->log(); // インスタンス生成時にlog()実行
    User::$count++;
  }
    
  public function getInfo(){
    return "{$this->name},{$this->score->getScoreInfo()}";
  }
  
  public static function getUserCount(){ 
    return User::$count;
  }

  public function log()
  {
    echo "Instance created: {$this->name}<br>";
  }
  
}

$user1 = new User("Taro", new MathScore(70));
$user2 = new User("JIro", new EnglishScore(90));

echo $user1->getInfo() . '<br>';
echo $user2->getInfo() . '<br>';

echo 'ユーザー数：' . User::getUserCount() . '<br>';