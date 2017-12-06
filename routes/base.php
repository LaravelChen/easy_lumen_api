<?php
$api = $app->make(Dingo\Api\Routing\Router::class);

/*
 * 引入自定义的路由文件
 */
require  'User/user.php';