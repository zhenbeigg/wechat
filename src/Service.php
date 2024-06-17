<?php
/*
 * @author: 布尔
 * @name: 微信Service类
 * @desc: 介绍
 * @LastEditTime: 2024-06-17 20:15:55
 */
namespace Eykj\Wechat;

use Eykj\Base\GuzzleHttp;

class Service
{
    protected ?GuzzleHttp $GuzzleHttp;

    // 通过设置参数为 nullable，表明该参数为一个可选参数
    public function __construct(?GuzzleHttp $GuzzleHttp)
    {
        $this->GuzzleHttp = $GuzzleHttp;
    }

    /**
     * @author: 布尔
     * @name: 获取access_token
     * @return string
     */
    public function get_access_token()
    {
        if(redis()->get("wechat_access_token")){
            return redis()->get("wechat_access_token");
        }else{
            $r = $this->GuzzleHttp->get(env('WECHAT_URL','https://api.weixin.qq.com')."/cgi-bin/token?grant_type=client_credential&appid=".env('WECHAT_APPID','wxb5f8b7a12d59849c')."&secret=".env('WECHAT_APP_SECRET','19795577a198f1464baae4722d864b07'));
            if(!isset($r['errcode']) || $r["errcode"]==0){
                redis()->set("wechat_access_token",$r["access_token"],$r['expires_in']);
                return $r["access_token"];
            }
            error($r['errcode'],$r["errmsg"]);
        }
    }

}