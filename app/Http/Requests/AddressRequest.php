<?php

namespace App\Http\Requests;

use App\Rules\CepValidate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cep' => [
                'required',
                new CepValidate()
            ],
            'district' => 'required',
            'city' => 'required',
            'state' => 'required',
            'street' => 'required',
            'number' => 'present',
            'complement' => 'present',
            'reference' => 'present'
        ];
    }
}
