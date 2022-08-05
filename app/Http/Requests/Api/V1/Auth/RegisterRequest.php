<?php

namespace App\Http\Requests\Api\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            "name" => ['required', 'string', 'min:3', 'max:70'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            "password" => ['required', 'min:6', 'max:70'],
            'phone' => ['required', 'min:9', 'max:33', 'string', 'unique:users,phone'],
            "avatar" => ['nullable', "image", 'max:' . (1024 * 5), 'mimes:png,jpg,jpeg'],
        ];
    }
}
