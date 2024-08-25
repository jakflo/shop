<?php

$root = __DIR__;
$env_path = $root . '/app/conf/Env.php';

if (PHP_OS_FAMILY === 'Windows') {
    $root = str_replace('/', '\\', $root);
    $env_path = str_replace('/', '\\', $env_path);
}

require_once $env_path;
$env = new app\conf\Env($root);

$controler = new \app\pages\order\OrderConroller($env);
$controler->render((object)['get' => $_GET]);
