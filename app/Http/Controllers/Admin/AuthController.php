<?php

namespace App\Http\Controllers\Admin;


use App\Enums\CustomerStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest as Request;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\RedirectResponse as Redirection;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    protected $guard = 'web_admin';
    protected $email;
    protected $redirectTo = '/';

    public function index()
    {
        return view('admin.login');
    }

    public function login(Request $request, Auth $auth): Redirection
    {
        $remember = ($request->has('remember')) ? true : false;

        $cookieRedirect = Cookie::get('redirectTo');
        if (!empty($cookieRedirect)) {
            $this->redirectTo = $cookieRedirect;
        }

        $data = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'status' => CustomerStatus::ACTIVE
        ];

        $authorized = $auth->guard($this->guard)->attempt($data, $remember);
        if (!$authorized) {
            return back()->withErrors('E-mail ou senha incorretos.')->withInput($request->except('pass'));
        }

        return redirect()->intended($this->redirectTo)->withSuccess('Seja bem vindo!');
    }

    public function logout(Auth $auth): Redirection
    {
        $auth->guard($this->guard)->logout();

        return redirect('/login');
    }
}
