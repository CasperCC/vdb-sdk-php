<?php

namespace Coccuscc\Vdb;

use Coccuscc\Vdb\common\Routes;
use Coccuscc\Vdb\util\RequestUtil;
use Exception;

class Collection
{

    public Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * 获取集合列表
     * @param string $dbName
     * @return mixed
     * @throws Exception
     */
    public function listCollection(string $dbName): mixed
    {
        $params = [
            'database' => $dbName,
        ];
        $reqData = [
            'headers' => $this->client->getHeaders(),
            'json' => $params,
        ];

        $response = RequestUtil::send($this->client->getUrl().Routes::COLLECTION_LIST, 'POST', $reqData);
        $res = @json_decode($response, true);
        if (is_null($res)) {
            throw new Exception('request failed', -1);
        }
        return $res;
    }

    /**
     * 创建集合
     * @param string $dbName
     * @param string $collection
     * @param int $replicaNum
     * @param int $shardNum
     * @param string|null $description
     * @param array $indexes
     * @param bool $isEmbedding
     * @param string $embeddingModel
     * @return mixed
     * @throws Exception
     */
    public function createCollection(
        string $dbName,
        string $collection,
        int $replicaNum = 0,
        int $shardNum = 1,
        ?string $description = null,
        array $indexes = [],
        bool $isEmbedding = false,
        string $embeddingModel = 'e5-large-v2', // 默认使用英文
    ): mixed
    {
        $params = [
            "database"    => $dbName,
            "collection"  => $collection,
            "replicaNum"  => $replicaNum,
            "shardNum"    => $shardNum,
            "description" => $description,
            "indexes"     => $indexes,
        ];
        if ($isEmbedding) {
            $params['embedding'] = [
                'field'       => 'text',
                'vectorField' => 'vector',
                'model'       => $embeddingModel,
            ];
        }
        $reqData = [
            'headers' => $this->client->getHeaders(),
            'json' => $params,
        ];
        $response = RequestUtil::send($this->client->getUrl().Routes::COLLECTION_CREATE, 'POST', $reqData);
        $res = @json_decode($response, true);
        if (is_null($res)) {
            throw new Exception('request failed', -1);
        }
        return $res;
    }

    /**
     * 删除 Base 类数据库中已存在的 Collection
     * @param string $dbName
     * @param string $collection
     * @return mixed
     * @throws Exception
     */
    public function dropCollection(string $dbName, string $collection): mixed
    {
        $params = [
            'database' => $dbName,
            'collection' => $collection
        ];
        $reqData = [
            'headers' => $this->client->getHeaders(),
            'json' => $params,
        ];

        $response = RequestUtil::send($this->client->getUrl().Routes::COLLECTION_DROP, 'POST', $reqData);
        $res = @json_decode($response, true);
        if (is_null($res)) {
            throw new Exception('request failed', -1);
        }
        return $res;
    }

    /**
     * 查询指定 Collection 的信息
     * @param string $dbName
     * @param string $collection
     * @return mixed
     * @throws Exception
     */
    public function describeCollection(string $dbName, string $collection): mixed
    {
        $params = [
            'database' => $dbName,
            'collection' => $collection
        ];
        $reqData = [
            'headers' => $this->client->getHeaders(),
            'json' => $params,
        ];

        $response = RequestUtil::send($this->client->getUrl().Routes::COLLECTION_DESCRIBE, 'POST', $reqData);
        $res = @json_decode($response, true);
        if (is_null($res)) {
            throw new Exception('request failed', -1);
        }
        return $res;
    }

    /**
     * 清空 Collection 中所有的数据与索引
     * @param string $dbName
     * @param string $collection
     * @return mixed
     * @throws Exception
     */
    public function truncateCollection(string $dbName, string $collection): mixed
    {
        $params = [
            'database' => $dbName,
            'collection' => $collection
        ];
        $reqData = [
            'headers' => $this->client->getHeaders(),
            'json' => $params,
        ];

        $response = RequestUtil::send($this->client->getUrl().Routes::COLLECTION_TRUNCATE, 'POST', $reqData);
        $res = @json_decode($response, true);
        if (is_null($res)) {
            throw new Exception('request failed', -1);
        }
        return $res;
    }

}