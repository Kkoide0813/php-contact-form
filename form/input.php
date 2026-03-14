<?php

session_start();

require 'validation.php';

header('X-FRAME-OPTIONS:DENY');

if (!empty($_POST)) {
    echo '<pre>';
    var_dump($_POST);
    echo '</pre>';
}

// XSS対策
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// 入力画面
$pageFlag = 0;

// エラーの判定結果が返ってくる
$errors = validation($_POST);

// 確認ボタンを押している且つ、エラーがないならページ遷移
if (!empty($_POST['btn_confirm']) && empty($errors)) {
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

        <!-- csrfトークン作成 -->
        <?php
        if (!isset($_SESSION['csrfToken'])) {
            $csrfToken = bin2hex(random_bytes(32));
            $_SESSION['csrfToken'] = $csrfToken;
        }
        $token = $_SESSION['csrfToken'];
        ?>
        <!-- バリデーション エラー有りかつ、確認ボタンが押されていたら -->
        <?php if (!empty($errors) && !empty($_POST['btn_confirm'])): ?>
            <?php echo '<ul>'; ?>
            <?php foreach ($errors as $error) {
                echo '<li>' . $error . '</li>';
            } ?>
            <?php echo '</ul>'; ?>
        <?php endif; ?>
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
            ホームページ
            <input type="url" name="url"
                value="<?php if (!empty($_POST['url'])) {
                            echo h($_POST['url']);
                        } ?>">
            <br>
            性別
            <!-- checkedが入っていないと、戻るボタンを押しても情報が引き継がれないので条件分岐を追加 -->
            <input type="radio" name="gender" value="0"
                <?php if (!empty($_POST['gender']) && $_POST['gender'] === '0') {
                    echo 'checked';
                } ?>>男性
            <input type="radio" name="gender" value="1"
                <?php if (!empty($_POST['gender']) && $_POST['gender'] === '1') {
                    echo 'checked';
                } ?>>女性
            <br>
            年齢
            <!-- selectedが入っていないと、戻るボタンを押しても情報が引き継がれないので条件分岐を追加 -->
            <select name="age">
                <option value="">選択してください</option>

                <option value="1"
                    <?php if (!empty($_POST['age']) && $_POST['age'] === '1') {
                        echo 'selected';
                    } ?>>
                    〜19歳</option>

                <option value="2"
                    <?php if (!empty($_POST['age']) && $_POST['age'] === '2') {
                        echo 'selected';
                    } ?>>
                    20歳〜29歳</option>

                <option value="3"
                    <?php if (!empty($_POST['age']) && $_POST['age'] === '3') {
                        echo 'selected';
                    } ?>>
                    30歳〜39歳</option>

                <option value="4"
                    <?php if (!empty($_POST['age']) && $_POST['age'] === '4') {
                        echo 'selected';
                    } ?>>
                    40歳〜49歳</option>

                <option value="5"
                    <?php if (!empty($_POST['age']) && $_POST['age'] === '5') {
                        echo 'selected';
                    } ?>>
                    50歳〜59歳</option>

                <option value="6"
                    <?php if (!empty($_POST['age']) && $_POST['age'] === '6') {
                        echo 'selected';
                    } ?>>
                    60歳〜</option>
            </select>
            <br>
            お問い合わせ内容
            <!-- textareaタグは複数行 value属性はない代わりにtextarea内の記述がvalueになる -->
            <textarea name="contact"><?php if (!empty($_POST['contact'])) {
                                            echo h($_POST['contact']);
                                        } ?></textarea>
            <br>
            <input type="checkbox" name="caution" value="1">注意事項にチェック
            <br>
            <input type="submit" name="btn_confirm" value="確認する">
            <input type="hidden" name="csrf" value="<?php echo $token; ?>">
        </form>
    <?php endif; ?>

    <!-- 確認画面 $pageFlag === 1-->
    <?php if ($pageFlag === 1) : ?>
        <?php if ($_POST['csrf'] === $_SESSION['csrfToken']) : ?>
            <form method="POST" action="input.php">
                氏名
                <?php echo h($_POST['your_name']) ?>
                <br>
                メールアドレス
                <?php echo h($_POST['email']) ?>
                <br>
                ホームページ
                <?php echo h($_POST['url']) ?>
                <br>
                性別
                <?php if ($_POST['gender'] === '0') {
                    echo '男性';
                } ?>
                <?php if ($_POST['gender'] === '1') {
                    echo '女性';
                } ?>
                <br>
                年齢
                <?php if ($_POST['age'] === '1') {
                    echo '〜19歳';
                } ?>
                <?php if ($_POST['age'] === '2') {
                    echo '20歳〜29歳';
                } ?>
                <?php if ($_POST['age'] === '3') {
                    echo '30歳〜39歳';
                } ?>
                <?php if ($_POST['age'] === '4') {
                    echo '40歳〜49歳';
                } ?>
                <?php if ($_POST['age'] === '5') {
                    echo '50歳〜59歳';
                } ?>
                <?php if ($_POST['age'] === '6') {
                    echo '60歳〜';
                } ?>
                <br>
                お問い合わせ内容
                <?php echo h($_POST['contact']) ?>
                <br>

                <input type="submit" name="btn_submit" value="送信する">
                <input type="submit" name="back" value="戻る">
                <input type="hidden" name="your_name" value="<?php echo h($_POST['your_name']); ?>">
                <input type="hidden" name="email" value="<?php echo h($_POST['email']); ?>">
                <input type="hidden" name="url" value="<?php echo h($_POST['url']); ?>">
                <input type="hidden" name="gender" value="<?php echo h($_POST['gender']); ?>">
                <input type="hidden" name="age" value="<?php echo h($_POST['age']); ?>">
                <input type="hidden" name="contact" value="<?php echo h($_POST['contact']); ?>">

                <input type="hidden" name="csrf" value="<?php echo h($_POST['csrf']); ?>">
            </form>
        <?php endif; ?>
    <?php endif; ?>

    <!-- 完了画面 $pageFlag === 2-->
    <?php if ($pageFlag === 2) : ?>
        <?php if ($_POST['csrf'] === $_SESSION['csrfToken']) : ?>
            送信が完了しました。
            <?php unset($_SESSION['csrfToken']); ?>
        <?php endif; ?>
        <form>
            <input type="submit" name="back" value="戻る">
        </form>
    <?php endif; ?>

</body>

</html>