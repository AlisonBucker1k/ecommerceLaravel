<?php

namespace App\Http\Controllers\Site;

use App\Enums\CustomerStatus;
use App\Http\Controllers\Controller;
use App\CustomerProfile;
use App\Customer;
use App\Http\Requests\CustomerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    private $customer;
    private $customer_profile;

    public function __construct()
    {
        $this->customer = new Customer();
        $this->customer_profile = new CustomerProfile();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('site.customer.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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

    /**
     * Display the specified resource.
     *
     * @param Customer $customer
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile()
    {
        return view('site.panel.customer.profile', [
            'customer' => auth()->user(),
            'address' => auth()->user()->mainAddress,
            'breadcrumb' => [
                'Meus Dados' => route('panel.profile')
            ]
        ]);
    }

    /**
     * @param CustomerRequest $request
     * @return mixed
     */
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

        return redirect()->route('home')->withSuccess($message);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $customer = auth()->user();
        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'birth_date' => 'required',
            'old_password' => [
                'required_with:password',
                function ($attribute, $value, $fail) use ($customer) {
                    if (!empty($value) && !Hash::check($value, $customer->password)) {
                        $fail('Senha atual inválida.');
                    }
                }
            ],
            'password' => 'confirmed'
        ]);

        DB::transaction(function() use ($request, $customer) {
            if (!empty($request->password)) {
                $customer->updatePassword($request);
            }

            $customer->profile->updateProfile($customer, $request);
        });

        return back()->withSuccess('Dados atualizados com sucesso!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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
