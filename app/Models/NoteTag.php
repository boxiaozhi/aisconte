<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NoteTag extends Model
{
    use SoftDeletes;

    protected $table = 'note_tags';
}
