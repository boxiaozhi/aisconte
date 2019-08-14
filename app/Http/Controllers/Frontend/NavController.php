<?php
/**
 * Created by PhpStorm.
 * User: zz
 * Date: 2018/9/20
 * Time: 19:30
 */

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\NavService;

class NavController extends Controller
{
    /**
     * 主页
     *
     * @param Request $request
     *
     * @return void
     */
    public function index(Request $request)
    {
        $list = NavService::list();

        return view('frontend.nav.index')
            ->with('list', $list)
            ->with('pageTitle', 'Nav');
    }
}