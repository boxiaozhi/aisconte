<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NavInfo extends Model{
    protected $table = 'nav_infos';
    protected $casts = [
        'label' => 'array',
    ];
}
