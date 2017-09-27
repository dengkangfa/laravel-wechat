<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WechatController extends Controller
{
    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {

        $wechat = app('wechat');
        $wechat->server->setMessageHandler(function($message) use ($wechat) {
	    $server = $wechat->server;
	    $user = $wechat->user;
	    $oauth = $wechat->oauth;
	    return $user;
            return "欢迎关注 overtrue！";
        });

        return $wechat->server->serve();
    }
}
