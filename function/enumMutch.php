<?php

// Role（ロール）は、役割という意味
enum Role{
  case Admin;
  case Editor;
  case User;
}

$userRole = Role::Admin;

$message = match($userRole){
  Role::Admin => '全機能OK',
  Role::Editor => '編集OK',
  default => '権限がありません'
};

echo $message;

