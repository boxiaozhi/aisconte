<?php
/**
 * 为知笔记 API
 * https://wiz.cn
 */
namespace App\Services;

<<<<<<< HEAD
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
=======
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\Cache;

class WizService
{
    private $client = null;
    private $prefix = '';
    private $token = '';
    private $userKey = '';

    const CLIENT_OPTIONS = [
        'clientType'    => 'web',
        'clientVersion' => '3.0.0',
        'apiVersion'    => '10',
    ];

    public function __construct()
    {
        $userId   = config('wiz.user_id');
        $password = config('wiz.password');

        $this->prefix = config('wiz.cache_prefix');
        $this->userKey = $this->prefix.'user';

        $this->client = new GuzzleClient(['base_uri' => config('wiz.base_uri')]);

        $this->loginCheck($userId, $password);
    }

    /**
     * 登录校验，无效则登录
     * @param $userId
     * @param $password
     * @return bool
     */
    private function loginCheck($userId, $password)
    {
        $user = Cache::get($this->userKey, '');
        $user = (array)json_decode($user, true);
        if($user){
            $keepRes = $this->loginKeep($user['token']);
            if($keepRes){
                $this->token = $user['token'];
                return true;
            }
        }
        $this->login($userId, $password);
    }

    /**
     * 保持登录状态
     * @param $token
     * @return bool
     */
    private function loginKeep($token)
    {
        $method = 'GET';
        $uri    = 'as/user/keep';
        $query  = [
            'token' => $token,
        ];
        $param = [
            'query' => $query + self::CLIENT_OPTIONS
        ];
        $response = $this->client->request($method, $uri, $param);
        $res = json_decode($response->getBody(), true);
        return $res['returnCode'] == 200 ? true : false;
>>>>>>> b539cedae56e2099dca32ab16636053a90f88fbc
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
<<<<<<< HEAD
        $loginInfo = $response->getBody();
        $loginInfo = json_decode($loginInfo, true);
        $this->redis->set(self::WIZ_LOGIN, json_encode($loginInfo['result']));
        return $loginInfo['result'];
=======
        $response = json_decode($response->getBody(), true);

        if (Cache::has($this->userKey)) {
            Cache::forget($this->userKey);
        }
        Cache::forever($this->userKey, json_encode($response['result']));
        $this->token = $response['result']['token'];
        return $response['result'];
>>>>>>> b539cedae56e2099dca32ab16636053a90f88fbc
    }

    /**
     * 获取登录信息
     * @return mixed
     */
<<<<<<< HEAD
    public function getLoginInfo()
    {
        $loginInfo = $this->redis->get(self::WIZ_LOGIN);
        return json_decode($loginInfo, true);
=======
    public function user()
    {
        $user = Cache::get($this->userKey, '');
        return json_decode($user, true);
>>>>>>> b539cedae56e2099dca32ab16636053a90f88fbc
    }

    /**
     * 分享列表
     * @param int $page
     * @param int $size
     * @return mixed|\Psr\Http\Message\StreamInterface
     */
    public function shares($page=0, $size=50)
    {
<<<<<<< HEAD
        $loginInfo = $this->getLoginInfo();
=======
        $loginInfo = $this->user();
>>>>>>> b539cedae56e2099dca32ab16636053a90f88fbc

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
<<<<<<< HEAD
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
=======
        return json_decode($response->getBody(), true);
    }

    /**
     * 根据 docGuid 获取笔记详情
     * @param $docGuid
     * @return mixed
     */
    public function noteDetail($docGuid)
    {
        $loginInfo = $this->user();

        $method = 'GET';
        $uri    = '/ks/note/download/'.$loginInfo['kbGuid'].'/'.$docGuid;
        $param  = [
            'query' => [
                'token'        => $loginInfo['token'],
                'downloadInfo' => 1, //笔记简介
                'downloadData' => 1, //笔记详情
            ]
        ];
        $response = $this->client->request($method, $uri, $param);
        return json_decode($response->getBody(), true);
    }

    /**
     * 全部标签信息
     * @return mixed
     */
    public function tags()
    {
        $loginInfo = $this->user();

        $method = 'GET';
        $uri    = '/ks/tag/all/'.$loginInfo['kbGuid'];
>>>>>>> b539cedae56e2099dca32ab16636053a90f88fbc
        $param  = [
            'query' => [
                'token' => $loginInfo['token']
            ]
        ];
<<<<<<< HEAD
        $response = $client->request($method, $uri, $param);
        $noteDetail = $response->getBody();
        return json_decode($noteDetail, true);
=======
        $response = $this->client->request($method, $uri, $param);
        return json_decode($response->getBody(), true);
>>>>>>> b539cedae56e2099dca32ab16636053a90f88fbc
    }
}
