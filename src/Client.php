<?php

namespace Coccuscc\Vdb;

class Client
{

    public string $url;
    public string $account;
    public string $apiKey;

    public function __construct(string $url, string $account, string $apiKey)
    {
        $this->url = $url;
        $this->account = $account;
        $this->apiKey = $apiKey;
    }

    /**
     * 获取客户端连接地址
     * @return string
     */
    public function getUrl(): string
    {
        $isContainHttpOrHttps = strpos($this->url, 'http://') !== false || strpos($this->url, 'https://') !== false;
        return $isContainHttpOrHttps ? $this->url : 'https://' . $this->url;
    }

    /**
     * 获取请求头Authorization内容
     * @return string
     */
    public function getAuthorization(): string
    {
        return "Bearer account=$this->account&api_key=$this->apiKey";
    }

    /**
     * 获取sdk请求头
     * @return array
     */
    public function getHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Authorization'  => $this->getAuthorization(),
        ];
    }

}