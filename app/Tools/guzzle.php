<?php
/**
 * Created by PhpStorm.
 * User: Conte
 * Date: 2017/11/27
 * Time: 07:50
 */

namespace App\Tools;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Cookie\CookieJarInterface;

Class Guzzle
{
    private $client;

    public function __construct($config=[])
    {
        $defaultConfig = [
            'header'   => [
                'User-Agent'   => 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:53.0) Gecko/20100101 Firefox/53.0',
                'Content-Type' => 'application/json',
            ],
            'cookies'     => true,
            'http_errors' => true
        ];
        $realConfig = array_merge($defaultConfig, $config);
        $this->client = new Client($realConfig);
    }

    public function request($method='GET', $uri, $option)
    {
        $response  = $this->client->request($method, $uri, $option);
        return $response;
    }
}