<?php

if(!empty($_POST)){
    echo '<pre>';
    var_dump($_POST);
    echo '</pre>';
}

?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせ</title>
</head>

<body>
    <form method="POST" action="input.php">
        氏名
        <input type="text" name="your_name">
        <br>
        <input type="checkbox" name="sports" value="サッカー">サッカー
        <input type="checkbox" name="sports" value="野球">野球
        <input type="checkbox" name="sports" value="バスケ">バスケ
        <br>
        <input type="submit" value="送信">
    </form>
</body>

</html>