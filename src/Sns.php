<?php
/*
 * @author: 布尔
 * @name: 登录
 * @desc: 介绍
 * @LastEditTime: 2023-04-21 13:51:52
 */

namespace Eykj\Wechat;

use Eykj\Base\GuzzleHttp;

class Sns
{
    protected ?GuzzleHttp $GuzzleHttp;

    // 通过设置参数为 nullable，表明该参数为一个可选参数
    public function __construct(?GuzzleHttp $GuzzleHttp)
    {
        $this->GuzzleHttp = $GuzzleHttp;
    }

    /**
     * @author: 布尔
     * @name: 小程序登录
     * @return array
     */
    public function jscode2session(array $param): array
    {
        $url = env('WECHAT_URL', 'https://api.weixin.qq.com') . "/sns/jscode2session?grant_type=authorization_code&appid=" . env('WECHAT_APPID', 'wxb5f8b7a12d59849c') . "&secret=" . env('WECHAT_APP_SECRET', '19795577a198f1464baae4722d864b07') . '&js_code=' . $param['code'];
        $r = $this->GuzzleHttp->get($url);
        unset($url);
        if (!isset($r['errcode']) || $r["errcode"] == 0) {
            return $r;
        }
        error($r['errcode'], $r["errmsg"]);
    }
}
