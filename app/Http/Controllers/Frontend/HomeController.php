<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Cmubu\Cmubu;
use App\Services\CmubuService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $docName = 'Develop 开发/Config/isconte.homepage';

    public function index(Request $request)
    {
        try{
            $configs = [
                'username' => env('CMUBU_USERNAME'),
                'password' => env('CMUBU_PASSWORD'),
                'cookies' => '',
            ];
            $cmubu = new Cmubu($configs);
            $cmubuService = new CmubuService();
            $docInfo = $cmubu->docInfoByPath($this->docName);
            $data = $cmubu->docContent($docInfo['id']); //mubu 文档ID
            $keyArr = [
                'Nickname',
                'Slogan',
                'Contact',
                'SiteLink',
            ];

            $info = [];
            foreach($keyArr as $key){
                $info[$key] = $cmubuService->infoByTextName($data, $key);
            }
        } catch(\Exception $e){
            var_dump($e->getMessage());
            exit();
        } 
        return view('frontend.home.index')
            ->with('info', $info);
    }
}
