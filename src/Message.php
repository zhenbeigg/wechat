<?php
/*
 * @author: 布尔
 * @name: 订阅消息
 * @desc: 介绍
 * @LastEditTime: 2023-04-24 11:21:54
 */

namespace Eykj\Wechat;

use Eykj\Base\GuzzleHttp;
use Eykj\Wechat\Service;

class Message
{
    protected ?GuzzleHttp $GuzzleHttp;

    protected ?Service $Service;

    // 通过设置参数为 nullable，表明该参数为一个可选参数
    public function __construct(?GuzzleHttp $GuzzleHttp, ?Service $Service)
    {
        $this->GuzzleHttp = $GuzzleHttp;
        $this->Service = $Service;
    }

    /**
     * @author: 布尔
     * @name: send
     * @return bool
     */
    public function subscribe_send(array $param): bool
    {
        /* 获取token */
        $access_token = $this->Service->get_access_token();
        $url = env('WECHAT_URL', 'https://api.weixin.qq.com') . "/cgi-bin/message/subscribe/send?access_token=" . $access_token;
        $data = eyc_array_key($param, 'template_id,page,touser,data,miniprogram_state,lang');
        $r = $this->GuzzleHttp->post($url, $data);
        unset($url);
        unset($data);
        if (!isset($r['errcode']) || $r["errcode"] == 0) {
            return true;
        } else {
            alog($r["errmsg"], 3);
            return false;
        }
    }
}
