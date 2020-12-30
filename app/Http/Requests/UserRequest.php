<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->role_id == config('role.admin.management');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'phone' => [
                'required',
                Rule::unique('users', 'phone')->ignore($this->user)
            ],
            'email' => [
                'required',
                Rule::unique('users', 'email')->ignore($this->user),
            ],
            'role' => 'required|alpha_num',
            'image' => 'mimes:png,jpg,jpeg|image|max:4084',
            'address' => 'required',
        ];
    }

    public function WithValidator($validator)
    {
        $validator->after(function($validator) {
            if ($validator->errors()->all()) {
                $validator->errors()->add('show_modal', $this->input('define'));
                $validator->errors()->add('userId', $this->route('user'));
            }
        });
    }
}
