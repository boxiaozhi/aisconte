<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NaviInfo extends Model
{
    protected $table = 'navi_infos';

    protected $casts = [
        'label' => 'array'
    ];
}
