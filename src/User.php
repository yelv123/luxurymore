<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/17 0017
 * Time: 15:19
 */

namespace LuxuryMore;
use GuzzleHttp\Client;
class User
{
    public $httpclient;
    public function __construct(Client $httpclient)
    {
        $this->httpclient=$httpclient;
    }
}