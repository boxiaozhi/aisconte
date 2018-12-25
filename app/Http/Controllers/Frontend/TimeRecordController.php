<?php
/**
 * Date: 2018/12/6
 * Time: 21:15
 */

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Services\CmubuService;
use Boxiaozhi\Cmubu\Cmubu;
use Illuminate\Http\Request;

class TimeRecordController extends Controller
{
    private $docName = 'Develop/Config/isconte/timeline';

    public function index(Request $request)
    {
        try{
            $cmubu = new Cmubu();
            $cmubuService = new CmubuService();

            $docInfo = $cmubu->docInfoByPath($this->docName);
            $data = $cmubu->docContent($docInfo['id']); //mubu 文档ID

            $keyArr = [
                'over',
            ];

            $info = [];
            foreach($keyArr as $key){
                $info[$key] = $cmubuService->infoByTextName($data, $key);
            }
        } catch(\Exception $e){
            abort(404);
        }

        return view('frontend.timeRecord.index')
            ->with('info', $info);
    }
}