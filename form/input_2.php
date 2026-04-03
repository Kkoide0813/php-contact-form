<?php

// セキュリティ
// XSS対策 
function h($str)
{
  return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
}

// バリデーション
// 氏名 必須 text 
// 性別 必須 radio
// メールアドレス 必須 email
// ホームページ 入力->正しい形式で url
// 問い合わせ内容 必須 textarea

// 注意事項のチェック 必須 checkbox


// ログ
/* if (!empty($_POST)) {
  echo '<pre>';
  var_dump($_POST);
  echo '</pre>';
} */

// ログ関数 ddはDumpDie
function dd($var){
  echo '<pre>';
  var_dump($_POST);
  echo '</pre>';
}

/* データが存在する時ログを出力 ?? NULLの時 */
$value = $_POST ?? '';
dd($value);

// 入力画面 ページ0
$pageFlag = 0;


// 確認->ページ1
if (!empty($_POST['btn_confirm'])) {$pageFlag = 1;}

$_POST['btn_confirm'] ?? '';


// 送信->ページ2, 戻る->ページ1
if (!empty($_POST['btn_submit'])) {
  if (!empty($_POST['back'])) {
    $pageFlag = 0;
  }
  $pageFlag = 2;
}

// TOPへ->ページ0
if (!empty($_POST['top'])) {
  $pageFlag = 0;
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
    <form method="POST" , action="input_2.php">
      氏名
      <input type="text" , name="your_name" ,
        value="<?php if (!empty($_POST['your_name'])) {echo h($_POST['your_name']);} ?>">
      <br>
      性別
      <input type="radio" name="gender" value="0"
        <?php if (!empty($_POST['gender']) && $_POST['gender'] === '0') {echo 'checked';} ?>>男性
      <input type="radio" name="gender" value="1"
        <?php if (!empty($_POST['gender']) && $_POST['gender'] === '1') {echo 'checked';} ?>>女性
      <br>
      <!-- optionタグを選択中にするには selected -->
      年齢
      <select name="age">
        <option value="">選択してください</option>
        <option value="1" <?php if(!empty($_POST['age']) && $_POST['age'] === '1'){echo 'selected';} ?>>〜19歳</option>
        <option value="2" <?php if(!empty($_POST['age']) && $_POST['age'] === '2'){echo 'selected';} ?>>20歳〜59歳</option>
        <option value="3" <?php if(!empty($_POST['age']) && $_POST['age'] === '3'){echo 'selected';} ?>>60歳〜</option>
      </select>
      <br>
      メールアドレス
      <input type="email" , name="email" , value="<?php if (!empty($_POST['email'])) {echo h($_POST['email']);} ?>">
      <br>
      ホームページ
      <input type="url" , name="url" , value="<?php if (!empty($_POST['url'])) {echo h($_POST['url']);} ?>">
      <br>
      <!-- textareaにはvalueはない -->
      お問い合わせ内容
      <textarea name="contact" rows="3"><?php if (!empty($_POST['contact'])) {echo h($_POST['contact']);} ?></textarea>
      <br>
      注意事項
      <br>
      <input type="checkbox" name="caution[]" value="1" <?php if(!empty($_POST['caution']) && in_array('1', $_POST['caution'] )){echo 'checked';} ?>>チェック:1 
      <input type="checkbox" name="caution[]" value="2" <?php if(!empty($_POST['caution']) && in_array('2', $_POST['caution'] )){echo 'checked';} ?>>チェック:2 
      <input type="checkbox" name="caution[]" value="3" <?php if(!empty($_POST['caution']) && in_array('3', $_POST['caution'] )){echo 'checked';} ?>>チェック:3 
      <input type="checkbox" name="caution[]" value="4" <?php if(!empty($_POST['caution']) && in_array('4', $_POST['caution'] )){echo 'checked';} ?>>チェック:4 
      <br>
      <input type="submit" , name="btn_confirm" , value="確認">
    </form>
  <?php endif; ?>

  <!-- 確認画面 -->
  <?php if ($pageFlag === 1) : ?>
    <form method="POST" , action="input_2.php">
      氏名：
      <?php echo $_POST['your_name']; ?>
      <br>
      性別：
      <!-- 空なら'' -->
      <?php $gender = $_POST['gender'] ?? ''; ?>
      <?php if ($gender === '') {echo '';} ?>
      <?php if ($gender === '0') {echo '男性';} ?>
      <?php if ($gender === '1') {echo '女性';} ?>
      <br>
      年齢：
      <?php if ($_POST['age'] === '1') {echo '〜19歳';} ?>
      <?php if ($_POST['age'] === '2') {echo '20〜59歳';} ?>
      <?php if ($_POST['age'] === '3') {echo '60歳〜';} ?>
      <br>
      メールアドレス：
      <?php echo h($_POST['email']); ?>
      <br>
      ホームページ：
      <?php echo h($_POST['url']); ?>
      <br>
      お問い合わせ内容：
      <?php echo h($_POST['contact']); ?>
      <br>
      注意事項：
      <br>
      <?php if(!empty($_POST['caution'])) : ?>
        <?php 
        foreach($_POST['caution'] as $value){
          if($value === '1'){echo 'チェック:1 <br>';}
          if($value === '2'){echo 'チェック:2 <br>';}
          if($value === '3'){echo 'チェック:3 <br>';}
          if($value === '4'){echo 'チェック:4 <br>';}
        }echo '注意事項を全てチェックしてください';
        ?>
      <?php endif; ?>
      <br>

      <input type="submit" , name="btn_submit" , value="送信">
      <input type="submit" , name="back" , value="戻る">

      <?php
      $fields = ['your_name', 'gender', 'age', 'email', 'url', 'contact', 'caution'];

      foreach($fields as $field){
        $data = $_POST[$field] ?? '';
        if (is_array($data)) {
          // 配列（チェックボックス）の場合はループして複数出力
          foreach ($data as $value) {
            echo '<input type="hidden" name="' . $field . '[]" value="' . h($value) . '">' . "\n";
          }
        } else {
          // 文字列の場合はそのまま出力
          echo '<input type="hidden" name="' . $field . '" value="' . h($data) . '">' . "\n";
        }
      }
      ?>

    </form> 
  <?php endif; ?>

  <!-- 完了画面 -->
  <?php if ($pageFlag === 2) : ?>
    <form method="POST" , action="input_2.php">
      送信完了しました
      <br>
      <input type="submit" , name="top" , value="TOPへ">
    </form>
  <?php endif; ?>
</body>

</html>