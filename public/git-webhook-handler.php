<?php
// git webhook 自动部署脚本
// 项目存放的路径
$path = '/var/www/laravel-wechat';
$requestBody = file_get_contents("php://input");
if (empty($requestBody)) {
    die('send fail');
}
$contents = json_decode($requestBody, true);
if ($contents['ref'] == 'refs/heads/master' && $contents['total_commits_count'] > 0) {
    $res = shell_exec("cd {$path} && git pull 2>&1");
    $res_log = '------------------------'.PHP_EOL;
    $rel_log .= $contents['user_name'] . ' 在' . data('Y-m-d H:i:s') . '向' . $contents['repository']['name'] . '项目的'
        . $contents['ref'] . '分支push了' . $contents['total_commits_count'] . '个commit:' . PHP_EOL;
    $res_log .= $res.PHP_EOL;
    file_put_contents('git-webhook.txt', $res_log, FILE_APPEND);
}