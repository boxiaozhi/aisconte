<?php

namespace App\Http\Controllers;

use App\Tools\Guzzle;

class WizNoteController extends Controller
{
    private $client;
    private $redis;

    const WIZNOTE_LOGIN_INFO      = 'wiznote:login_info'; //登录信息
    const WIZNOTE_TAGS            = 'wiznote:tags'; //所有标签
    const WIZNOTE_NOTES           = 'wiznote:notes'; //具体笔记
    const WIZNOTE_SHARES          = 'wiznote:shares'; //所有分享
    const WIZNOTE_SHARES_TAG      = 'wiznote:shares:tag'; //所有分享标签
    const WIZNOTE_SHARES_TAG_NOTE = 'wiznote:shares:tag_note'; //分享的标签下的笔记索引

    public function __construct($userId='boxiaozhi.bolu@gmail.com', $password='111zzq6534A', $config=[])
    {
        $defaultConfig = [
            'base_uri' => 'https://note.wiz.cn'
        ];
        $this->client = new Guzzle(array_merge($defaultConfig, $config));
        $this->redis = app('redis');
        if($this->shares()['return_code'] != 200){ //检测token是否失效
            $this->login($userId, $password);
        }
    }

    /**
     * 登录
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
        $this->redis->set(self::WIZNOTE_LOGIN_INFO, json_encode($loginInfo['result']));
        return $loginInfo['result'];
    }

    /**
     * 登录信息
     * @return mixed
     */
    public function getLoginInfo()
    {
        $loginInfo = $this->redis->get(self::WIZNOTE_LOGIN_INFO);
        return json_decode($loginInfo, true);
    }

    /**
     * 分享笔记列表
     * @return mixed|\Psr\Http\Message\StreamInterface
     */
    public function shares($page=0, $size=50)
    {
        $loginInfo = $this->getLoginInfo();
        $method = 'GET';
        $uri = '/share/api/shares';
        $param = [
            'query' => [
                'token'   => $loginInfo['token'],
                'kb_guid' => $loginInfo['kbGuid'],
                'page'    => $page,
                'size'    => $size
            ]
        ];
        $response = $this->client->request($method, $uri, $param);
        $shares = $response->getBody();
        $shares = json_decode($shares, true);
        return $shares;
    }

    /**
     * 全部标签
     * @return mixed
     */
    public function tags()
    {
        $loginInfo = $this->getLoginInfo();
        $method = 'GET';
        $uri = '/ks/tag/all/' . $loginInfo['kbGuid'];
        $param = [
            'query' => [
                'token' => $loginInfo['token']
            ]
        ];
        $response = $this->client->request($method, $uri, $param);
        $tags = $response->getBody();
        $tags = json_decode($tags, true);
        $this->redis->set(self::WIZNOTE_TAGS, json_encode($tags['result']));
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
        $uri = '/share/api/shares';
        $param = [
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
        $urlArr = parse_url($note['shareUrl']);
        $base_uri = $urlArr['scheme'] . '://' .$urlArr['host'];
        $method = 'GET';
        $uri = str_replace('/s/', '/api/shares/', $urlArr['path']);
        $client = new Guzzle(['base_uri' => $base_uri]);
        $param = [
            'query' => [
                'token' => $loginInfo['token']
            ]
        ];
        $response = $client->request($method, $uri, $param);
        $noteDetail = $response->getBody();
        $noteDetail = json_decode($noteDetail, true);
        return $noteDetail;
    }
}
