<?php
/**
 * Created by PhpStorm.
 * User: Conte
 * Date: 2018/8/11
 * Time: 15:59
 */

namespace App\Http\Controllers\Admin\Auth;


use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('admin.auth.register');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|unique:users|max:255',
            'password' => 'required|confirmed',
        ],[
            'username.unique' => '用户名已存在，请更换',
            'password.confirmed' => '两次密码输入不一致，请检查',
        ]);
        $user = User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);

        return $user;
    }
}