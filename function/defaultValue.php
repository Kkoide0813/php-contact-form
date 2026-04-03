<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);

function defaultValue($string = null) // ＝つけると初期値となる
{
  echo $string . 'です';
}

//引数なし
defaultValue();
echo '<br>';

//引数あり
defaultValue('テスト');
