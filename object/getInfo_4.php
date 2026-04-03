<?php
/*
スコアクラスを分けて、科目も表示させる
*/
Class Score{
  private $subject;
  private $points;

  public function __construct($subject, $points){
    $this->subject= $subject;
    $this->points = $points;
  }

  public function getScoreInfo(){
    return "{$this->subject}, {$this->points}";
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

$user1 = new User("Taro", new Score("Math", 70));
$user2 = new User("JIro", new Score("English", 90));

echo $user1->getInfo() . '<br>';
echo $user2->getInfo() . '<br>';

echo 'ユーザー数：' . User::getUserCount() . '<br>';