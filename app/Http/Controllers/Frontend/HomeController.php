<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Cmubu\Cmubu;
use App\Services\CmubuService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * 主页
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function index(Request $request)
    {
        $version = $request->get('v') ?: '';
        $versions = config('admin-config.home.version.options');
        $versions = array_keys($versions);
        $version = in_array($version, $versions) ? $version : config('home.version');
        $docName = env('HOME_MUBU');

        $title = config('base.title');

        switch($version){
            case 'v1':
                try{
                    $configs = [
                        'username' => env('CMUBU_USERNAME'),
                        'password' => env('CMUBU_PASSWORD'),
                        'cookies' => '',
                    ];
                    $cmubu = new Cmubu($configs);
                    $docInfo = $cmubu->docInfoByPath($docName);
                    $data = $cmubu->docContent($docInfo['id']); //mubu 文档ID
                    $keyArr = [
                        'Nickname',
                        'Slogan',
                        'Contact',
                        'SiteLink',
                    ];
                    $info = [];
                    $cmubuService = new CmubuService();
                    foreach($keyArr as $key){
                        $info[$key] = $cmubuService->infoByTextName($data, $key);
                    }
                } catch(\Exception $e){
                    abort(404, $e->getMessage());
                }
                break;
            case 'v2':
                break;
        }

        return view('frontend.home.index_'.$version)
            ->with('version', $version)
            ->with('title', $title)
            ->with('info', isset($info) ? $info : []);
    }
}
