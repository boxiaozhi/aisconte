<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\SystemInfoService;

class SystemController extends BaseController
{
    public function all(Request $request)
    {
        $system = new SystemInfoService();
        $res = $system->all();
        return $this->result($res);
    }

    public function get(Request $request, $name)
    {
        $system = new SystemInfoService();
        $res = $system->__call($name);
        return $this->result($res);
    }
}