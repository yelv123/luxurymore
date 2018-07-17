<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/17 0017
 * Time: 14:37
 */

namespace LuxuryMore;
use App\Models\User;
use GuzzleHttp\Client;
use LuxuryMore\ImageText;
use LuxuryMore\ImageTextOrigin;
use LuxuryMore\User as LuxuryUser;
use LuxuryMore\Authorization;
class LuxuryMoreClient
{
    public $httpClient;
    public function __construct($baseUrl,$secret,User $user)
    {
        $authorization=new Authorization($secret,$user);
        $token=$authorization->getToken();
        $this->httpClient = new Client(['base_uri' => $baseUrl,'headers' => ['Accept'=>'application/prs.luxurymore.inventory-v1+json','Content-Type'=>'application/json','Authorization' => "Bearer {$token}"]]);
    }

    /**
     * 获取图文操作的客户端
     */
    public function ImageText()
    {
        return new ImageText($this->httpClient);
    }
    /**
     * 获取图文源操作的客户端
     */
    public function ImageTextOrigin()
    {
        return new ImageTextOrigin($this->httpClient);
    }

    /**
     * 获取用户的操作客户端
     */
    public function User()
    {
        return new LuxuryUser($this->httpClient);
    }
}