<?php

namespace App\Http\Requests;

use App\Enums\Shipping;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductVariationRequest extends FormRequest
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
        $validate = [
            'value' => 'required',
            'status' => 'required|numeric',
            'stock_quantity' => 'required|numeric',
            'highlighted' => 'required|numeric',
            'discount_percent' => 'nullable|required_with:promotion_value|numeric|min:0|max:100',
            'promotion_value' => [
                'nullable',
                'required_with:discount_percent'
            ],
            'cost_value' => 'nullable',
            'width' => 'required|numeric|min:11|max:105',
            'height' => 'required|numeric|min:2|max:105',
            'weight' => 'required|numeric|max:30000',
            'length' => 'required|numeric|min:16|max:105'
        ];

        return $validate;
    }
}
