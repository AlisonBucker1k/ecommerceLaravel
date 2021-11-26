<?php

namespace App\Http\Controllers\Site;

use App\Enums\CustomerStatus;
use App\Http\Controllers\Controller;
use App\Customer;
use App\Http\Requests\CustomerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function create()
    {
        return view('site.customer.login');
    }

    public function delete()
    {
        return view('site.panel.customer.profile.disable',  [
            'customer' => auth()->user(),
            'breadcrumb' => [
                'Home' => route('home'),
                'Perfil' => route('panel.profile'),
                'Desativar Conta' => route('panel.profile.disable')
            ]
        ]);
    }

    public function show(Customer $customer)
    {
        if ($customer->id != auth()->id()) {
            return back()->withErrors('Cliente não encontrado');
        }

        return view('site.customer.show', [
            'customer' => $customer,
            'address' => $customer->mainAddress,
        ]);
    }

    public function profile()
    {
        $data = [
            'customer' => auth()->user(),
            'address' => auth()->user()->mainAddress,
            'breadcrumb' => [
                'Meus Dados' => route('panel.profile'),
            ]
        ];

        return view('site.panel.customer.profile', $data);
    }

    public function store(CustomerRequest $request)
    {
        DB::transaction(function() use ($request) {
            $customer = new Customer();
            $customer->createCustomer($request->validated());
        });

        $message = 'Cadastro efetuado com sucesso!';

        $hasEmailConfirmation = config('app.has_email_confirmation');
        if ($hasEmailConfirmation == true) {
            $message .= ' Você receberá um e-mail para ativar sua conta.';

            return redirect()->route('customer.register')->withSuccess($message);
        }

        $data = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'status' => CustomerStatus::ACTIVE,
        ];

        Auth::guard('web_site')->attempt($data);

        $cookieRedirect = Cookie::get('redirectTo');
        if (!empty($cookieRedirect)) {
            return redirect()->to($cookieRedirect);
        }

        return redirect()->route('home')->withSuccess($message);
    }

    public function update(Request $request)
    {
        $customer = auth()->user();
        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'birth_date' => 'required',
            'password' => 'required_with:old_password|confirmed',
            'old_password' => [
                'required_with:password',
                function ($attribute, $value, $fail) use ($customer) {
                    if (!empty($value) && !Hash::check($value, $customer->password)) {
                        $fail('Senha atual inválida.');
                    }
                },
            ],
        ]);

        DB::transaction(function() use ($request, $customer) {
            if (!empty($request->password)) {
                $customer->updatePassword($request);
            }

            $customer->profile->updateProfile($request);
        });

        return back()->withSuccess('Dados atualizados com sucesso!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect()->route('home');
    }

    public function destroy(Customer $customer)
    {
        foreach(auth()->user()->ads as $ad) {
            $ad->status = 0;
            $ad->update();
        }

        auth()->user()->status = CustomerStatus::REMOVED;
        auth()->user()->update();

        Auth::logout();

        return redirect()->route('home');
    }
}
