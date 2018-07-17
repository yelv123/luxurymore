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
    public $httpClient;
    public function __construct(Client $httpClient)
    {
        $this->httpClient=$httpClient;
    }

    /**
     * @param $imageText 图文素材
     * @return bool|mixed 返回成功的图文素材
     */
    public function addImageTextOrigin($originName)
    {
        try
        {
            $response=$this->httpClient->POST('/api/goods-origin',['json'=>json_encode(['origin_name'=>$originName])]);
            $data=json_decode($response->getBody()->getContents(),true);
            return $data;
        }
        catch (\Exception $e)
        {
            $this->error=$e->getCode();
            $this->errorMessage=$e->getMessage();
            return false;
        }
    }



}