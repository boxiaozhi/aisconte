<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\NavInfo;
use App\Models\NavLabel;


class NavController extends BaseController
{
    public function all(Request $request)
    {
        $res = NavInfo::all();
        foreach($res as $item){
            $item->label = NavLabel::whereIn('id', $item->label)->pluck('name', 'id');
        }
        return $this->result($res);
    }

    public function getLabels()
    {
        $res = NavLabel::all();
        return $this->result($res);
    }
}
