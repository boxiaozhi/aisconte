<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Boxiaozhi\Cmubu\Cmubu;
use App\Services\CmubuService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $docName = 'Develop 开发/Config/isconte/home';

    public function index(Request $request)
    {
        try{
            $cmubu = new Cmubu();
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
            abort(404);
        }

        return view('frontend.home.index')
            ->with('info', $info);
    }
}
