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
    private $httpClient;
    private $error;
    private $errorMessage;
    public function __construct(Client $httpClient)
    {
        $this->httpClient=$httpClient;
    }

    /**
     * 图文素材来源列表
     */
    public function imageTextOriginList()
    {
        try{

            $url="/api/goods-origin";
            $response= $this->httpClient->get($url);
            $data=json_decode($response->getBody()->getContents(),true);
            return $data;
        }
        catch (\Exception $e)
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



    /**
     * @param $imageText 图文素材来源
     * @return bool|mixed 返回成功的图文素材
     */
    public function addImageTextOrigin($originName)
    {
        try
        {
            $response=$this->httpClient->POST('/api/goods-origin',['json'=>['origin_name'=>$originName]]);
            $data=json_decode($response->getBody()->getContents(),true);
            return $data;
        }
        catch (\Exception $e)
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




    /**
     * @param $imageText 图文素材来源
     * @return bool|mixed 返回成功的图文素材
     */
    public function changeImageTextOrigin($originId,$originName)
    {
        //dd($originId);
        try
        {
            $response=$this->httpClient->put("/api/goods-origin/{$originId}",['json'=>['origin_name'=>$originName]]);
            $data=json_decode($response->getBody()->getContents(),true);
            return $data;
        }
        catch (\ErrorException $e)
        {
            //dd($e);
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


    /**
     * @param $imageText 图文素材来源
     * @return bool|mixed 返回成功的图文素材
     */
    public function ImageTextOriginDetails($originId)
    {
        try
        {
            $response=$this->httpClient->get("/api/goods-origin/{$originId}");
            $data=json_decode($response->getBody()->getContents(),true);
            return $data;
        }
        catch (\Exception $e)
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


    /**
     * @param $imageTextId 图文id
     * @return bool 是否删除成功
     */
    public function deleteImageTextOrigin($originId)
    {
        try{
            $this->httpClient->delete("/api/goods-origin/{$originId}");
            return true;
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

    public function getError()
    {
        return $this->error;
    }

    public function getMessage()
    {

        return $this->errorMessage;
    }


}