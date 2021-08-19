<?php

namespace App\Http\Requests;

use App\Enums\ShippingType;
use Illuminate\Foundation\Http\FormRequest;
use phpDocumentor\Reflection\Types\Nullable;

class ProductStoreRequest extends ProductVariationRequest
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
            'name' => 'required',
            'status' => 'required|numeric',
            'category_id' => 'nullable|numeric',
            'subcategory_id' => 'nullable|numeric',
            'description' => 'present',
            'youtube_url' => ['nullable', 'regex:/^https\:\/\/(www\.|)(youtube\.com|youtu\.be)/i'],
            'highlighted' => 'present|numeric',
            'has_grid_variation' => 'required|numeric'
        ];

        if ($this->has_grid_variation) {
            $validate['grids'] = 'required';
        } else {
            $validate += parent::rules();
        }

        return $validate;
    }
}
