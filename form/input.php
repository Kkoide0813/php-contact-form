<?php

session_start();

require 'validation.php';

header('X-FRAME-OPTIONS:DENY');

// ログ
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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <title>お問い合わせ</title>
  </head>

  <body>
<!-- 入力画面 $pageFlag === 0-->
<?php if ($pageFlag === 0) : ?>

  <!-- csrf token -->
  <?php
  if (!isset($_SESSION['csrfToken'])) {
      $csrfToken = bin2hex(random_bytes(32));
      $_SESSION['csrfToken'] = $csrfToken;
  }
  $token = $_SESSION['csrfToken'];
  ?>
      
  <!-- バリデーション -->
  <?php if (!empty($errors) && !empty($_POST['btn_confirm'])): ?>
      <?php echo '<ul>'; ?>
      <?php foreach ($errors as $error) {echo '<li>' . $error . '</li>';} ?>
      <?php echo '</ul>'; ?>
  <?php endif; ?>

  <!-- 入力フォーム -->
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <form method="POST" action="input.php">

          <div class="form-group">
            <label for="your_name">氏名</label>
            <input type="text" class="form-control" id="your_name" name="your_name" 
              value="<?php if (!empty($_POST['your_name'])) {echo h($_POST['your_name']);} ?>" required>
          </div>

          <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" class="form-control" id="email" name="email"
              value="<?php if (!empty($_POST['email'])) {echo h($_POST['email']);} ?>" required>
          </div>
          
          <div class="form-group">
            <label for="url">ホームページ</label>
            <input type="url" class="form-control" id="url" name="url" 
              value="<?php if (!empty($_POST['url'])) {echo h($_POST['url']);} ?>">
          </div>

          
          性別
          <div class="form-group">
            <div class="form-check form-check-inline">
              <input type="radio" class="form-check-input" id="gender1" name="gender" value="0"
                <?php if (isset($_POST['gender']) && $_POST['gender'] === '0') {echo 'checked';} ?>>
              <label class="form-check-label" for="gender">男性</label>

              <input type="radio" class="form-check-input" id="gender2" name="gender" value="1"
                <?php if (isset($_POST['gender']) && $_POST['gender'] === '1') {echo 'checked';} ?>>
              <label class="form-check-label" for="gender">女性</label>
            </div>
          </div>

          <div class="form-group">
            <label for="age">年齢</label>
            <select class="form-control" id="age" name="age">
              <option value="">選択してください</option>
              <option value="1" <?php if (!empty($_POST['age']) && $_POST['age'] === '1') {echo 'selected';} ?>>〜19歳</option>
              <option value="2" <?php if (!empty($_POST['age']) && $_POST['age'] === '2') {echo 'selected';} ?>>20〜29歳</option>
              <option value="3" <?php if (!empty($_POST['age']) && $_POST['age'] === '3') {echo 'selected';} ?>>30〜39歳</option>
              <option value="4" <?php if (!empty($_POST['age']) && $_POST['age'] === '4') {echo 'selected';} ?>>40〜49歳</option>
              <option value="5" <?php if (!empty($_POST['age']) && $_POST['age'] === '5') {echo 'selected';} ?>>50〜59歳</option>
              <option value="6" <?php if (!empty($_POST['age']) && $_POST['age'] === '6') {echo 'selected';} ?>>60〜歳</option>
            </select>
          </div>

          <div class="form-group">
            <label for="contact">お問い合わせ内容</label>
            <textarea class="form-control" id="contact" rows="3" name="contact" required><?php if (!empty($_POST['contact'])) {echo h($_POST['contact']);} ?></textarea>
          </div>
          
          <div class="form-group">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="caution" name="caution" value="1">
              <label class="custom-control-label" for="caution">注意事項にチェック</label>
            </div>
          </div>

          <div class="form-group">
            <input class="btn btn-info" type="submit" name="btn_confirm" value="確認する">
          </div>

          <input type="hidden" name="csrf" value="<?php echo $token; ?>">
        </form>
      </div>
    </div>
  </div>
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
    <?php if ($_POST['gender'] === '0') {echo '男性';} ?>
    <?php if ($_POST['gender'] === '1') {echo '女性';} ?>
    <br>
    年齢
    <?php if ($_POST['age'] === '1') {echo '〜19歳';} ?>
    <?php if ($_POST['age'] === '2') {echo '20歳〜29歳';} ?>
    <?php if ($_POST['age'] === '3') {echo '30歳〜39歳';} ?>
    <?php if ($_POST['age'] === '4') {echo '40歳〜49歳';} ?>
    <?php if ($_POST['age'] === '5') {echo '50歳〜59歳';} ?>
    <?php if ($_POST['age'] === '6') {echo '60歳〜';} ?>
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

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

  </body>
</html>