<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Product;
class ProductRequest extends FormRequest
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
            'name' => [
                'required',
                Rule::unique('products', 'name')->ignore($this->product),
            ],
            'original_price' =>[
                'numeric',
                'required',
            ],
            'current_price' => [
                'numeric',
                'required',
                'gte:original_price',
            ],
            'category' => 'required',
            'brand' => 'required',
            'image.*' => 'mimes:png,jpg,jpeg',
            'description' => 'required',
        ];
    }


    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->all()) {
                $validator->errors()->add('show_modal', $this->input('define'));
                $validator->errors()->add('route', $this->route('product'));
            }
        });
    }
}
