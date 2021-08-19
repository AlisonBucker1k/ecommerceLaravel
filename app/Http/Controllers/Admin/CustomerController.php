<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use App\Enums\CustomerStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Customer::query();
        $filters = $this->filters($query, $request);

        $data['listStatus'] = CustomerStatus::getInstances();
        $data['customers'] = $query->orderBy('customers.id', 'desc')->paginate(20);
        $data['filters'] = $request->all();
        $data['breadcrumb'] = [
            'Clientes' => route('customers')
        ];

        return view('admin.customer.index', $data);
    }

    /**
     * @param  Builder $query
     * @param  Request $request
     * @return array
     */
    private function filters(Builder $query, Request $request)
    {
        $filters = [];

        $query->join('customer_profiles', 'customer_profiles.customer_id', '=', 'customers.id');

        if (is_numeric($request->status)) {
            $query->whereStatus($request->status);
        }

        if (!empty($request->email)) {
            $query->whereEmail($request->email);
        }

        if (!empty($request->name)) {
            $query->where(DB::raw('CONCAT(customer_profiles.name, " ", customer_profiles.last_name)'), 'like' , '%' . $request->name . '%');
        }

        if (!empty($request->cpf)) {
            $query->whereCpf($request->cpf);
        }

        return $filters;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        $data['customer'] = $customer;
        $data['addresses'] = $customer->addresses()->paginate(10);
        $data['orders'] = $customer->orders()->paginate(10);
        $data['title'] = 'Editar Cliente';
        $data['breadcrumb'] = [
            'Clientes' => route('customers'),
            'Editar Cliente' => route('customer.edit', $customer->slug)
        ];

        return view('admin.customer.form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        if ($request->password) {
            $request->validate([
                'password' => 'required|confirmed',
            ]);

            $customer->updatePassword($request);

            return redirect()->route('customer.edit', $customer->slug)->withSuccess('Cliente editado com sucesso!');
        }

        $customer->updateCustomer($request);

        $profile = $customer->profile()->first();
        $profile->updateCustomerProfile($customer, $request);

        return redirect()->route('customer.edit', $customer->slug)->withSuccess('Cliente editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
