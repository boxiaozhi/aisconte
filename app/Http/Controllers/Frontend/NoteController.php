<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\NoteService;
use Boxiaozhi\Cwiz\Cwiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NoteController extends Controller
{
    public function index(Request $request)
    {
        $docGuid = isset($request->docGuid) ? trim($request->docGuid) : '';
        $noteService = new NoteService();
        $list = [];
        $noteDetail = [];

        try {
            $wiz = config('note.wiz_enable', 1);
            if($wiz) {
                $cwiz = new Cwiz();
                $type = config('note.wiz_type', 'share');
                switch($type) {
                    case 'share':
                        $res  = $cwiz->shares();
                        $list = isset($res['content']) ? $res['content'] : [];
                        break;
                    case 'category':
                        $category = config('note.wiz_category', '');
                        $res      = $cwiz->noteListByCategory($category, 0, 50, 'modified', 'desc');
                        $list     = isset($res['result']) ? $res['result'] : [];
                        break;
                }
                //笔记详情
                $noteDetail = [];
                if(!$docGuid && isset($list[0]['documentGuid'])) {
                    $docGuid = $list[0]['documentGuid'];
                }
                if($docGuid) {
                    $noteDetail = $cwiz->noteDetail($docGuid);
                    if($noteDetail) {
                        if(isset($noteDetail['html'])) {
                            $noteDetail['html'] = $noteService->contentDeal($noteDetail['html']);
                        }
                    }
                }
            }
        } catch(\Exception $e){
            Log::info($e->getMessage());
        }



        return view('frontend.note.index')
            ->with('list', $list)
            ->with('noteDetail', $noteDetail);
    }

}
