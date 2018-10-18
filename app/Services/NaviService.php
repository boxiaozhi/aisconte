<?php
/**
 * Created by PhpStorm.
 * User: zz
 * Date: 2018/9/20
 * Time: 19:42
 */

namespace App\Services;


use App\Models\NaviInfo;

class NaviService
{
    public static function naviList()
    {
        $list = NaviInfo::orderBy('id', 'desc')->get();
        return $list;
    }
}