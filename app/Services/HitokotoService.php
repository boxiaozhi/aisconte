<?php
/**
 * 一言
 * http://hitokoto.cn/api
 */
namespace App\Services;

use GuzzleHttp\Client;

class HitokotoService
{
    private $client;

    public function __construct()
    {
        $config = [
            'base_uri' => 'https://sslapi.hitokoto.cn'
        ];
        $this->client = new Client($config);
    }

    /**
     * 获取
     * @param string $c
     * @return mixed
     */
    public function hitokoto($c='')
    {
        $method = 'GET';
        $uri    = '/';
        $param  = [
            'query' => [
                'c'       => $c,
                'enconde' => 'json'
            ]
        ];
        $response = $this->client->request($method, $uri, $param);
        $res = $response->getBody();
        return json_decode($res, true);
    }
}