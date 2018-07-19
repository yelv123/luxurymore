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
    public $httpClient;
    public function __construct(Client $httpClient)
    {
        $this->httpClient=$httpClient;
    }
}