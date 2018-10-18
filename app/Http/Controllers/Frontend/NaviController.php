<?php
/**
 * Created by PhpStorm.
 * User: zz
 * Date: 2018/9/20
 * Time: 19:30
 */

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Services\NaviService;
use Illuminate\Http\Request;

class NaviController extends Controller
{
    public function index(Request $request)
    {
        $naviList = NaviService::naviList();

        return view('frontend.navi.index')
            ->with('naviList', $naviList);
    }
}