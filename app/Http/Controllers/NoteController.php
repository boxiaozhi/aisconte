<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use QL\QueryList;
use App\Services\WizService;

class NoteController extends Controller
{
    private $wiz;

    public function __construct()
    {
<<<<<<< HEAD
        $userId = env('WIZ_USERID');
        $password = env('WIZ_PASSWORD');
        $this->wiz = new WizService($userId, $password);
=======
        $this->wiz = new WizService();
    }

    public function testInterface()
    {
        return $this->wiz->tags();
>>>>>>> b539cedae56e2099dca32ab16636053a90f88fbc
    }

    /**
     * 标题导航
     * @return \Illuminate\Http\JsonResponse
     */
    public function nav() {
        $shares = $this->wiz->shares();
        $data   = [];
        foreach($shares['content'] as $share){
            $data[] = [
                'to'   => '/note/' . $share['documentGuid'],
                'name' => $share['documentGuid'],
                'type' => '',
                'des'  => $share['title']
            ];
        }
        $default = $shares['content'][0]['documentGuid']; //默认笔记
        $res = ['default' => $default, 'data' => $data];
        return response()->json($res);
    }

    /**
     * 获取笔记内容
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function detail($id) {
        if(!$id){
            $shares = $this->wiz->shares();
            $id = $shares['content'][0]['documentGuid']; //默认笔记
        }
<<<<<<< HEAD
        $shareInfo = $this->wiz->shareInfoByDocumentGuid($id); //根据 Guid 获取分享信息
        $res = $this->wiz->noteDetail($shareInfo); //根据分享信息获取分享具体内容
        $res = $this->contentFormat($res); //格式化

        $res['format']  = strpos($res['title'], '.') ? 'md' : 'common';
=======
        $res = $this->wiz->noteDetail($id); //根据分享信息获取分享具体内容
        $res = $this->contentFormat($res); //格式化

        $res['format']  = 'common';
>>>>>>> b539cedae56e2099dca32ab16636053a90f88fbc
        $res['content'] = self::contentDeal($res['content'], $res['format']); //Markdown 文章处理
        return response()->json($res);
    }

    /**
     * 数据格式处理
     * @param $data
     * @return mixed
     */
    public function contentFormat($data)
    {
<<<<<<< HEAD
        $res['returnCode']    = $data['return_code'];
        $res['returnMessage'] = $data['return_message'];
        $res['title']         = $data['share']['title'];
        $res['content']       = $data['content'];
        $res['readCount']     = $data['share']['readCount'];
        $res['createdAt']     = $data['share']['createdAt'];
        $res['updatedAt']     = $data['share']['updatedAt'];
=======
        $res['returnCode']    = $data['returnCode'];
        $res['returnMessage'] = $data['returnMessage'];
        $res['content']       = $data['html'];
>>>>>>> b539cedae56e2099dca32ab16636053a90f88fbc
        return $res;
    }

    /**
     * 笔记内容处理
     * @param  [type] $data   [description]
     * @param  string $format [description]
     * @return [type]         [description]
     */
    public function contentDeal($data, $format='common') {
        switch ($format) { //提取规则
            case 'md':
                $rules = [
                    'body' => ['', 'text', '', function($content){
                        $content = trim($content);
                        return $content;
                    }]
                ];
                break;
            default:
                $rules = [
                    'body' => ['', 'html', '']
                ];
                break;
        }
        $queryList = new QueryList();
        $data = $queryList->html($data)->removeHead()->rules($rules)->range('body')->query()->getData();
        $res = $data->all();
        $res = $res[0]['body'];

        switch ($format) { //转换规则
            case 'md':
                $Parsedown = new \Parsedown(); //Markdown 转换
                $res = $Parsedown->text($res);
                break;
        }
        return $res;
    }
}
