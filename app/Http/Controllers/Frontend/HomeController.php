<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Boxiaozhi\Cmubu\Cmubu;
use App\Services\CmubuService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $cmubu = new Cmubu();
        $cmubuService = new CmubuService();

        $docInfo = $cmubu->docContent('1f1-SnRGxw');
        $dataJson = $docInfo['data']['definition'];
        $data = json_decode($dataJson, true);

        $keyArr = [
            'Nickname',
            'Slogan',
            'Contact',
            'SiteLink',
        ];

        $info = [];
        foreach($keyArr as $key){
            $info[$key] = $cmubuService->infoByTextName($data['nodes'], $key);
        }

        //dd($info);

        return view('frontend.main.index')
            ->with('info', $info);
    }
}
