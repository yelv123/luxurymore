<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/17 0017
 * Time: 14:37
 */

namespace LuxuryMore;
use GuzzleHttp\Client;
use LuxuryMore\ImageText;
use LuxuryMore\ImageTextOrigin;
use LuxuryMore\User as LuxuryUser;
use LuxuryMore\Authorization;
use App\Models\User;
class LuxuryMoreClient
{
    private $baseUrl;
    private $secret;
    private $httpClient;
    public function __construct($baseUrl,$secret)
    {
        $this->baseUrl=$baseUrl;
        $this->secret=$secret;
    }

    /**
     * 获取图文操作的客户端
     */
    public function ImageText(User $user)
    {
        $authorization=new Authorization($this->secret,$user);
        $token=$authorization->getToken();
        $this->httpClient = new Client(['base_uri' => $this->baseUrl,'headers' => ['Accept'=>'application/prs.luxurymore.inventory-v1+json','Content-Type'=>'application/json','Authorization' => "Bearer {$token}"]]);
        return new ImageText($this->httpClient);
    }
    /**
     * 获取图文源操作的客户端
     */
    public function ImageTextOrigin(User $user)
    {
        $authorization=new Authorization($this->secret,$user);
        $token=$authorization->getToken();
        $this->httpClient = new Client(['base_uri' => $this->baseUrl,'headers' => ['Accept'=>'application/prs.luxurymore.inventory-v1+json','Content-Type'=>'application/json','Authorization' => "Bearer {$token}"]]);

        return new ImageTextOrigin($this->httpClient);
    }

    /**
     * 获取用户的操作客户端
     */
    public function User(User $user)
    {
        $authorization=new Authorization($this->secret,$user);
        $token=$authorization->getToken();
        $this->httpClient = new Client(['base_uri' => $this->baseUrl,'headers' => ['Accept'=>'application/prs.luxurymore.inventory-v1+json','Content-Type'=>'application/json','Authorization' => "Bearer {$token}"]]);
        return new LuxuryUser($this->httpClient);
    }
}