<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/17 0017
 * Time: 14:05
 */

namespace LuxuryMore;

use GuzzleHttp\Client;
class ImageTextOrigin
{
    public $httpclient;
    public function __construct(Client $httpclient)
    {
        $this->httpclient=$httpclient;
    }
}