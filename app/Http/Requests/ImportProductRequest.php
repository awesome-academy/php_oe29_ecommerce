<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ImportProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'supplier' => 'required|numeric',
            'size' => 'required|numeric',
            'quantity' => 'required|numeric',
            'original_price' => 'nullable|numeric',
            'current_price' => 'nullable|numeric',
            'unit_price' => 'numeric',
        ];
    }
}
