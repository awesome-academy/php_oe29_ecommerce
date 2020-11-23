<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Supplier;
use Illuminate\Validation\Rule;

class SupplierRequest extends FormRequest
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
            'name' => [
                'required',
                Rule::unique('suppliers', 'name')->ignore($this->supplier),
            ],
            'phone' => [
                'required',
                Rule::unique('suppliers', 'phone')->ignore($this->supplier),
                'min:8',
                'max:12',
            ],
            'address' => 'required',
            'description' => 'required',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->all()) {
                $validator->errors()->add('show_modal', $this->input('define'));
                $validator->errors()->add('route', $this->route('supplier'));
            }
        });
    }
}
