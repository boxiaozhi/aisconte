<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-04-25
 * Time: 19:57
 */

namespace App\Http\Controllers\Note;


use App\Http\Controllers\Controller;
use App\Services\WizService;
use Illuminate\Http\Request;
use QL\QueryList;

class NoteController extends Controller
{
    private $wiz;

    public function __construct()
    {
        $this->wiz = new WizService();
    }

    public function index(Request $request)
    {
        $shares = $this->wiz->shares();
        $data   = [];
        foreach($shares['content'] as $share){
            $data[] = $share;
        }
        $default = $shares['content'][0]['documentGuid']; //默认笔记
        $shareList = ['default' => $default, 'data' => $data];
        return view('note.index')
            ->with('shareList', $shareList);
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

        $res = $this->wiz->noteDetail($id); //根据分享信息获取分享具体内容
        $res = $this->contentFormat($res); //格式化

        $res['format']  = 'common';
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

        $res['returnCode']    = $data['returnCode'];
        $res['returnMessage'] = $data['returnMessage'];
        $res['content']       = $data['html'];
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