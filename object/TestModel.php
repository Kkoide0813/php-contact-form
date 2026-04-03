<?php

/*
コンストラクタとは
*/

// // コンストラクタありの場合(プロパティの初期値がなく、外部から値を渡される場合)
// class TestModel
// {
//   private $text; // 初期値なし


//   public function __construct($word)
//   {
//     $this->text = $word; // 作る時に外から受け取った値をセットする
//   }


//   public function getHello()
//   {
//     return $this->text;
//   }
// }

// $testModel = new TestModel('helloWorld'); // newするときに値を渡す
// echo $testModel->getHello();



// コンストラクタ無しの場合 プロパティに初期値が設定されている
class TestModel
{
  private $text = 'HelloWorld'; // 初期値

  public function getText(){
    return $this->text;
  }
}

$testModel = new TestModel();
// echo $testModel->text;
echo $testModel->getText();