<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class SecuritySettingRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email'=>[
                'required',
                'email',
                'regex:/(.+)@(.+)\.(.+)/i',
                'unique:users,email, '.auth()->user()->id,
                'max:255'
            ],
            'phone'=>[
                'required',
                'numeric',
            ],
            'password'=>[
                'required',
                'min:6',
            ],
        ];
    }
}
