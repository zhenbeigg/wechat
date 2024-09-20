<?php
/*
 * @author: 布尔
 * @name: 用户管理
 * @desc: 介绍
 * @LastEditTime: 2023-12-11 11:25:01
 * @FilePath: \eyc3_visitor\app\Lib\Plugins\Wechat\Wxa.php
 */

namespace Eykj\Wechat;

use Eykj\Base\GuzzleHttp;
use Eykj\Wechat\Service;
use function Hyperf\Support\env;

class Wxa
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
     * @name: 获取手机号
     * @return array
     */
    public function getuserphonenumber(array $param): array
    {
        /* 获取token */
        $access_token = $this->Service->get_access_token();
        $url = env('WECHAT_URL', 'https://api.weixin.qq.com') . "/wxa/business/getuserphonenumber?access_token=" . $access_token;
        $data = eyc_array_key($param, 'code');
        $r = $this->GuzzleHttp->post($url, $data);
        unset($url);
        unset($data);
        if (!isset($r['errcode']) || $r["errcode"] == 0) {
            return $r['phone_info'];
        }
        error($r['errcode'], $r["errmsg"]);
    }

    /**
     * @author: 布尔
     * @name: 获取scheme码
     * @return string
     */
    public function generatescheme(array $param): string
    {
        /* 获取token */
        $access_token = $this->Service->get_access_token();
        $url = env('WECHAT_URL', 'https://api.weixin.qq.com') . "/wxa/generatescheme?access_token=" . $access_token;
        $data = eyc_array_key($param, 'jump_wxa,is_expire,expire_time,expire_type,expire_interval');
        $r = $this->GuzzleHttp->post($url, $data);
        unset($url);
        unset($data);
        if (!isset($r['errcode']) || $r["errcode"] == 0) {
            return $r['openlink'];
        }
        error($r['errcode'], $r["errmsg"]);
    }
}
