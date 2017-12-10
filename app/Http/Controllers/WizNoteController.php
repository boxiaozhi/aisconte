<?php

namespace App\Http\Controllers;

use App\Tools\Guzzle;

class WizNoteController extends Controller
{
    private $client;
    private $redis;
    private $userId;
    private $password;

    const WIZNOTE_LOGIN_INFO      = 'wiznote:login_info';
    const WIZNOTE_TAGS            = 'wiznote:tags';
    const WIZNOTE_NOTES           = 'wiznote:notes';
    const WIZNOTE_SHARES          = 'wiznote:shares';
    const WIZNOTE_SHARES_TAG      = 'wiznote:shares:tag';
    const WIZNOTE_SHARES_TAG_NOTE = 'wiznote:shares:tag_note'; //分享的标签下的笔记索引

    public function __construct($userId, $password, $config=[])
    {
        $defaultConfig = [
            'base_uri' => 'https://note.wiz.cn'
        ];
        $realConfig = array_merge($defaultConfig, $config);
        $this->client = new Guzzle($realConfig);
        $this->redis = app('redis');
        $this->userId = $userId;
        $this->password = $password;
        $this->login();
    }

    /**
     * 登录
     * @param $userId
     * @param $password
     * @return \Psr\Http\Message\StreamInterface
     */
    public function login()
    {
        $method = 'POST';
        $uri    = '/as/user/login';
        $param = [
            'json' => [
                'userId'   => $this->userId,
                'password' => $this->password
            ]
        ];
        $response = $this->client->request($method, $uri, $param);
        $loginInfo = $response->getBody();
        $loginInfo = json_decode($loginInfo, true);
        $this->redis->set(self::WIZNOTE_LOGIN_INFO, json_encode($loginInfo['result']));
        return $loginInfo['result'];
    }

    /**
     * 获取登录信息
     * @return mixed|\Psr\Http\Message\StreamInterface
     * @throws \Illuminate\Container\EntryNotFoundException
     */
    public function getLoginInfo()
    {
        $loginInfo = $this->redis->get(self::WIZNOTE_LOGIN_INFO);
        return $loginInfo ? json_decode($loginInfo, true): $this->login();
    }

    /**
     * 分享列表
     * @return \Psr\Http\Message\StreamInterface
     */
    public function shares()
    {
        $loginInfo = $this->getLoginInfo();
        $loginInfo['page'] = $loginInfo['page'] ?? 0;
        $loginInfo['size'] = $loginInfo['size'] ?? 50;

        $method = 'GET';
        $uri = '/share/api/shares';
        $param = [
            'query' => [
                'token'   => $loginInfo['token'],
                'kb_guid' => $loginInfo['kbGuid'],
                'page'    => $loginInfo['page'],
                'size'    => $loginInfo['size']
            ]
        ];
        $response = $this->client->request($method, $uri, $param);
        $shares = $response->getBody();
        $shares = json_decode($shares, true);
        return $shares;

    }

    public function redisSet($key, $content)
    {
        $this->redis->set($key, json_encode($content));
        return $content;
    }

    /**
     * 全部标签
     * @return mixed
     * @throws \Illuminate\Container\EntryNotFoundException
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
     * 笔记详情
     * @param $content
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Illuminate\Container\EntryNotFoundException
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
        if($noteDetail['return_message'] != 'success'){
            return [];
        }
        $this->redis->hset(self::WIZNOTE_NOTES, $note['documentGuid'], json_encode($noteDetail));
        if(!$noteDetail['doc']['document_tag_guids']){
            return $noteDetail;
        }
        $tags = explode('*', $noteDetail['doc']['document_tag_guids']);
        $this->redis->pipeline(function ($pipe) use ($tags, $note){
            foreach ($tags as $tag){
                $pipe->sadd(self::WIZNOTE_SHARES_TAG, $tag);
                $pipe->sadd(self::WIZNOTE_SHARES_TAG_NOTE.':'.$tag, $note['documentGuid']);
            }
        });
        return $noteDetail;
    }

    /**
     * 分享标签索引
     * @return mixed
     */
    public function shareTags()
    {
        return $this->redis->smembers(self::WIZNOTE_SHARES_TAG);
    }

    public function redisGet($key)
    {
        return json_decode($this->redis->get($key), true);
    }

    //初始化
    public function sync()
    {
        $shares = $this->shares();
        $shares = $shares['content'];
//        $oldShares = $this->redisGet(self::WIZNOTE_SHARES);
//        if($oldShares) {
//            $updates = [];
//            foreach ($oldShares as $oldKey => $oldShare){
//                foreach ($shares as $key => $share){
//                    if($oldShare['documentGuid'] == $share['documentGuid']){
//                        if($oldShare['updatedAt'] != $share['updateAt']){ //需要更新
//                            $updates[] = $share;
//                        }
//                        unset($oldShare[$oldKey]);
//                        unset($share[$key]);
//                        continue 2;
//                    }
//                }
//            }
//            //删除处理
//            //更新处理
//            //新增处理
//        }
        $this->redis->pipeline(function ($pipe){
            $tagNotes = $pipe->keys(self::WIZNOTE_SHARES_TAG_NOTE.":*");
            foreach ($tagNotes as $tagNote){
                $pipe->del($tagNote);
            }
            $pipe->del(self::WIZNOTE_SHARES_TAG);
        });
        foreach ($shares as $share){
            $this->noteDetail($share);
        }
    }
}
