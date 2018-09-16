<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-04-25
 * Time: 19:57
 */

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Services\NoteService;
use Boxiaozhi\Cwiz\Cwiz;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index(Request $request)
    {
        $docGuid = isset($request->docGuid) ? trim($request->docGuid) : '';

        $cwiz = new Cwiz();
        $noteService = new NoteService();
        //分享列表
        $shares = $cwiz->shares();
        $shareList = isset($shares['content']) ? $shares['content'] : [];
        //笔记详情
        $noteDetail = [];
        if(!$docGuid && isset($shareList[0]['documentGuid'])){
            $docGuid = $shareList[0]['documentGuid'];
        }
        if($docGuid){
            $noteDetail = $cwiz->noteDetail($docGuid);
            if($noteDetail){
                if(isset($noteDetail['html'])){
                    $noteDetail['html'] = $noteService->contentDeal($noteDetail['html']);
                }
            }
        }
        //用户信息
        $userInfo = $cwiz->userInfo();

        return view('frontend.note.index')
            ->with('shareList', $shareList)
            ->with('noteDetail', $noteDetail)
            ->with('userInfo', $userInfo);
    }


}