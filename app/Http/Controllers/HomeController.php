<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HitokotoService;

class HomeController extends Controller
{
    /**
     * 获取 hitokoto
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function hitokoto(Request $request)
    {
        $cat = $request->cat ?? ''; //类别
        $hitokoto = new HitokotoService();
        $res = $hitokoto->hitokoto($cat);
        $res['text'] = $res['hitokoto'];
        return response()->json($res);
    }
}
