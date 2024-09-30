<?php

namespace Coccuscc\Vdb;

use Coccuscc\Vdb\common\Routes;
use Coccuscc\Vdb\util\RequestUtil;
use Exception;

class Document
{

    public Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function upsertTextDocument(string $dbName, string $collection, array $documents, bool $isBuildIndex = true,
    )
    {
        $params = [
            "database"   => $dbName,
            "collection" => $collection,
            "buildIndex" => $isBuildIndex,
            "documents"  => $documents,
        ];
        $reqData = [
            'headers' => $this->client->getHeaders(),
            'json'    => $params,
        ];
        $response = RequestUtil::send($this->client->getUrl().Routes::DOCUMENT_UPSERT, 'POST', $reqData);
        $res = @json_decode($response, true);
        if (is_null($res)) {
            throw new Exception('request failed', -1);
        }
        return $res;
    }

    /**
     * 通过文本查找与给定查询向量相似的向量
     * @param string $dbName
     * @param string $collection
     * @param string $searchItem
     * @param int $limit
     * @param array $otherSearchParams
     * @return mixed
     * @throws Exception
     */
    public function searchTextDocument(string $dbName, string $collection, array $searchItems, int $limit, array $otherSearchParams = []): mixed
    {
        $params = [
            "database"   => $dbName,
            "collection" => $collection,
            "search"     => [
                'embeddingItems' => $searchItems,
                'limit'          => $limit
            ],
        ];
        if (!empty($otherSearchParams)) {
            $params['search'] = array_merge($params['search'], $otherSearchParams);
        }
        $reqData = [
            'headers' => $this->client->getHeaders(),
            'json' => $params,
        ];
        $response = RequestUtil::send($this->client->getUrl().Routes::DOCUMENT_SEARCH, 'POST', $reqData);
        $res = @json_decode($response, true);
        if (is_null($res)) {
            throw new Exception('request failed', -1);
        }
        return $res;
    }

    /**
     * 删除指定  id（Document ID）的文档
     * @param string $dbName
     * @param string $collection
     * @param array $documentIds
     * @param string $filter
     * @return mixed
     * @throws Exception
     */
    public function deleteDocument(string $dbName, string $collection, array $documentIds = [], string $filter = ''): mixed
    {
        $params = [
            "database"   => $dbName,
            "collection" => $collection,
        ];
        if (!empty($documentIds)) {
            $params['query']['documentIds'] = $documentIds;
        }
        if ($filter) {
            $params['query']['filter'] = $filter;
        }
        $reqData = [
            'headers' => $this->client->getHeaders(),
            'json' => $params,
        ];
        $response = RequestUtil::send($this->client->getUrl().Routes::DOCUMENT_DELETE, 'POST', $reqData);
        $res = @json_decode($response, true);
        if (is_null($res)) {
            throw new Exception('request failed', -1);
        }
        return $res;
    }

}