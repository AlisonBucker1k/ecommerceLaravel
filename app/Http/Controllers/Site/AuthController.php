<?php

namespace App\Http\Controllers\Site;

use App\Enums\CustomerStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest as Request;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\RedirectResponse as Redirection;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    protected $guard = 'web_site';
    protected $email;

    /**
     * @return \Illuminate\Contracts\View\Factory|Redirection|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index()
    {
        if (auth()->user()) {
            return redirect('/');
        }

        return view('site.customer.login');
    }

    /**
     * @param Request $request
     * @param Auth $auth
     * @return Redirection
     */
    public function login(Request $request, Auth $auth): Redirection
    {
        $data = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'status' => CustomerStatus::ACTIVE
        ];

        $remember = ($request->has('remember')) ? true : false;
        $authorized = $auth->guard($this->guard)->attempt($data, $remember);
        if (!$authorized) {
            return back()->withErrors('E-mail ou senha incorretos.')->withInput($request->except('pass'));
        }

        $hasEmailConfirmation = config('app.has_email_confirmation');
        if ($hasEmailConfirmation == true) {
            $customer = auth()->user();
            if (empty($customer->email_verified_at)) {
                $auth->guard($this->guard)->logout();

                return back()->withErrors('Para fazer login é necessário que você confirme sua conta através do e-mail que lhe enviamos.')->withInput($request->except('pass'));
            }
        }

        $cookieRedirect = Cookie::get('redirectTo');
        if (!empty($cookieRedirect)) {
            Cookie::queue(Cookie::make('redirectTo', '', time() - 1));

            return redirect()->to($cookieRedirect);
        }

        return redirect()->route('home')->withSuccess('Seja bem vindo!');
    }

    /**
     * @param Auth $auth
     * @return Redirection
     */
    public function logout(Auth $auth): Redirection
    {
        $auth->guard($this->guard)->logout();

        return redirect()->route('login');
    }
}