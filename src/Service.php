<?php
/*
 * @author: 布尔
 * @name: 微信Service类
 * @desc: 介绍
 * @LastEditTime: 2024-06-26 15:48:54
 */

namespace Eykj\Wechat;

use Eykj\Base\GuzzleHttp;
use Eykj\Base\JsonRpcInterface\AuthInterface;

class Service
{
    protected ?GuzzleHttp $GuzzleHttp;

    protected ?AuthInterface $AuthInterface;

    // 通过设置参数为 nullable，表明该参数为一个可选参数
    public function __construct(?GuzzleHttp $GuzzleHttp)
    {
        $this->GuzzleHttp = $GuzzleHttp;
        $this->AuthInterface = $AuthInterface;
    }


    /**
     * @author: 布尔
     * @name: 获取access_token
     * @return string
     */
    public function get_access_token(): string
    {
        return $this->AuthInterface->get_access_token('Wechat', []);
    }
}
