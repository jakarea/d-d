<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends BaseFormRequest
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
            'name'=>[
                'required',
                'min:2',
                'max:255'
            ],
            'email'=>[
                'required',
                'email',
                'regex:/(.+)@(.+)\.(.+)/i',
                'unique:users,email, '.auth()->user()->id,
                'max:255'
            ],
        ];
    }
}
