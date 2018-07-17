<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/17 0017
 * Time: 14:02
 */
namespace LuxuryMore;
use GuzzleHttp\Client;
class Authorization
{
    public $user;
    public function __construct($secret)
    {

    }

    public function setAuth(User $user,Client $httpClient)
    {
        $data=[
            'timestamp'=>time(),
            'account'=>'15201712014',
            'country_code'=>'86'
        ];
        ksort($data);
        $query=http_build_query($data);
        $scrstr=
        $query=$query."&api_secret=".$scrstr;
        $sign=md5(md5($query));
        $data['sign']=$sign;

        $token=base64_encode(json_encode($data));
        echo  $token;
        
        

    }
}