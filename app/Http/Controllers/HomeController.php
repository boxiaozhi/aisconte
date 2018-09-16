<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return redirect(route('note.index')); //暂时跳转到笔记模块
    }
}
