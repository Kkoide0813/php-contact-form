<?php 

class Product{

  // アクセス修飾子 private, protected(継承元、継承クラス), public
  
  // 変数
  private $product = [];

  // 関数

  // コンストラクタ
  function __construct($product) {

    $this->product = $product;

  }

  public function getProduct(){
    echo $this->product;
  }

  public function addProduct($item){
    $this->product .= $item;
  }

  // 静的static＝インスタンスを作らずに使える
  public static function getStaticProduct($str){
    echo $str;
  }  

}


$instance = new Product('テスト');
// var_dump($instance);

$instance->getProduct();
echo '<br>';

$instance->addProduct('追加分');
$instance->getProduct();
echo '<br>';

// クラス名::関数名()
Product::getStaticProduct('静的');
echo '<br>';



?>