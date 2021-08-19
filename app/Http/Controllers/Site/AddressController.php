<?php

namespace App\Http\Controllers\Site;

use App\Address;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;

class AddressController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        $data['addresses'] = auth()->user()->ordenedAddresses();
        $data['breadcrumb'] = [
            'Endereços' => route('panel.addresses')
        ];

        return view('site.panel.customer.addresses', $data);
    }

    /**
     * @param AddressRequest $request
     * @return mixed
     */
    public function store(AddressRequest $request)
    {
        $address = new Address();
        $address->createCustomerAddress(auth()->id(), $request->validated());

        return back()->withSuccess('Endereço cadastrado com sucesso!');
    }

    /**
     * @param AddressRequest $request
     * @return array
     */
    public function storeAddressJson(AddressRequest $request)
    {
        $address = new Address();
        $address->createCustomerAddress(auth()->id(), $request->validated());

        return [
            'id' => $address->id,
            'postal_code' => $address->postal_code,
            'complete_address' => $address->complete_address
        ];
    }

    /**
     * @param Address $address
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setMain(Address $address)
    {
        if ($address->customer_id != auth()->id()) {
            return back()->withErrors('Endereço não encontrado.');
        }

        $address->setMain($address);

        return back()->withSuccess('Endereço principal atualizado com sucesso!');
    }

    /**
     * @param Address $address
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Address $address)
    {
        if ($address->customer_id != auth()->id()) {
            return back()->withErrors('Endereço não encontrado.');
        }

        $address->setInactive($address);

        return back()->withSuccess('Endereço removido com sucesso!');
    }
}