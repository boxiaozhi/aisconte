<?php
/**
 * 为知笔记 API
 * https://wiz.cn
 */
namespace App\Services;

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
        $response = json_decode($response->getBody(), true);

        if (Cache::has($this->userKey)) {
            Cache::forget($this->userKey);
        }
        Cache::forever($this->userKey, json_encode($response['result']));
        $this->token = $response['result']['token'];
        return $response['result'];
    }

    /**
     * 获取登录信息
     * @return mixed
     */
    public function user()
    {
        $user = Cache::get($this->userKey, '');
        return json_decode($user, true);
    }

//    /**
//     * 分享列表
//     * @param int $page
//     * @param int $size
//     * @return mixed|\Psr\Http\Message\StreamInterface
//     */
//    public function shares($page=0, $size=50)
//    {
//        $loginInfo = $this->user();
//
//        $method = 'GET';
//        $uri    = '/share/api/shares';
//        $param  = [
//            'query' => [
//                'token'   => $loginInfo['token'],
//                'kb_guid' => $loginInfo['kbGuid'],
//                'page'    => $page,
//                'size'    => $size
//            ]
//        ];
//        $response = $this->client->request($method, $uri, $param);
//        $shares = $response->getBody();
//        return json_decode($shares, true);
//    }
//
//    /**
//     * 全部标签信息
//     * @return mixed
//     */
//    public function tags()
//    {
//        $loginInfo = $this->login();
//
//        $method = 'GET';
//        $uri    = '/ks/tag/all/' . $loginInfo['kbGuid'];
//        $param  = [
//            'query' => [
//                'token' => $loginInfo['token']
//            ]
//        ];
//        $response = $this->client->request($method, $uri, $param);
//        $tags = $response->getBody();
//        $tags = json_decode($tags, true);
//        return $tags['result'];
//    }
//
//    /**
//     * 根据 documentGuid 获取分享信息
//     * @param $documentGuid
//     * @return mixed
//     */
//    public function shareInfoByDocumentGuid($documentGuid){
//        $loginInfo = $this->user();
//
//        $method = 'GET';
//        $uri    = '/share/api/shares';
//        $param  = [
//            'query' => [
//                'token'         => $loginInfo['token'],
//                'kb_guid'       => $loginInfo['kbGuid'],
//                'document_guid' => $documentGuid
//            ]
//        ];
//        $response = $this->client->request($method, $uri, $param);
//        $shareInfo = $response->getBody();
//        return json_decode($shareInfo, true);
//    }
//
//    /**
//     * 笔记详情
//     * @param $note
//     * @return mixed|\Psr\Http\Message\StreamInterface
//     */
//    public function noteDetail($note)
//    {
//        $loginInfo = $this->user();
//
//        $urlArr   = parse_url($note['shareUrl']);
//        $base_uri = $urlArr['scheme'] . '://' . $urlArr['host'];
//        $client   = new Client(['base_uri' => $base_uri]);
//
//        $method = 'GET';
//        $uri    = str_replace('/s/', '/api/shares/', $urlArr['path']);
//        $param  = [
//            'query' => [
//                'token' => $loginInfo['token']
//            ]
//        ];
//        $response = $client->request($method, $uri, $param);
//        $noteDetail = $response->getBody();
//        return json_decode($noteDetail, true);
//    }
}
