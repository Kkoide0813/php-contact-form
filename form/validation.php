<?php

// バリデーション
function validation($request){
    $errors = [];

    // 氏名必須、20字以内
    if(empty($request['your_name']) || 20 < mb_strlen($request['your_name'])){
        $errors[] = '「氏名」は必須です。20文字以内で入力してください';
    }
    
    // メールアドレス必須、正しい形式じゃなかったらエラーメッセージ
    if(empty($request['email']) || !filter_var($request['email'], FILTER_VALIDATE_EMAIL)){
        $errors[] = '「メールアドレス」は必須です。正しい形式で入力してください';
    }
    
    // 性別必須 ラジオボタンなので、emptyではなく、isset
    if(!isset($request['gender'])){
        $errors[] = '「性別」は必須です。';
    }

    // 年齢必須
    if (empty($request['age'])) {
        $errors[] = '「年齢」は必須です。';
    }

    // お問い合わせ内容必須、200字以内
    if(empty($request['contact']) || 200 < mb_strlen($request['contact'])){
        $errors[] = '「お問い合わせ」は必須です。200文字以内で入力してください。';
    }

    // ホームページは入力されていた場合、且つ、正しい形式じゃなかったらエラーメッセージ
    if (!empty($request['url']) && !filter_var($request['url'], FILTER_VALIDATE_URL)) {
        $errors[] = '「ホームページ」は正しい形式で入力してください。';
    }

    // 注意事項は確認必須
    if (empty($request['caution'])) {
        $errors[] = '「注意事項」をご確認ください。';
    }
    return $errors;
}


?>