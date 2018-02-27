<?php
/**
 * Created by PhpStorm.
 * User: Conte
 * Date: 2018/1/30
 * Time: 07:08
 */

namespace App\Http\Controllers;


use App\Services\SystemInfoService;

class SystemInfoController extends Controller
{
    public function base(){
        $systemInfo = new SystemInfoService();
        return $systemInfo->base();
    }
}