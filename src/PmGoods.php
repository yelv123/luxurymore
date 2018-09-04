<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/4 0004
 * Time: 11:41
 */

namespace LuxuryMore;

use GuzzleHttp\Client;
class PmGoods
{
    private $httpClient;
    private $error;
    private $errorMessage;
    public function __construct(Client $httpClient)
    {
        $this->httpClient=$httpClient;
    }

    /**
     * @param $pmGoods 添加的拍卖的商品
     * @return bool|mixed
     */
    public function  addPmGoods($pmGoods)
    {
        try
        {
            $response=$this->httpClient->POST('/api/user/pm',['json'=>$pmGoods]);
            $data=json_decode($response->getBody()->getContents(),true);
            return $data;
        }
        catch (\Exception $e)
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
     * @param int $pageSize 每页数量
     * @param int $page 当前页数
     * @param string $keyWord 搜索关键字
     * @param string $status 状态筛选
     * @return bool|mixed
     */
    public function index($pageSize=20,$page=1,$keyWord="",$status="")
    {
        try{

            $url="/api/user/pm?page_size={$pageSize}&keyword={$keyWord}&page={$page}&status={$status}";
            $response= $this->httpClient->get($url);
            $data=json_decode($response->getBody()->getContents(),true);
            return $data;

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

    /**
     * @return bool 获取拍卖的总数
     */
    public function total()
    {
        try{
            $url="/api/user/pm/total";
            $response= $this->httpClient->get($url);
            $data=json_decode($response->getBody()->getContents(),true);
            return $data['total'];
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


    /**
     * @param $pmGoodsId  拍卖的id
     * @return bool|mixed
     */
    public function detail($pmGoodsId)
    {
        try{
            $response= $this->httpClient->get("/api/user/pm/{$pmGoodsId}");
            $data=json_decode($response->getBody()->getContents(),true);
            return $data;
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

    /**
     * @param int $isAll 是否
     * @param int $id
     */
    public function  setContacted($isAll=0,$id=0)
    {
        try{
            $response= $this->httpClient->PATCH("/api/user/pm",['json'=>["is_all"=>$isAll,"id"=>$id]]);
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