<?php
// パスワードを記録したファイルの場所
echo __FILE__;

echo '<br>';
// パスワード（暗号化）
echo(password_hash('123', PASSWORD_BCRYPT));
// $2y$10$r/7BaUSAyN13eqJDylQlfuW3ttlK1z8uoLa5Lcb4p.7wsnTHlqgey