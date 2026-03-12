<?php

if (!empty($_POST)) {
    echo '<pre>';
    var_dump($_POST);
    echo '</pre>';
}

// 入力画面
$pageFlag = 0;

if (!empty($_POST['btn_confirm'])) {
    $pageFlag = 1;
}

// 完了画面
if (!empty($_POST['btn_submit'])) {
    $pageFlag = 2;
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
    <!-- 入力画面 -->
    <?php if ($pageFlag === 0) : ?>
        <form method="POST" action="input.php">
            氏名
            <input type="text" name="your_name">
            <br>
            メールアドレス
            <input type="email" name="email">
            <br>
            <input type="submit" name="btn_confirm" value="確認する">
        </form>
    <?php endif; ?>

    <!-- 確認画面 -->
    <?php if ($pageFlag === 1) : ?>
        <form method="POST" action="input.php">
            氏名
            <?php echo $_POST['your_name'] ?>
            <br>
            メールアドレス
            <?php echo $_POST['email'] ?>
            <br>
            <input type="submit" name="btn_submit" value="送信する">
        </form>
    <?php endif; ?>

    <!-- 完了画面 -->
    <?php if ($pageFlag === 2) : ?>
        送信が完了しました。
    <?php endif; ?>

</body>

</html>