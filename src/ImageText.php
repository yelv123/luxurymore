<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/17 0017
 * Time: 14:04
 */

namespace LuxuryMore;
use GuzzleHttp\Client;
class ImageText
{
    private $httpclient;
    private $error;
    private $errorMessage;
    public function __construct(Client $httpclient)
    {
        $this->httpclient=$httpclient;
    }

    /**
     * @param $imageText 图文素材
     * @return bool|mixed 返回成功的图文素材
     */
    public function addImageText($imageText)
    {
        try
        {
            $response=$this->httpclient->POST('/api/goods',['json'=>json_encode($imageText)]);
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


    /**
     * @param $imageTextId 图文id
     * @param $imageText   修改图文信息
     * @return bool|mixed  返回修改后的数据
     */
    public function changeImageText($imageId,$imageText)
    {
        try
        {
            $response=$this->httpclient->PUT("/api/goods/{$imageId}",['json'=>json_encode($imageText)]);
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