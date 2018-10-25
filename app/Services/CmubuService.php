<?php
/**
 * Date: 2018/10/25
 * Time: 19:02
 */

namespace App\Services;


class CmubuService
{
    public function infoByTextName($data, $name)
    {
        return collect($data)->where('text', $name)->first();
    }
}