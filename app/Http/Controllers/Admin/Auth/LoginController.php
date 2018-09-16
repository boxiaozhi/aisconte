<?php
/**
 * Created by PhpStorm.
 * User: Conte
 * Date: 2018/8/11
 * Time: 15:59
 */

namespace App\Http\Controllers\Admin\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    /**
     * 登录页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.auth.login');
    }

    /**
     * 登录
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ],[
            'username.*' => '请输入用户名',
            'password.*' => '请输入密码',
        ]);
        $credentials = request(['username', 'password']);
        if ($token = auth('web')->attempt($credentials)) {
            return response()
                ->json([], 200)
                ->cookie('jwt_token', $token);
        }
        return response()->json(['error' => '登录失败'], 401);
    }

    /**
     * 退出登录
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request)
    {
        setcookie('jwt_token', '');
        $request->cookies->remove('jwt_token');
        $request->session()->flush();
        return redirect(route('login.index'));
    }
}