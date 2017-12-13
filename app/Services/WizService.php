<?php
/**
 * 为知笔记 API
 * https://wiz.cn
 */
namespace App\Services;

use GuzzleHttp\Client;

class WizService
{
    private $client;
    private $redis;

    const WIZ_LOGIN = 'wiz:login'; //登录信息

    public function __construct($userId, $password)
    {
        $config = [
            'base_uri' => 'https://note.wiz.cn'
        ];
        $this->client = new Client($config);
        $this->redis = app('redis');
        if($this->shares()['return_code'] != 200){ //检测token是否失效
            $this->login($userId, $password);
        }
    }

    /**
     * 登录
     * @param $userId
     * @param $password
     * @return mixed
     */
    public function login($userId, $password)
    {
        $method = 'POST';
        $uri    = '/as/user/login';
        $param  = [
            'json' => [
                'userId'   => $userId,
                'password' => $password
            ]
        ];
        $response = $this->client->request($method, $uri, $param);
        $loginInfo = $response->getBody();
        $loginInfo = json_decode($loginInfo, true);
        $this->redis->set(self::WIZ_LOGIN, json_encode($loginInfo['result']));
        return $loginInfo['result'];
    }

    /**
     * 获取登录信息
     * @return mixed
     */
    public function getLoginInfo()
    {
        $loginInfo = $this->redis->get(self::WIZ_LOGIN);
        return json_decode($loginInfo, true);
    }

    /**
     * 分享列表
     * @param int $page
     * @param int $size
     * @return mixed|\Psr\Http\Message\StreamInterface
     */
    public function shares($page=0, $size=50)
    {
        $loginInfo = $this->getLoginInfo();

        $method = 'GET';
        $uri    = '/share/api/shares';
        $param  = [
            'query' => [
                'token'   => $loginInfo['token'],
                'kb_guid' => $loginInfo['kbGuid'],
                'page'    => $page,
                'size'    => $size
            ]
        ];
        $response = $this->client->request($method, $uri, $param);
        $shares = $response->getBody();
        return json_decode($shares, true);
    }

    /**
     * 全部标签信息
     * @return mixed
     */
    public function tags()
    {
        $loginInfo = $this->getLoginInfo();

        $method = 'GET';
        $uri    = '/ks/tag/all/' . $loginInfo['kbGuid'];
        $param  = [
            'query' => [
                'token' => $loginInfo['token']
            ]
        ];
        $response = $this->client->request($method, $uri, $param);
        $tags = $response->getBody();
        $tags = json_decode($tags, true);
        return $tags['result'];
    }

    /**
     * 根据 documentGuid 获取分享信息
     * @param $documentGuid
     * @return mixed
     */
    public function shareInfoByDocumentGuid($documentGuid){
        $loginInfo = $this->getLoginInfo();

        $method = 'GET';
        $uri    = '/share/api/shares';
        $param  = [
            'query' => [
                'token'         => $loginInfo['token'],
                'kb_guid'       => $loginInfo['kbGuid'],
                'document_guid' => $documentGuid
            ]
        ];
        $response = $this->client->request($method, $uri, $param);
        $shareInfo = $response->getBody();
        return json_decode($shareInfo, true);
    }

    /**
     * 笔记详情
     * @param $note
     * @return mixed|\Psr\Http\Message\StreamInterface
     */
    public function noteDetail($note)
    {
        $loginInfo = $this->getLoginInfo();

        $urlArr   = parse_url($note['shareUrl']);
        $base_uri = $urlArr['scheme'] . '://' . $urlArr['host'];
        $client   = new Client(['base_uri' => $base_uri]);

        $method = 'GET';
        $uri    = str_replace('/s/', '/api/shares/', $urlArr['path']);
        $param  = [
            'query' => [
                'token' => $loginInfo['token']
            ]
        ];
        $response = $client->request($method, $uri, $param);
        $noteDetail = $response->getBody();
        return json_decode($noteDetail, true);
    }
}
