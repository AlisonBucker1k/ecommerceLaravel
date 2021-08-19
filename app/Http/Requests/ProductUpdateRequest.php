<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use phpDocumentor\Reflection\Types\Nullable;

class ProductUpdateRequest extends ProductVariationRequest
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
            'category_id' => 'required|numeric',
            'subcategory_id' => 'nullable|numeric',
            'description' => 'present',
            'youtube_url' => ['nullable', 'regex:/^https\:\/\/(www\.|)(youtube\.com|youtu\.be)/i'],
            'highlighted' => 'numeric|numeric'
        ];

        if (!$this->has_grid_variation) {
            $validate += parent::rules();
        }

        return $validate;
    }
}
