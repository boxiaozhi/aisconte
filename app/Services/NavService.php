<?php

namespace App\Services;


use App\Models\NavInfo;
use App\Models\NavLabel;

class NavService
{
    /**
     * 导航列表
     *
     * @return void
     */
    public static function list()
    {
        $list = NavInfo::orderBy('id', 'desc')->get();
        foreach($list as $item){
            $item->label = NavLabel::whereIn('id', $item->label)->pluck('name', 'id');
        }
        return $list;
    }
}