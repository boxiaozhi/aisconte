<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use QL\QueryList;

class NoteController extends Controller
{
    /**
     * 标题导航
     * @return \Illuminate\Http\JsonResponse
     */
    public function navList() {
        $wiznote = new WizNoteController();
        $shares =  $wiznote->shares();
        $data = [];
        foreach($shares['content'] as $share){
            $data[] = [
                'to' => '/note/'.$share['documentGuid'],
                'name' => $share['documentGuid'],
                'type' => '',
                'des' => $share['title']
            ];
        }
        return response()->json(['default' => $shares['content'][0]['documentGuid'], 'data' => $data]);
    }

    /**
     * 获取笔记内容
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getNote(Request $request) {
        $id       = $request->id;
        $wizNote = new WizNoteController();
        if(!$id){
            $shares =  $wizNote->shares();
            $id = $shares['content'][0]['documentGuid'];
        }
        $shareInfo = $wizNote->shareInfoByDocumentGuid($id);
        $res = $wizNote->noteDetail($shareInfo);
        $res   = self::contentFormat($res);

        $res['format']  = strpos($res['title'], '.') ? 'md' : 'common';
        $res['content'] = self::contentDeal($res['content'], $res['format']);
        return response()->json($res);
    }

    /**
     * 数据格式整理
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function contentFormat($data)
    {
        $res['returnCode']    = $data['return_code'];
        $res['returnMessage'] = $data['return_message'];
        $res['title']         = $data['share']['title'];
        $res['content']       = $data['content'];
        $res['readCount']     = $data['share']['readCount'];
        $res['createdAt']     = $data['share']['createdAt'];
        $res['updatedAt']     = $data['share']['updatedAt'];
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

        $data = QueryList::html($data)->removeHead()->rules($rules)->range('body')->query()->getData();
        $res  = $data->all();
        $res  = $res[0]['body'];

        switch ($format) { //转换规则
            case 'md':
                $Parsedown = new \Parsedown();
                $res       = $Parsedown->text($res);
                break;
        }
        return $res;
    }
}
