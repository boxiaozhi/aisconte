<?php
/**
 * Created by PhpStorm.
 * User: Conte
 * Date: 2018/8/10
 * Time: 18:14
 */

namespace App\Services;


use QL\QueryList;

class NoteService
{
    /**
     * 笔记内容处理
     * @param  [type] $data   [description]
     * @param  string $format [description]
     * @return [type]         [description]
     */
    public function contentDeal($data, $format='common') {
        switch ($format) { // 提取规则
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
        switch ($format) { // 转换规则
            case 'md':
                $Parsedown = new \Parsedown(); //Markdown 转换
                $res = $Parsedown->text($res);
                break;
        }
        return $res;
    }
}