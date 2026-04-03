<?php
/*
トレイト
処理も書けるインターフェースのようなもの
同じ処理を複数のクラスで使用する場合に便利 log()
*/

trait LogTrait{ // トレイト名は 〜Trait
  public function log(){
    // get_class($this) は、実際にインスタンス化されたクラス名を返すデフォルト関数
    $className = get_class($this);
    echo "[DEBUG] Instance created in class: <strong>{$className}</strong> <br>";
  }
}

abstract class Score{
  use LogTrait; // traitを使用
  private $subject;
  protected $points;

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
  use LogTrait; // traitを使用
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
  
}

$user1 = new User("Taro", new MathScore(70));
$user2 = new User("JIro", new EnglishScore(90));

echo $user1->getInfo() . '<br>';
echo $user2->getInfo() . '<br>';

echo 'ユーザー数：' . User::getUserCount() . '<br>';