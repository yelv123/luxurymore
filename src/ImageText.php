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
    private $httpClient;
    private $error;
    private $errorMessage;
    public function __construct(Client $httpClient)
    {
        $this->httpClient=$httpClient;
    }

    /**
     * @param $imageText 图文素材
     * @return bool|mixed 返回成功的图文素材
     */
    public function addImageText($imageText)
    {
        try
        {
            $response=$this->httpClient->POST('/api/goods',['json'=>json_encode($imageText)]);
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
    public function changeImageText($imageTextId,$imageText)
    {
        try
        {
            $response=$this->httpClient->PUT("/api/goods/{$imageTextId}",['json'=>json_encode($imageText)]);
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
     * @param int $pageSize 每页多少
     * @param int $page 请求第几页
     * @param string $inventoryGoodsId 关联库存的九图库存id
     * @param string $keyword 搜索关键字
     * @return bool|mixed 返回列表
     */
    public function imageTextList($pageSize=20,$page=1,$inventoryGoodsId="",$keyword="")
    {
        try{
            if($inventoryGoodsId!=="")
            {
                $url="/api/goods?inventory_goods_id={$inventoryGoodsId}";
            }
            else{
                $url="/api/goods?page_size={$pageSize}&keyword={$keyword}&page={$page}";
            }
            $response= $this->httpClient->get($url);
            $data=json_decode($response->getBody()->getContents(),true);
            return $data;

        }catch (\Exception $e)
        {
            $this->error=$e->getCode();
            $this->errorMessage=$e->getMessage();
            return false;
        }
    }

    /**
     * @param $imageTextId 图文id
     * @return bool|mixed 图文详情
     */
    public function imageTextDetails($imageTextId)
    {
        try{
            $response= $this->httpClient->get("/api/goods/{$imageTextId}");
            $data=json_decode($response->getBody()->getContents(),true);
            return $data;

        }catch (\Exception $e)
        {
            $this->error=$e->getCode();
            $this->errorMessage=$e->getMessage();
            return false;
        }
    }


    /**
     * @param $imageTextId 图文id
     * @return bool 是否删除成功
     */
    public function deleteImageText($imageTextId)
    {
        try{
            $this->httpClient->delete("/api/goods/{$imageTextId}");
            return true;
        }catch (\Exception $e)
        {
            $this->error=$e->getCode();
            $this->errorMessage=$e->getMessage();
            return false;
        }
    }

    /**
     * @param $imageTextId 图文id
     * @return bool 是否成功
     */
    public function switchHideImageText($imageTextId)
    {
        try{
            $this->httpClient->patch("/api/goods/{$imageTextId}");
            return true;
        }catch (\Exception $e)
        {
            $this->error=$e->getCode();
            $this->errorMessage=$e->getMessage();
            return false;
        }
    }




    /**
     * @param $imageTextId 图文id
     * @return bool 是否成功
     */
    public function relevanceGoods($imageTextId,$inventoryGoodsId=0)
    {
        try{
            $this->httpClient->patch("/api/goods/{$imageTextId}/{$inventoryGoodsId}");
            return true;
        }catch (\Exception $e)
        {
            $this->error=$e->getCode();
            $this->errorMessage=$e->getMessage();
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