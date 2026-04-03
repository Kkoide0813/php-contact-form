<?php
//可変引数
function combine(string ...$name): string // ...$name → 複数引数を配列にする $name = ['名前', '苗字']
{
    $combinedName = '';
    for($i = 0; $i < count($name); $i++) { // count($name) -> 2 つまり、2回繰り返す
        $combinedName .= $name[$i]; // $name[0] -> 名前・苗字
        if($i != count($name) - 1) {
            $combinedName .= '・'; // 名前・
        }
    }
    return $combinedName;
}

$lName = '名前';
$fName = '苗字';
$name1 = combine($fName, $lName); // $name1 = '名前'. '・'. '苗字';

echo '結合結果: '. $name1 ; // 結合結果:名前・苗字
echo '<br>';

$variableLength = combine('テスト1', 'テスト2', 'テスト3'); 
echo $variableLength;

