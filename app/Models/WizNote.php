<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WizNote extends Model
{
    use SoftDeletes;

    protected $table = 'wizNote';
}
