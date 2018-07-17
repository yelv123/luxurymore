<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/17 0017
 * Time: 14:02
 */
namespace LuxuryMore;
use App\Models\User;
class Authorization
{
    private $user;
    private $secret;
    private $httpClient;
    public function __construct($secret,User $user)
    {
        $this->user=$user;
        $this->secret=$secret;
    }

    public function getToken()
    {
        $data['timestamp']=time();
        $data['account']=$this->user->account;
        $data['country_code']=$this->user->country_code;
        ksort($data);
        $query=http_build_query($data);
        $query=$query."&api_secret=".$this->secret;
        $sign=md5(md5($query));
        $data['sign']=$sign;
        $token=base64_encode(json_encode($data));
        return $token;
    }
}