<?php

session_start();
header('X-FRAME-OPTIONS:DENY');

if (!empty($_SESSION)) {
    echo '<pre>';
    var_dump($_SESSION);
    echo '</pre>';
}

// XSS対策
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
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
    <!-- 入力画面 $pageFlag === 0-->
    <?php if ($pageFlag === 0) : ?>
        <?php
        // csrfTokenが設定されていなければトークン作成
        if (!isset($_SESSION['csrfToken'])) {
            // random_bytes(24~32) ランダムな暗号作成し、bin2hexでバイナリからトークン化する
            $csrfToken = bin2hex(random_bytes(32));
            $_SESSION['csrfToken'] = $csrfToken;
        }
        $token = $_SESSION['csrfToken'];
        ?>

        <form method="POST" action="input.php">
            氏名
            <input type="text" name="your_name"
                value="<?php if (!empty($_POST['your_name'])) {
                            echo h($_POST['your_name']);
                        } ?>">
            <br>
            メールアドレス
            <input type="email" name="email"
                value="<?php if (!empty($_POST['email'])) {
                            echo h($_POST['email']);
                        } ?>">
            <br>
            <input type="submit" name="btn_confirm" value="確認する">
            <input type="hidden" name="csrf" value="<?php echo $token; ?>">
        </form>
    <?php endif; ?>

    <!-- 確認画面 $pageFlag === 1-->
    <?php if ($pageFlag === 1) : ?>
        <!-- トークンが一致しているか判定 -->
        <?php if ($_POST['csrf'] === $_SESSION['csrfToken']) : ?>
            <form method="POST" action="input.php">
                氏名
                <?php echo h($_POST['your_name']) ?>
                <br>
                メールアドレス
                <?php echo h($_POST['email']) ?>
                <br>
                <input type="submit" name="btn_submit" value="送信する">
                <input type="submit" name="back" value="戻る">
                <!-- 画面が切り替わっても入力内容のデータを保持する必要がある.表に出さないのでhidden -->
                <input type="hidden" name="your_name" value="<?php echo h($_POST['your_name']); ?>">
                <input type="hidden" name="email" value="<?php echo h($_POST['email']); ?>">
                <input type="hidden" name="csrf" value="<?php echo h($_POST['csrf']); ?>">
            </form>
        <?php endif; ?>

    <?php endif; ?>

    <!-- 完了画面 $pageFlag === 2-->
    <?php if ($pageFlag === 2) : ?>
        <!-- 完了画面でも合言葉があっていたかを確認する -->
        <?php if ($_POST['csrf'] === $_SESSION['csrfToken']) : ?>
            送信が完了しました。

            <!-- 合言葉がずっと残らないようにセッションを削除する。 -->
            <?php unset($_SESSION['csrfToken']); ?>
        <?php endif; ?>
        <form>
            <input type="submit" name="back" value="戻る">
        </form>
    <?php endif; ?>

</body>

</html>