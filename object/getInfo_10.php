<?php
/*
クラスのデータ型
*/

declare(strict_types=1);

trait LogTrait{ 
  public function log(){
    $className = get_class($this);
    echo "[DEBUG] Instance created in class: <strong>{$className}</strong> <br>";
  }
}

abstract class Score{
  use LogTrait;
  private string $subject;
  protected int $points;

  public function __construct($subject, $points){
    $this->subject= $subject;
    $this->points = $points;
    $this->log();
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

class User{  
  use LogTrait;
  private string $name;
  private Score $score; // 親クラスのクラス型でOK
  private static $count = 0;
  
  public function __construct(string $name, Score $score){
    $this->name = $name;
    $this->score = $score;
    $this->log(); 
    User::$count++;
  }
    
  public function getInfo():string
  {
    return "{$this->name},{$this->score->getScoreInfo()}";
  }
  
  public static function getUserCount():int
  { 
    return User::$count;
  }
  
}

$user1 = new User("Taro", new MathScore(70));
$user2 = new User("JIro", new EnglishScore(90));

echo $user1->getInfo() . '<br>';
echo $user2->getInfo() . '<br>';

echo 'ユーザー数：' . User::getUserCount() . '<br>';