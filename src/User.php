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

    public function checkVip()
    {
        try{
            $response=$this->httpClient->get("/api/user/vip");
            $data=json_decode($response->getBody()->getContents(),true);
            return $data['vip']==2?false:true;
        }catch (\Exception $e)
        {
            $this->error=$e->getCode();
            if($e->hasResponse())
            {
                $data=json_decode($e->getResponse()->getBody()->getContents(),true);
                $this->errorMessage=$data['message'];
            }
            else{
                $this->errorMessage=$e->getMessage();
            }
            return false;
        }
    }

}