<?php

namespace Coccuscc\Vdb;

use Coccuscc\Vdb\common\Routes;
use Coccuscc\Vdb\util\RequestUtil;
use Exception;

class Database
{

    public Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * 创建Base类Database
     * @param string $dbName
     * @return mixed
     * @throws Exception
     */
    public function createBaseDb(string $dbName): mixed
    {
        $params = [
            'database' => $dbName,
        ];
        $reqData = [
            'headers' => $this->client->getHeaders(),
            'json' => $params,
        ];

        $response = RequestUtil::send($this->client->getUrl().Routes::DATABASE_CREATE_BASE, 'POST', $reqData);
        $res = @json_decode($response, true);
        if (is_null($res)) {
            throw new Exception('request failed', -1);
        }
        return $res;
    }

    /**
     * 创建Ai类Database
     * @param string $dbName
     * @return mixed
     * @throws Exception
     */
    public function createAiDb(string $dbName): mixed
    {
        $params = [
            'database' => $dbName,
        ];
        $reqData = [
            'headers' => $this->client->getHeaders(),
            'json' => $params,
        ];

        $response = RequestUtil::send($this->client->getUrl().Routes::DATABASE_CREATE_AI, 'POST', $reqData);
        $res = @json_decode($response, true);
        if (is_null($res)) {
            throw new Exception('request failed', -1);
        }
        return $res;
    }

    /**
     * 删除Base类Database
     * @param string $dbName
     * @return mixed
     * @throws Exception
     */
    public function dropBaseDb(string $dbName): mixed
    {
        $params = [
            'database' => $dbName,
        ];
        $reqData = [
            'headers' => $this->client->getHeaders(),
            'json' => $params,
        ];

        $response = RequestUtil::send($this->client->getUrl().Routes::DATABASE_DROP_BASE, 'POST', $reqData);
        $res = @json_decode($response, true);
        if (is_null($res)) {
            throw new Exception('request failed', -1);
        }
        return $res;
    }

    /**
     * 删除Ai类Database
     * @param string $dbName
     * @return mixed
     * @throws Exception
     */
    public function dropAiDb(string $dbName): mixed
    {
        $params = [
            'database' => $dbName,
        ];
        $reqData = [
            'headers' => $this->client->getHeaders(),
            'json' => $params,
        ];

        $response = RequestUtil::send($this->client->getUrl().Routes::DATABASE_DROP_AI, 'POST', $reqData);
        $res = @json_decode($response, true);
        if (is_null($res)) {
            throw new Exception('request failed', -1);
        }
        return $res;
    }

    /**
     * 获取Database列表
     * @return mixed
     * @throws Exception
     */
    public function getDbList(): mixed
    {
        $reqData = [
            'headers' => $this->client->getHeaders()
        ];
        $response = RequestUtil::send($this->client->getUrl().Routes::DATABASE_LIST, 'GET', $reqData);
        $res = @json_decode($response, true);
        if (is_null($res)) {
            throw new Exception('request failed', -1);
        }
        return $res;
    }
}