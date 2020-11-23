<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\User;

class ChangeInformationRequest extends FormRequest
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
            'username' => [
                'required',
                'min:8',
                Rule::unique('users', 'phone')->ignore($this->user),
            ],
            'phone' => 'numeric|required',
            'address' => 'required',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->all()) {
                $validator->errors()->add('show_modal', $this->input('define'));
            }
        });
    }
}
