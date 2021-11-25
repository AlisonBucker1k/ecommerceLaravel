<?php

namespace App\Http\Requests;

use App\Enums\CustomerStatus;
use Illuminate\Validation\Rule;

class CustomerRequest extends CustomerProfileRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => [
                'required',
                'email',
                'regex:/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/i',
                Rule::unique('customers', 'email', function ($query) {
                    $query->where('status', '!=', CustomerStatus::REMOVED);
                })
            ],
            'password' => 'required|confirmed',
            'terms' => 'required'
        ] + parent::rules();
    }
}
