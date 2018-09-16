<?php
/**
 * Created by PhpStorm.
 * User: Conte
 * Date: 2018/8/11
 * Time: 15:52
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Services\SystemInfoService;

class DashboardController extends Controller
{
    public function index()
    {
        $systemInfo = SystemInfoService::base();
        return view('admin.dashboard.index')
            ->with('systemInfo', $systemInfo)
            ->with('title', 'Dashboard')
            ->with('des', 'Base Info');
    }
}