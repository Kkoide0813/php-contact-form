<?php

/* 
抽象クラス
未実装のメソッド（抽象メソッド）を持てて、継承先にその実装を強制できるクラス
抽象クラスはインスタンス化できない。必ず継承側で使う。
*/

abstract class ProductAbstract{
  // 変数 関数
  public function echoProduct(){
    echo '抽象クラスです';
  }
  abstract public function getProduct();
  }

// // 親クラス・基底クラス・スーパークラス
// class BaseProduct{
//   // 変数 関数
//   public function echoProduct(){
//     echo '親クラスです';
//   }

//   public function getProduct(){
//     echo '親の関数です';
//   }

// }

// 小クラス・派生クラス・サブクラス
class Product extends ProductAbstract{

  // アクセス修飾子 private, protected(継承元、継承クラス), public
  
  // 変数
  private $product = [];

  // 関数

  // コンストラクタ
  function __construct($product) {

    $this->product = $product;

  }

  // // public function getProduct(){
  // //   echo $this->product;
  // }

  public function getProduct(){
    return $this->product;
  }

  public function addProduct($item){
    $this->product .= $item;
  }

  // 静的static＝インスタンスを作らずに使える
  public static function getStaticProduct($str){
    echo $str;
  }  

}


$instance = new Product('小クラスの関数です');
// var_dump($instance);

echo $instance->getProduct();
echo '<br>';

echo $instance->echoProduct();
echo '<br>';

$instance->addProduct(',' . ' 追加分');
echo $instance->getProduct();
echo '<br>';

// クラス名::関数名()
Product::getStaticProduct('静的');
echo '<br>';

?>