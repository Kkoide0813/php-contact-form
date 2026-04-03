<?php
// View Controllerを呼び出し、画面出力
require_once __DIR__ . '/vendor/autoload.php';

use App\Controllers\TestController;

$app = new TestController;

$app->run();

use Carbon\Carbon;

$dt = Carbon::now();

// 今日かどうか
var_dump($dt->isToday()); // true