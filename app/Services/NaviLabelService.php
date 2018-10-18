<?php
/**
 * Created by PhpStorm.
 * User: zz
 * Date: 2018/9/18
 * Time: 20:02
 */

namespace App\Services;


use App\Models\NaviLabel;

class NaviLabelService
{
    public static function getLabelInfoById(Array $ids)
    {
        $labelInfos = NaviLabel::whereIn('id', $ids)->get();
        return $labelInfos ? $labelInfos : [];
    }
}