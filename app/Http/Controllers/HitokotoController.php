<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tools\Common;

class HitokotoController extends Controller
{
    /**
     * 获取笔记内容
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getInfo(Request $request) {
        $url       = 'http://api.hitokoto.cn/?c=b&encode=json';
        $res      = Common::cUrl($url);
        $res['text'] = $res['hitokoto'];
        return response()->json($res);
    }
}
